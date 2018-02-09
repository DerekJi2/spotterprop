<?php
class Installation_Model extends CI_Model
{
    public function installation($host_name, $user_name, $user_password, $database_name, $database_driver, $database_prefix)
    {
        $config['hostname'] = $host_name;
        $config['username'] = $user_name;
        $config['password'] = $user_password;
        $config['dbdriver'] = $database_driver;
        $config['dbprefix'] = ($database_prefix == '') ? 'tendoo_' : $database_prefix;
        $config['pconnect'] = false;
        $config['db_debug'] = false;
        $config['cache_on'] = false;
        $config['cachedir'] = '';
        $config['char_set'] = 'utf8';
        $config['dbcollat'] = 'utf8_general_ci';

        if ($database_driver == 'mysqli') {
            if (! $link        =    @mysqli_connect($host_name, $user_name, $user_password)) {
                return 'unable-to-connect';
            }
            mysqli_close($link); // Closing connexion
        }

        $db_connect    =    $this->load->database($config);
        $this->load->dbutil();
        $db_exists    =    $this->dbutil->database_exists($database_name);

        if (! $db_exists) {
            return 'database-not-found';
        }

        $this->db->close();
        // Setting database name
        $config['database']    =    $database_name;
        // Reconnect
        $db_connect                =    $this->load->database($config);

        $this->load->library('session');
        $this->load->model('options');

        // Before tendoo settings tables
        // Used internaly to load module only when database connection is established.

        $this->events->do_action('before_db_setup', array(
            'database_prefix'    =>        $database_prefix,
            'install_model'        =>        $this
        ));

        // Creating option table
        $this->db->query("DROP TABLE IF EXISTS `{$database_prefix}options`;");
        $this->db->query("CREATE TABLE `{$database_prefix}options` (
		  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
		  `key` varchar(200) NOT NULL,
		  `value` text,
		  `autoload` int(11) NOT NULL,
		  `user` int(11) NOT NULL,
		  `app` varchar(100) NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
		");

		// Setup DB Session Table
		$this->db->query("CREATE TABLE IF NOT EXISTS `{$database_prefix}system_sessions` (
		  `id` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
		  `ip_address` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
		  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
		  `data` text COLLATE utf8_unicode_ci NOT NULL
		) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
		");

        $this->events->do_action('tendoo_settings_tables', array(
            'database_prefix'        =>        $database_prefix,
            'install_model'            =>        $this
        ));

        $this->install_spotter_tables($database_prefix);

        // Creating Database File
        $this->create_config_file($config);

        // Saving First Option
        $this->options->set('database_version', $this->config->item('database_version'), true);

        return 'database-installed';
    }

    /**
     * Install tables for Spotter
     */
    public function install_spotter_tables($database_prefix)
    {
        if (true) // Agency
        {
            $this->db->query("DROP TABLE IF EXISTS `{$database_prefix}agency`");
            $this->db->query("CREATE TABLE `{$database_prefix}agency` (
                    `Id` int(11) NOT NULL AUTO_INCREMENT,
                    `Name` varchar(128) NOT NULL,
                    `Phone` varchar(128) NOT NULL,
                    `Email` varchar(128) NOT NULL,
                    `Logo` varchar(512) NOT NULL,
                    `Website` varchar(255) NOT NULL,
                    `IsDeleted` tinyint(1) NOT NULL DEFAULT '0',
                    PRIMARY KEY (`Id`)
                    ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
            ");
            $this->db->query("INSERT INTO `{$database_prefix}agency` 
                VALUES 
                    (1,'Ray White','08 1111 2222','service@raywhite.com.au','assets/icons/real-estate/raywhite.png','http://raywhiteadelaidegroup.com.au/',0),
                    (2,'LJ Hooker','08 3333 4444','service@ljhooker.com.au','assets/icons/real-estate/ljhooker.png','https://www.ljhooker.com.au/',0),
                    (3,'Harcourts','08 5555 6666','service@harcourts.com.au','assets/icons/real-estate/harcourts.png','http://harcourts.com.au/',0),
                    (4,'Toop&Toop','08 7777 8888','service@toop.com.au','assets/icons/real-estate/toop.png','https://www.toop.com.au/',0);");
        }

        if (true) // Defined Features
        {
            $this->db->query("DROP TABLE IF EXISTS `{$database_prefix}definedfeature`");
            $this->db->query("CREATE TABLE `{$database_prefix}definedfeature` (
                `Id` int(11) NOT NULL AUTO_INCREMENT,
                `Name` varchar(255) NOT NULL,
                `Icon` varchar(255) NOT NULL,
                `Comments` text,
                `IsDeleted` tinyint(1) NOT NULL DEFAULT '0',
                `DisplayName` varchar(255) NOT NULL,
                `DisplayNum` int(11) NOT NULL,
                `Importance` int(11) NOT NULL DEFAULT '100',
                PRIMARY KEY (`Id`)
                ) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
            ");
            $this->db->query("INSERT INTO `{$database_prefix}definedfeature` 
                VALUES 
                    (1,'Air_Conditioning','',NULL,0,'',0,100),
                    (2,'Balcony','',NULL,0,'',0,100),
                    (3,'Bedding','',NULL,0,'',0,100),
                    (4,'Cable_TV','',NULL,0,'',0,100),
                    (5,'Dishwasher','',NULL,0,'',0,100),
                    (6,'Family_Room','',NULL,0,'',0,100),
                    (7,'Fireplace','',NULL,0,'',0,100),
                    (8,'Grill','',NULL,0,'',0,100),
                    (9,'Outdoor_Kitchen','',NULL,0,'',0,100),
                    (10,'Indoor_Kitchen','',NULL,0,'',0,100),
                    (11,'Sauna','',NULL,0,'',0,100),
                    (12,'Trees_and_Landscaping','',NULL,0,'',0,100);
            ");
        }

        if (true) // Defined Specifications
        {
            $this->db->query("DROP TABLE IF EXISTS `{$database_prefix}definedspecification`;");
            $this->db->query("CREATE TABLE `{$database_prefix}definedspecification` (
                `Id` int(11) NOT NULL AUTO_INCREMENT,
                `Name` varchar(50) NOT NULL,
                `Descriptions` varchar(512) NOT NULL,
                `IsDeleted` tinyint(1) DEFAULT '0',
                PRIMARY KEY (`Id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
            ");
            $this->db->query("INSERT INTO `{$database_prefix}definedspecification` 
                VALUES 
                    (1,'Bedrooms','',0),
                    (2,'Bathrooms','',0),
                    (3,'Rooms','',1),
                    (4,'Garages','',0),
                    (5,'Area','',0),
                    (6,'LandArea','',0),
                    (7,'BuildingArea','',0);
            ");
        }
        
        if (true) // Defined Types
        {
            $this->db->query("DROP TABLE IF EXISTS `{$database_prefix}definedtype`;");
            $this->db->query("CREATE TABLE `{$database_prefix}definedtype` (
                `Id` int(11) NOT NULL AUTO_INCREMENT,
                `Name` varchar(128) NOT NULL,
                `Icon` varchar(255) NOT NULL,
                `IsDeleted` tinyint(1) NOT NULL DEFAULT '0',
                PRIMARY KEY (`Id`) USING BTREE
            ) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 
            COMMENT='Property Types: Land/House/Apartment';
            ");
            $this->db->query("INSERT INTO `{$database_prefix}definedtype` 
                VALUES 
                    (1,'House','assets/icons/real-estate/house.png',0),
                    (2,'Town_House','assets/icons/real-estate/townhouse.png',0),
                    (3,'Apartment','assets/icons/real-estate/apartment-3.png',0),
                    (4,'Condominium','assets/icons/real-estate/condominium.png',0),
                    (5,'Office_Building','assets/icons/real-estate/office-building.png',0),
                    (6,'Land','assets/icons/real-estate/land.png',0);
            ");
        }

        if (true) // Gallery
        {
            $this->db->query("DROP TABLE IF EXISTS `{$database_prefix}gallery`;");
            $this->db->query("CREATE TABLE `{$database_prefix}gallery` (
                `Id` int(11) NOT NULL AUTO_INCREMENT,
                `PropertyId` int(11) NOT NULL,
                `ImageName` varchar(255) NOT NULL,
                `ImageUrl` varchar(1024) NOT NULL,
                `CreatedOn` datetime NOT NULL,
                `CreatedBy` varchar(64) NOT NULL,
                `ModifiedOn` datetime NOT NULL,
                `ModifiedBy` varchar(64) NOT NULL,
                `Comments` varchar(512) NOT NULL,
                `DisplayNum` int(11) NOT NULL,
                `IsDeleted` tinyint(1) NOT NULL DEFAULT '0',
                `IsFloorplan` tinyint(1) NOT NULL DEFAULT '0',
                PRIMARY KEY (`Id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;
            ");
            $this->db->query("INSERT INTO `{$database_prefix}gallery` 
                VALUES 
                (1,1,'','assets/img/items/real-estate/6.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (2,1,'','assets/img/items/real-estate/5.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (3,1,'','assets/img/items/real-estate/4.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (4,2,'','assets/img/items/real-estate/12.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (5,2,'','assets/img/items/real-estate/3.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (6,2,'','assets/img/items/real-estate/5.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (7,3,'','assets/img/items/real-estate/1.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (8,3,'','assets/img/items/real-estate/1.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (9,3,'','assets/img/items/real-estate/6.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (10,4,'','assets/img/items/real-estate/8.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (11,4,'','assets/img/items/real-estate/10.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (12,4,'','assets/img/items/real-estate/9.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (13,5,'','assets/img/items/real-estate/9.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (14,5,'','assets/img/items/real-estate/9.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (15,5,'','assets/img/items/real-estate/10.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (16,6,'','assets/img/items/real-estate/2.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (17,6,'','assets/img/items/real-estate/10.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (18,6,'','assets/img/items/real-estate/11.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (19,7,'','assets/img/items/real-estate/7.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (20,7,'','assets/img/items/real-estate/10.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (21,7,'','assets/img/items/real-estate/11.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (22,8,'','assets/img/items/real-estate/11.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (23,8,'','assets/img/items/real-estate/10.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (24,8,'','assets/img/items/real-estate/12.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (25,9,'','assets/img/items/real-estate/2.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (26,9,'','assets/img/items/real-estate/11.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (27,9,'','assets/img/items/real-estate/12.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (28,10,'','assets/img/items/real-estate/3.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (29,10,'','assets/img/items/real-estate/11.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (30,10,'','assets/img/items/real-estate/12.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (31,11,'','assets/img/items/real-estate/4.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (32,11,'','assets/img/items/real-estate/11.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (33,11,'','assets/img/items/real-estate/12.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (34,12,'','assets/img/items/real-estate/5.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (35,12,'','assets/img/items/real-estate/2.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (36,12,'','assets/img/items/real-estate/5.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (37,13,'','assets/img/items/real-estate/6.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (38,13,'','assets/img/items/real-estate/2.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (39,13,'','assets/img/items/real-estate/5.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (40,14,'','assets/img/items/real-estate/8.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (41,14,'','assets/img/items/real-estate/2.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (42,14,'','assets/img/items/real-estate/5.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (43,15,'','assets/img/items/real-estate/9.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (44,15,'','assets/img/items/real-estate/2.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (45,15,'','assets/img/items/real-estate/5.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (46,16,'','assets/img/items/real-estate/10.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (47,16,'','assets/img/items/real-estate/6.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (48,16,'','assets/img/items/real-estate/5.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (49,17,'','assets/img/items/real-estate/11.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (50,17,'','assets/img/items/real-estate/4.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (51,17,'','assets/img/items/real-estate/5.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (52,18,'','assets/img/items/real-estate/12.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (53,18,'','assets/img/items/real-estate/8.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (54,18,'','assets/img/items/real-estate/5.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (55,19,'','assets/img/items/real-estate/5.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (56,19,'','assets/img/items/real-estate/8.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (57,19,'','assets/img/items/real-estate/3.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (58,20,'','assets/img/items/real-estate/6.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (59,20,'','assets/img/items/real-estate/8.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (60,20,'','assets/img/items/real-estate/3.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (61,21,'','assets/img/items/real-estate/7.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (62,21,'','assets/img/items/real-estate/8.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (63,21,'','assets/img/items/real-estate/5.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (64,22,'','assets/img/items/real-estate/10.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (65,22,'','assets/img/items/real-estate/8.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0),
                (66,22,'','assets/img/items/real-estate/5.jpg','2017-12-20 00:00:00','','2017-12-20 00:00:00','','',0,0,0);
            ");
        }

        if (true) // People
        {
            $this->db->query("DROP TABLE IF EXISTS `{$database_prefix}people`;");
            $this->db->query("CREATE TABLE `{$database_prefix}people` (
                `Id` int(11) NOT NULL AUTO_INCREMENT,
                `RoleType` int(11) NOT NULL DEFAULT '1' COMMENT '1:agent;2:owner;',
                `Name` varchar(45) DEFAULT NULL,
                `Phone` varchar(45) DEFAULT NULL,
                `Mobile` varchar(45) DEFAULT NULL,
                `Email` varchar(45) DEFAULT NULL,
                `Position` varchar(45) DEFAULT NULL,
                `AgencyId` int(11) DEFAULT NULL,
                `Photo` varchar(255) DEFAULT NULL,
                `IsDeleted` tinyint(4) DEFAULT '0',
                PRIMARY KEY (`Id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
            ");
            $this->db->query("INSERT INTO `{$database_prefix}people` 
                VALUES 
                (1,1,'Andrew Shields','0475 101 022','0475 101 022','andrew.shields@toop.com.au',NULL,4,'assets/icons/agents/andrew_shields.jpg',0),
                (2,1,'Anita Hardingham','0413 335 706','0413 335 706','anita.hardingham@toop.com.au',NULL,4,'assets/icons/agents/anita_hardingham.jpg',0),
                (3,1,'Becky Neale','0417 832 549','0417 832 549','becky.neale@toop.com.au',NULL,4,'assets/icons/agents/becky_neale.jpg',0),
                (4,1,'Bronte Manuel','0439 828 882','0439 828 882','bronte.manuel@toop.com.au',NULL,4,'assets/icons/agents/bronte_manuel.jpg',0),
                (5,1,'Joseph Marriott','0488 451 773','0488 451 773','joseph.marriott@toop.com.au',NULL,4,'assets/icons/agents/joseph_marriott.jpg',0),
                (6,1,'Brett Pilgrim','432 401 010','432 401 010','brett.pilgrim@raywhite.com',NULL,1,'assets/icons/agents/Brett_Pilgrim.jpg',0),
                (7,1,'Tess Mattner','414 388 633','414 388 633','tess.mattner@raywhite.com',NULL,1,'assets/icons/agents/Tess_Mattner.jpg',0),
                (8,1,'Jed Redden','437 059 580','437 059 580','jed.redden@raywhite.com',NULL,1,'assets/icons/agents/Jed_Redden.jpg',0),
                (9,1,'Ariana Crowley','84493330','409 093 321','ariana.crowley@harcourts.com.au',NULL,2,'assets/icons/agents/Ariana_Crowley.jpg',0),
                (10,1,'Andrew Stephens','89521722','439 337 380','andrew.stephens@landmark.com.au',NULL,2,'assets/icons/agents/Andrew_Stephens.jpg',0),
                (11,1,'Barry Spice','413 517 963','413 517 963','barry@hcby.com.au',NULL,2,'assets/icons/agents/Barry_Spice.jpg',0),
                (12,1,'Belinda Hocking','422 236 946','422 236 946','belinda.hocking@landmarkharcourts.com.au',NULL,2,'assets/icons/agents/Belinda_Hocking.jpg',0),
                (13,1,'Tony Che','412 536 489','412 536 489','tony.che@harcourts.com.au',NULL,3,'assets/icons/agents/Tony_Che.jpg',0),
                (14,1,'Ashlea Minihan','433 666 784','433 666 784','mornington@harcourts.com.au',NULL,3,'assets/icons/agents/Ashlea_Minihan.jpg',0),
                (15,1,'Amanda Mills','411 225 665','411 225 665','amanda.mills@harcourtsalliance.com.au',NULL,3,'assets/icons/agents/Amanda_Mills.jpg',0);
            ");
        }

        
        if (true) // aauth_users
        {
            // sample users with fake passwords
            $this->db->query("INSERT INTO `{$database_prefix}aauth_users`(roletype, pass, name, phone, mobile, email, position, agencyId, photo, banned) 
                VALUES 
                (1, '85331630fca2b67c234b6b57e7affc9403d62cf186989c71675956e3ccc2a20d', 'Andrew Shields','0475 101 022','0475 101 022','andrew.shields@toop.com.au',NULL,4,'assets/icons/agents/andrew_shields.jpg',0),
                (1, '85331630fca2b67c234b6b57e7affc9403d62cf186989c71675956e3ccc2a20d', 'Anita Hardingham','0413 335 706','0413 335 706','anita.hardingham@toop.com.au',NULL,4,'assets/icons/agents/anita_hardingham.jpg',0),
                (1, '85331630fca2b67c234b6b57e7affc9403d62cf186989c71675956e3ccc2a20d', 'Becky Neale','0417 832 549','0417 832 549','becky.neale@toop.com.au',NULL,4,'assets/icons/agents/becky_neale.jpg',0),
                (1, '85331630fca2b67c234b6b57e7affc9403d62cf186989c71675956e3ccc2a20d', 'Bronte Manuel','0439 828 882','0439 828 882','bronte.manuel@toop.com.au',NULL,4,'assets/icons/agents/bronte_manuel.jpg',0),
                (1, '85331630fca2b67c234b6b57e7affc9403d62cf186989c71675956e3ccc2a20d', 'Joseph Marriott','0488 451 773','0488 451 773','joseph.marriott@toop.com.au',NULL,4,'assets/icons/agents/joseph_marriott.jpg',0),
                (1, '85331630fca2b67c234b6b57e7affc9403d62cf186989c71675956e3ccc2a20d', 'Brett Pilgrim','432 401 010','432 401 010','brett.pilgrim@raywhite.com',NULL,1,'assets/icons/agents/Brett_Pilgrim.jpg',0),
                (1, '85331630fca2b67c234b6b57e7affc9403d62cf186989c71675956e3ccc2a20d', 'Tess Mattner','414 388 633','414 388 633','tess.mattner@raywhite.com',NULL,1,'assets/icons/agents/Tess_Mattner.jpg',0),
                (1, '85331630fca2b67c234b6b57e7affc9403d62cf186989c71675956e3ccc2a20d', 'Jed Redden','437 059 580','437 059 580','jed.redden@raywhite.com',NULL,1,'assets/icons/agents/Jed_Redden.jpg',0),
                (1, '85331630fca2b67c234b6b57e7affc9403d62cf186989c71675956e3ccc2a20d', 'Ariana Crowley','84493330','409 093 321','ariana.crowley@harcourts.com.au',NULL,2,'assets/icons/agents/Ariana_Crowley.jpg',0),
                (1, '85331630fca2b67c234b6b57e7affc9403d62cf186989c71675956e3ccc2a20d', 'Andrew Stephens','89521722','439 337 380','andrew.stephens@landmark.com.au',NULL,2,'assets/icons/agents/Andrew_Stephens.jpg',0),
                (1, '85331630fca2b67c234b6b57e7affc9403d62cf186989c71675956e3ccc2a20d', 'Barry Spice','413 517 963','413 517 963','barry@hcby.com.au',NULL,2,'assets/icons/agents/Barry_Spice.jpg',0),
                (1, '85331630fca2b67c234b6b57e7affc9403d62cf186989c71675956e3ccc2a20d', 'Belinda Hocking','422 236 946','422 236 946','belinda.hocking@landmarkharcourts.com.au',NULL,2,'assets/icons/agents/Belinda_Hocking.jpg',0),
                (1, '85331630fca2b67c234b6b57e7affc9403d62cf186989c71675956e3ccc2a20d', 'Tony Che','412 536 489','412 536 489','tony.che@harcourts.com.au',NULL,3,'assets/icons/agents/Tony_Che.jpg',0),
                (1, '85331630fca2b67c234b6b57e7affc9403d62cf186989c71675956e3ccc2a20d', 'Ashlea Minihan','433 666 784','433 666 784','mornington@harcourts.com.au',NULL,3,'assets/icons/agents/Ashlea_Minihan.jpg',0),
                (1, '85331630fca2b67c234b6b57e7affc9403d62cf186989c71675956e3ccc2a20d', 'Amanda Mills','411 225 665','411 225 665','amanda.mills@harcourtsalliance.com.au',NULL,3,'assets/icons/agents/Amanda_Mills.jpg',0)
            ");

            // setup user's group
            $this->db->query("INSERT INTO `{$database_prefix}aauth_user_to_group`
                            VALUES(2, 6),
                            (3, 6),
                            (4, 6),
                            (5, 6),
                            (6, 6),
                            (7, 6),
                            (8, 6),
                            (9, 6),
                            (10, 6),
                            (11, 6),
                            (12, 6),
                            (13, 6),
                            (14, 6),
                            (15, 6),
                            (16, 6)           
            ");
        }
        

        if (true) // Property
        {
            $this->db->query("DROP TABLE IF EXISTS `{$database_prefix}property`;");
            $this->db->query("CREATE TABLE `{$database_prefix}property` (
                `Id` int(11) NOT NULL AUTO_INCREMENT,
                `Category` varchar(50) NOT NULL,
                `Address` varchar(512) NOT NULL,
                `Location` varchar(128) NOT NULL,
                `Latitude` decimal(18,6) NOT NULL,
                `Longitude` decimal(18,6) NOT NULL,
                `TypeId` int(11) NOT NULL,
                `Rating` int(11) NOT NULL,
                `CreatedOn` datetime NOT NULL,
                `Price` decimal(10,0) NOT NULL,
                `Featured` tinyint(1) NOT NULL,
                `Color` varchar(50) NOT NULL,
                `PersonId` int(11) NOT NULL,
                `BuiltYear` int(11) NOT NULL,
                `SpecialOffer` int(11) NOT NULL,
                `AgencyId` int(11) NOT NULL,
                `IsDeleted` int(11) NOT NULL,
                `Description` text NOT NULL,
                `guid` varchar(255) DEFAULT NULL,
                `StatusId` int(11) DEFAULT NULL,
                PRIMARY KEY (`Id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
            ");
            $this->db->query("INSERT INTO `{$database_prefix}property` 
                VALUES 
                (1,'1','3295 Valley Street','Collinsville',51.541599,-0.112588,1,4,'2014-11-04 00:00:00',210000,0,'',3,1980,0,4,0,'Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis. Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae, euismod arcu.', '000000-00000-00000', 1),
                (2,'1','534 Roosevelt Way','San Francisco',51.538395,-0.097418,1,4,'2014-11-05 00:00:00',220000,1,'',6,1980,0,1,0,'Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis. Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae, euismod arcu.', '000000-00000-00000', 1),
                (3,'2','3019 White Avenue','Corpus Christi',51.551489,-0.067077,2,5,'2014-11-06 00:00:00',230000,0,'',7,1980,0,1,0,'Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis. Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae, euismod arcu.', '000000-00000-00000', 1),
                (4,'1','1882 Trainer Avenue','Louisville',51.539212,-0.118403,3,5,'2014-11-07 00:00:00',240000,0,'',9,1980,0,2,0,'Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis. Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae, euismod arcu.', '000000-00000-00000', 1),
                (5,'1','4020 Neville Street','Salem',51.522340,-0.037894,3,5,'2014-11-08 00:00:00',250000,0,'',10,1980,0,2,0,'Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis. Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae, euismod arcu.', '000000-00000-00000', 1),
                (6,'2','2330 Hampton Meadows','South Boston',51.513965,-0.038837,3,3,'2014-11-09 00:00:00',260000,0,'',11,1980,0,2,0,'Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis. Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae, euismod arcu.', '000000-00000-00000', 1),
                (7,'1','4552 Lynn Avenue','Eau Claire',51.503965,-0.058837,1,3,'2014-11-10 00:00:00',270000,1,'',13,1980,0,3,0,'Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis. Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae, euismod arcu.', '000000-00000-00000', 1),
                (8,'1','3645 Kenwood Place','Fort Lauderdale',51.555385,-0.128274,4,5,'2014-11-11 00:00:00',280000,0,'',8,1980,0,1,0,'Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis. Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae, euismod arcu.', '000000-00000-00000', 1),
                (9,'2','2055 Overlook Drive','Indianapolis',51.560935,-0.111365,1,5,'2014-11-12 00:00:00',290000,0,'',5,1980,0,4,0,'Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis. Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae, euismod arcu.', '000000-00000-00000', 1),
                (10,'1','2494 Nancy Street','Wake Forest',51.530189,-0.078750,2,5,'2014-11-13 00:00:00',300000,0,'',4,1980,0,4,0,'Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis. Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae, euismod arcu.', '000000-00000-00000', 1),
                (11,'1','4922 Central Avenue','Newark',51.543803,-0.036607,1,4,'2014-11-14 00:00:00',310000,0,'',2,1980,0,4,0,'Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis. Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae, euismod arcu.', '000000-00000-00000', 1),
                (12,'2','3316 West Virginia Avenue','Mineville',51.528334,-0.105012,4,4,'2014-11-15 00:00:00',320000,1,'',6,1980,0,1,0,'Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis. Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae, euismod arcu.', '000000-00000-00000', 1),
                (13,'1','1634 Winding Way','Pawtucket',51.527306,-0.140977,1,4,'2014-11-16 00:00:00',330000,0,'',4,1980,0,4,0,'Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis. Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae, euismod arcu.', '000000-00000-00000', 1),
                (14,'1','4692 Lynn Ogden Lane','Beaumont',51.545244,-0.070939,4,4,'2014-11-17 00:00:00',340000,0,'',15,1980,0,3,0,'Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis. Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae, euismod arcu.', '000000-00000-00000', 1),
                (15,'2','1036 Fairmont Avenue','Trenton',51.558907,-0.041842,5,4,'2014-11-18 00:00:00',350000,0,'',14,1980,0,3,0,'Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis. Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae, euismod arcu.', '000000-00000-00000', 1),
                (16,'1','4808 McDonald Avenue','Orlando',51.551026,-0.102321,5,4,'2014-11-19 00:00:00',360000,0,'',12,1980,0,2,0,'Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis. Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae, euismod arcu.', '000000-00000-00000', 1),
                (17,'1','3858 Brannon Street','Los Angeles',51.550644,-0.103493,2,4,'2014-11-20 00:00:00',370000,0,'',7,1980,0,1,0,'Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis. Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae, euismod arcu.', '000000-00000-00000', 1),
                (18,'2','4366 Emerson Road','Monroe',51.532112,-0.051885,6,4,'2014-11-21 00:00:00',380000,1,'',6,1980,0,1,0,'Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis. Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae, euismod arcu.', '000000-00000-00000', 1),
                (19,'1','Big Luxury Apartment','Portland',51.531364,-0.054545,2,5,'2014-11-22 00:00:00',390000,0,'',5,1980,0,4,0,'Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis. Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae, euismod arcu.', '000000-00000-00000', 1),
                (20,'1','4261 Providence Lane','Los Angeles',51.531311,-0.052314,3,5,'2014-11-23 00:00:00',400000,1,'',4,1980,0,4,0,'Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis. Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae, euismod arcu.', '000000-00000-00000', 1),
                (21,'2','Big Luxury Apartment','Philadelphia',51.530189,-0.078750,3,5,'2014-11-24 00:00:00',410000,0,'',3,1980,0,4,0,'Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis. Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae, euismod arcu.', '000000-00000-00000', 1),
                (22,'1','Family Flat','Philadelphia',51.530189,-0.078750,3,5,'2014-11-25 00:00:00',420000,0,'',1,1980,0,4,0,'Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis. Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae, euismod arcu.', '000000-00000-00000', 1);
            ");
        }

        if (true) // Property Feature
        {
            $this->db->query("DROP TABLE IF EXISTS `{$database_prefix}propertyfeature`;");
            $this->db->query("CREATE TABLE `{$database_prefix}propertyfeature` (
                `Id` int(11) NOT NULL AUTO_INCREMENT,
                `PropertyId` int(11) NOT NULL,
                `FeatureId` int(11) NOT NULL,
                `Descriptions` int(11) NOT NULL,
                `Image` int(11) NOT NULL,
                `IsDeleted` tinyint(1) NOT NULL DEFAULT '0',
                PRIMARY KEY (`Id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
            ");
            $this->db->query("INSERT INTO `{$database_prefix}propertyfeature` 
                VALUES 
                (1,1,1,0,0,0),(2,1,2,0,0,0),(3,1,3,0,0,0),(6,1,6,0,0,0),(11,1,12,0,0,0),(13,2,2,0,0,0),(17,2,6,0,0,0),(19,2,8,0,0,0),(22,2,12,0,0,0),(23,3,1,0,0,0),(26,3,4,0,0,0),(29,3,7,0,0,0),(31,3,9,0,0,0),(33,3,12,0,0,0),(34,4,1,0,0,0),(37,4,4,0,0,0),(38,4,5,0,0,0),(39,4,6,0,0,0),(41,4,8,0,0,0),(43,4,11,0,0,0),(46,5,2,0,0,0),(47,5,3,0,0,0),(51,5,7,0,0,0),(53,5,9,0,0,0),(57,6,2,0,0,0),(58,6,3,0,0,0),(59,6,4,0,0,0),(61,6,6,0,0,0),(62,6,7,0,0,0),(66,6,12,0,0,0),(67,7,1,0,0,0),(69,7,3,0,0,0),(71,7,5,0,0,0),(73,7,7,0,0,0),(74,7,8,0,0,0),(78,8,1,0,0,0),(79,8,2,0,0,0),(82,8,5,0,0,0),(83,8,6,0,0,0),(86,8,9,0,0,0),(87,8,11,0,0,0),(89,9,1,0,0,0),(93,9,5,0,0,0),(94,9,6,0,0,0),(97,9,9,0,0,0),(101,10,2,0,0,0),(102,10,3,0,0,0),(103,10,4,0,0,0),(106,10,7,0,0,0),(107,10,8,0,0,0),(109,10,11,0,0,0),(111,11,1,0,0,0),(113,11,3,0,0,0),(114,11,4,0,0,0),(118,11,8,0,0,0),(121,11,12,0,0,0),(122,12,1,0,0,0),(123,12,2,0,0,0),(127,12,6,0,0,0),(129,12,8,0,0,0),(131,12,11,0,0,0),(134,13,2,0,0,0),(137,13,5,0,0,0),(138,13,6,0,0,0),(139,13,7,0,0,0),(141,13,9,0,0,0),(142,13,11,0,0,0),(143,13,12,0,0,0),(146,14,3,0,0,0),(149,14,6,0,0,0),(151,14,8,0,0,0),(157,15,3,0,0,0),(158,15,4,0,0,0),(159,15,5,0,0,0),(163,15,9,0,0,0),(166,16,1,0,0,0),(167,16,2,0,0,0),(169,16,4,0,0,0),(173,16,8,0,0,0),(174,16,9,0,0,0),(177,17,1,0,0,0),(178,17,2,0,0,0),(179,17,3,0,0,0),(181,17,5,0,0,0),(183,17,7,0,0,0),(186,17,11,0,0,0),(187,17,12,0,0,0),(191,18,4,0,0,0),(193,18,6,0,0,0),(194,18,7,0,0,0),(197,18,11,0,0,0),(199,19,1,0,0,0),(201,19,3,0,0,0),(202,19,4,0,0,0),(206,19,8,0,0,0),(209,19,12,0,0,0),(211,20,2,0,0,0),(213,20,4,0,0,0),(214,20,5,0,0,0),(218,20,9,0,0,0),(219,20,11,0,0,0),(221,21,1,0,0,0),(222,21,2,0,0,0),(223,21,3,0,0,0),(226,21,6,0,0,0),(227,21,7,0,0,0),(229,21,9,0,0,0),(233,22,2,0,0,0),(237,22,6,0,0,0),(239,22,8,0,0,0),(241,22,11,0,0,0),(242,22,12,0,0,0);
            ");
        }

        if (true) // Property Specifications
        { 
            $this->db->query("DROP TABLE IF EXISTS `{$database_prefix}propertyspec`;");
            $this->db->query("CREATE TABLE `{$database_prefix}propertyspec` (
                `Id` int(11) NOT NULL AUTO_INCREMENT,
                `PropertyId` int(11) NOT NULL,
                `SpecId` int(11) NOT NULL,
                `SpecValue` int(11) NOT NULL,
                `IsDeleted` int(11) NOT NULL,
                PRIMARY KEY (`Id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
            ");
            $this->db->query("INSERT INTO `{$database_prefix}propertyspec` 
                VALUES 
                (1,1,1,2,0),(2,1,2,2,0),(3,1,3,4,0),(4,1,4,1,0),(5,1,5,240,0),(6,1,6,0,0),(7,1,7,0,0),(8,2,1,1,0),(9,2,2,1,0),(10,2,3,3,0),(11,2,4,1,0),(12,2,5,140,0),(13,2,6,0,0),(14,2,7,0,0),(15,3,1,3,0),(16,3,2,5,0),(17,3,3,3,0),(18,3,4,2,0),(19,3,5,385,0),(20,3,6,0,0),(21,3,7,0,0),(22,4,1,2,0),(23,4,2,1,0),(24,4,3,3,0),(25,4,4,1,0),(26,4,5,168,0),(27,4,6,0,0),(28,4,7,0,0),(29,5,1,3,0),(30,5,2,4,0),(31,5,3,6,0),(32,5,4,3,0),(33,5,5,700,0),(34,5,6,0,0),(35,5,7,0,0),(36,6,1,2,0),(37,6,2,1,0),(38,6,3,3,0),(39,6,4,1,0),(40,6,5,300,0),(41,6,6,0,0),(42,6,7,0,0),(43,7,1,2,0),(44,7,2,1,0),(45,7,3,3,0),(46,7,4,1,0),(47,7,5,300,0),(48,7,6,0,0),(49,7,7,0,0),(50,8,1,2,0),(51,8,2,1,0),(52,8,3,3,0),(53,8,4,1,0),(54,8,5,300,0),(55,8,6,0,0),(56,8,7,0,0),(57,9,1,2,0),(58,9,2,1,0),(59,9,3,3,0),(60,9,4,1,0),(61,9,5,300,0),(62,9,6,0,0),(63,9,7,0,0),(64,10,1,2,0),(65,10,2,1,0),(66,10,3,3,0),(67,10,4,1,0),(68,10,5,300,0),(69,10,6,0,0),(70,10,7,0,0),(71,11,1,1,0),(72,11,2,2,0),(73,11,3,2,0),(74,11,4,1,0),(75,11,5,400,0),(76,11,6,0,0),(77,11,7,0,0),(78,12,1,1,0),(79,12,2,2,0),(80,12,3,2,0),(81,12,4,1,0),(82,12,5,400,0),(83,12,6,0,0),(84,12,7,0,0),(85,13,1,1,0),(86,13,2,2,0),(87,13,3,2,0),(88,13,4,1,0),(89,13,5,400,0),(90,13,6,0,0),(91,13,7,0,0),(92,14,1,1,0),(93,14,2,2,0),(94,14,3,2,0),(95,14,4,1,0),(96,14,5,400,0),(97,14,6,0,0),(98,14,7,0,0),(99,15,1,1,0),(100,15,2,2,0),(101,15,3,2,0),(102,15,4,1,0),(103,15,5,400,0),(104,15,6,0,0),(105,15,7,0,0),(106,16,1,1,0),(107,16,2,2,0),(108,16,3,2,0),(109,16,4,1,0),(110,16,5,400,0),(111,16,6,0,0),(112,16,7,0,0),(113,17,1,1,0),(114,17,2,2,0),(115,17,3,2,0),(116,17,4,1,0),(117,17,5,400,0),(118,17,6,0,0),(119,17,7,0,0),(120,18,1,1,0),(121,18,2,2,0),(122,18,3,2,0),(123,18,4,1,0),(124,18,5,400,0),(125,18,6,0,0),(126,18,7,0,0),(127,19,1,1,0),(128,19,2,2,0),(129,19,3,2,0),(130,19,4,1,0),(131,19,5,400,0),(132,19,6,0,0),(133,19,7,0,0),(134,20,1,1,0),(135,20,2,2,0),(136,20,3,2,0),(137,20,4,1,0),(138,20,5,400,0),(139,20,6,0,0),(140,20,7,0,0),(141,21,1,1,0),(142,21,2,2,0),(143,21,3,2,0),(144,21,4,1,0),(145,21,5,400,0),(146,21,6,0,0),(147,21,7,0,0),(148,22,1,1,0),(149,22,2,2,0),(150,22,3,2,0),(151,22,4,1,0),(152,22,5,400,0),(153,22,6,0,0),(154,22,7,0,0);
            ");
        }

        if (true) // Track Property
        {
            $this->db->query("DROP TABLE IF EXISTS `{$database_prefix}trackproperty`;");
            $this->db->query("CREATE TABLE `{$database_prefix}trackproperty` (
                `Id` int(11) NOT NULL AUTO_INCREMENT,
                `PropertyId` int(11) DEFAULT NULL,
                `Operation` varchar(45) DEFAULT NULL,
                `DetailJson` varchar(2048) DEFAULT NULL,
                `CreatedOn` datetime DEFAULT NULL,
                `CreatedBy` varchar(45) DEFAULT NULL,
                PRIMARY KEY (`Id`),
                UNIQUE KEY `Id_UNIQUE` (`Id`)
                ) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
            ");
        }
    }

    public function install_setting_tables($database_prefix)
    {
        if (true) // About Us
        {
            $this->db->query("DROP TABLE IF EXISTS `{$database_prefix}about_us`");
            $this->db->query("CREATE TABLE `{$database_prefix}about_us` (
                    `Id` int(11) NOT NULL,
                    `Lang` varchar(20) NOT NULL,
                    `Title` varchar(512) NOT NULL,
                    `Descriptions` varchar(4096) NOT NULL,
                    `BackgroundImage` varchar(4096) NOT NULL,
                    `BackgroundText` varchar(4096) NOT NULL
                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            ");
            $this->db->query("INSERT INTO `{$database_prefix}agency` 
                VALUES 
                (1, 'en', 'THE BEST REAL ESTATE SITE IN SYRIA', 'Bootstrap tabs are components which separate content placed in the same wrapper, but in the separate pane. Only one pane can be displayed at the time.', '', ''),
                (2, 'ar', '', '', '', ''),
                (3, 'cn', '', '', '', '');");
        }

        if (true) // Contact
        {
            $this->db->query("DROP TABLE IF EXISTS `{$database_prefix}contact`");
            $this->db->query("CREATE TABLE `{$database_prefix}contact` (
                   `Id` int(11) NOT NULL,
                   `Lang` varchar(20) NOT NULL,
                   `CompanyName` varchar(128) NOT NULL,
                   `Address1` varchar(512) NOT NULL,
                   `Address2` varchar(512) NOT NULL,
                   `Phone` varchar(50) NOT NULL,
                   `Mobile` varchar(128) NOT NULL,
                   `Email` varchar(512) NOT NULL,
                   `Website` varchar(512) NOT NULL,
                   `Twitter` varchar(512) NOT NULL,
                   `Facebook` varchar(512) NOT NULL,
                   `Pinterest` varchar(512) NOT NULL
                 ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            ");
            $this->db->query("INSERT INTO `{$database_prefix}agency` 
                VALUES 
                (1, 'en', 'Brick Services PTY LTD.', '911 Event St', 'Washington, 20341', '08 9600000', '61433999888', 'mouris@brickservices.com', 'http://www.badluck.com', 'http://', 'http://', 'http://'),
                (2, 'ar', '', '', '', '', '', '', '', '', '', ''),
                (3, 'cn', '', '', '', '', '', '', '', '', '', '');
            ");
        }
    }

    /**
     * Create a config file
     *
     * @param Array config data
     * @return Void
    **/

    public function create_config_file($config)
    {
        /* CREATE CONFIG FILE */
        $string_config =
        "<?php
/**
 * Database configuration for Syrian Properties
 * -------------------------------------
 * Tendoo Version : " . get('core_version') . "
**/

defined('BASEPATH') OR exit('No direct script access allowed');

\$active_group = 'default';
\$query_builder = TRUE;

\$db['default']['hostname'] = '".$config['hostname']."';
\$db['default']['username'] = '".$config['username']."';
\$db['default']['password'] = '".$config['password']."';
\$db['default']['database'] = '".$config['database']."';
\$db['default']['dbdriver'] = '".$config['dbdriver']."';
\$db['default']['dbprefix'] = '".$config['dbprefix']."';
\$db['default']['pconnect'] = FALSE;
\$db['default']['db_debug'] = TRUE;
\$db['default']['cache_on'] = FALSE;
\$db['default']['cachedir'] = 'application/cache/database/';
\$db['default']['char_set'] = 'utf8';
\$db['default']['dbcollat'] = 'utf8_general_ci';
\$db['default']['swap_pre'] = '';
\$db['default']['autoinit'] = TRUE;
\$db['default']['stricton'] = FALSE;

if(!defined('DB_PREFIX'))
{
	define('DB_PREFIX',\$db['default']['dbprefix']);
}";
        $file = fopen(APPPATH . 'config/database.php', 'w+');
        fwrite($file, $string_config);
        fclose($file);
    }

    /**
     * Final Configuration
     *
     * @param string Site Name
     * @return mixed
    **/

    public function final_configuration($site_name)
    {
        // Saving Site name
        $this->options->set('site_name', $this->input->post('site_name'), true);

        // Do actions
        $this->events->do_action('tendoo_settings_final_config');

        // user can change this behaviors
        return $this->events->apply_filters('validating_tendoo_setup', 'tendoo-installed');
    }

    /**
     * Is installed
     * @return bool
    **/

    public function is_installed()
    {
        global $IsInstalled;

        if ($IsInstalled != null) {
            return $IsInstalled;
        }

        if (file_exists(APPPATH . 'config/database.php')) {
            $this->load->database();
            if ($this->db->table_exists('options')) {
                $this->db->close();
                $IsInstalled    =    true;
                return $IsInstalled;
            }
            $this->db->close();
        }
        $IsInstalled    =    false;
        return $IsInstalled;
    }
}
