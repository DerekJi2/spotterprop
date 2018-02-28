-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2018 at 01:51 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forge`
--

-- --------------------------------------------------------

--
-- Table structure for table `tc_aauth_groups`
--

CREATE TABLE `tc_aauth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `definition` text,
  `description` text,
  `is_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tc_aauth_groups`
--

INSERT INTO `tc_aauth_groups` (`id`, `name`, `definition`, `description`, `is_admin`) VALUES
(4, 'master', 'Admin', 'Can create users, install modules, manage options', 1),
(5, 'administrator', 'Editors', 'Can install modules, manage options', 1),
(6, 'user', 'Users', 'Just a user', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tc_aauth_perms`
--

CREATE TABLE `tc_aauth_perms` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `definition` text,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tc_aauth_perms`
--

INSERT INTO `tc_aauth_perms` (`id`, `name`, `definition`, `description`) VALUES
(1, 'manage_core', 'Manage Core', 'Allow core management'),
(2, 'create_options', 'Create Options', 'Allow option creation'),
(3, 'edit_options', 'Edit Options', 'Allow option edition'),
(4, 'read_options', 'Read Options', 'Allow option read'),
(5, 'delete_options', 'Delete Options', 'Allow option deletion.'),
(6, 'install_modules', 'Install Modules', 'Let user install modules.'),
(7, 'update_modules', 'Update Modules', 'Let user update modules'),
(8, 'delete_modules', 'Delete Modules', 'Let user delete modules'),
(9, 'toggle_modules', 'Enable/Disable Modules', 'Let user enable/disable modules'),
(10, 'extract_modules', 'Extract Modules', 'Let user extract modules'),
(11, 'create_users', 'Create Users', 'Allow create users.'),
(12, 'edit_users', 'Edit Users', 'Allow edit users.'),
(13, 'delete_users', 'Delete Users', 'Allow delete users.'),
(14, 'edit_profile', 'Create Options', 'Allow option creation'),
(15, 'create_property', 'Create Properties', 'Allow create properties'),
(16, 'edit_property', 'Edit Properties', 'Allow edit properties'),
(17, 'delete_property', 'Delete Properties', 'Allow delete properties'),
(18, 'list_property', 'List Properties', 'Allow list properties');

-- --------------------------------------------------------

--
-- Table structure for table `tc_aauth_perm_to_group`
--

CREATE TABLE `tc_aauth_perm_to_group` (
  `perm_id` int(11) UNSIGNED NOT NULL,
  `group_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tc_aauth_perm_to_group`
--

INSERT INTO `tc_aauth_perm_to_group` (`perm_id`, `group_id`) VALUES
(1, 4),
(2, 4),
(3, 4),
(4, 4),
(5, 4),
(6, 4),
(7, 4),
(8, 4),
(9, 4),
(10, 4),
(11, 4),
(11, 5),
(12, 4),
(12, 5),
(13, 4),
(13, 5),
(14, 4),
(14, 5),
(14, 6),
(15, 4),
(15, 5),
(15, 6),
(16, 4),
(16, 5),
(16, 6),
(17, 4),
(17, 5),
(17, 6),
(18, 4),
(18, 5),
(18, 6);

-- --------------------------------------------------------

--
-- Table structure for table `tc_aauth_perm_to_user`
--

CREATE TABLE `tc_aauth_perm_to_user` (
  `perm_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tc_aauth_pms`
--

CREATE TABLE `tc_aauth_pms` (
  `id` int(11) UNSIGNED NOT NULL,
  `sender_id` int(11) UNSIGNED NOT NULL,
  `receiver_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text,
  `date` datetime DEFAULT NULL,
  `read` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tc_aauth_pms`
--

INSERT INTO `tc_aauth_pms` (`id`, `sender_id`, `receiver_id`, `title`, `message`, `date`, `read`) VALUES
(1, 17, 3, 'Property Submitted', 'property in Philadelphia', '2018-02-17 04:42:45', 0),
(2, 3, 3, 'Property submitted', '3295 Valley Street, Collinsville has been submitted', '2018-02-18 05:10:13', 0),
(3, 3, 3, 'Property published', '3295 Valley Street, Collinsville has been published', '2018-02-18 05:12:54', 0),
(4, 18, 6, 'Property submitted', '534 Roosevelt Way, San Francisco has been submitted', '2018-02-18 08:09:51', 0),
(5, 18, 4, 'Property published', '666 test st, Lebanon has been published', '2018-02-18 08:09:56', 0),
(6, 18, 6, 'Property published', '534 Roosevelt Way, San Francisco has been published', '2018-02-18 08:12:03', 0),
(7, 18, 6, 'Property submitted', '3316 West Virginia Avenue, Mineville has been submitted', '2018-02-18 08:12:14', 0),
(8, 18, 6, 'Property submitted', '4366 Emerson Road, Monroe has been submitted', '2018-02-18 08:12:24', 0),
(9, 18, 4, 'Property published', '666 test st, Lebanon has been published', '2018-02-18 08:12:29', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tc_aauth_system_variables`
--

CREATE TABLE `tc_aauth_system_variables` (
  `id` int(11) UNSIGNED NOT NULL,
  `key` varchar(100) NOT NULL,
  `value` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tc_aauth_users`
--

CREATE TABLE `tc_aauth_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `banned` tinyint(1) DEFAULT '0',
  `last_login` datetime DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `last_login_attempt` datetime DEFAULT NULL,
  `forgot_exp` text,
  `remember_time` datetime DEFAULT NULL,
  `remember_exp` text,
  `verification_code` text,
  `ip_address` text,
  `login_attempts` int(11) DEFAULT '0',
  `RoleType` int(11) NOT NULL DEFAULT '1' COMMENT '1:agent;2:owner;',
  `Phone` varchar(45) DEFAULT NULL,
  `Mobile` varchar(45) DEFAULT NULL,
  `Position` varchar(45) DEFAULT NULL,
  `AgencyId` int(11) DEFAULT NULL,
  `Photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tc_aauth_users`
--

INSERT INTO `tc_aauth_users` (`id`, `email`, `pass`, `name`, `banned`, `last_login`, `last_activity`, `last_login_attempt`, `forgot_exp`, `remember_time`, `remember_exp`, `verification_code`, `ip_address`, `login_attempts`, `RoleType`, `Phone`, `Mobile`, `Position`, `AgencyId`, `Photo`) VALUES
(2, 'andrew.shields@toop.com.au', '85331630fca2b67c234b6b57e7affc9403d62cf186989c71675956e3ccc2a20d', 'Andrew Shields', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, '0475 101 022', '0475 101 022', NULL, 4, 'assets/icons/agents/andrew_shields.jpg'),
(3, 'anita.hardingham@toop.com.au', '85331630fca2b67c234b6b57e7affc9403d62cf186989c71675956e3ccc2a20d', 'Anita Hardingham', 0, '2018-02-17 05:00:55', '2018-02-17 05:00:55', NULL, NULL, '2018-02-24 00:00:00', '9sDXLq1FQyBMhbAl', NULL, '::1', NULL, 1, '0413 335 706', '0413 335 706', NULL, 4, 'assets/icons/agents/anita_hardingham.jpg'),
(4, 'becky.neale@toop.com.au', '85331630fca2b67c234b6b57e7affc9403d62cf186989c71675956e3ccc2a20d', 'Becky Neale', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, '0417 832 549', '0417 832 549', NULL, 4, 'assets/icons/agents/becky_neale.jpg'),
(5, 'bronte.manuel@toop.com.au', '85331630fca2b67c234b6b57e7affc9403d62cf186989c71675956e3ccc2a20d', 'Bronte Manuel', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, '0439 828 882', '0439 828 882', NULL, 4, 'assets/icons/agents/bronte_manuel.jpg'),
(6, 'joseph.marriott@toop.com.au', '85331630fca2b67c234b6b57e7affc9403d62cf186989c71675956e3ccc2a20d', 'Joseph Marriott', 0, '2018-02-18 08:12:37', '2018-02-18 08:12:37', NULL, NULL, '2018-02-25 00:00:00', 'lWjwkCG5YL2Jd6xu', NULL, '::1', NULL, 1, '0488 451 773', '0488 451 773', NULL, 4, 'assets/icons/agents/joseph_marriott.jpg'),
(7, 'brett.pilgrim@raywhite.com', '85331630fca2b67c234b6b57e7affc9403d62cf186989c71675956e3ccc2a20d', 'Brett Pilgrim', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, '432 401 010', '432 401 010', NULL, 1, 'assets/icons/agents/Brett_Pilgrim.jpg'),
(8, 'tess.mattner@raywhite.com', '85331630fca2b67c234b6b57e7affc9403d62cf186989c71675956e3ccc2a20d', 'Tess Mattner', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, '414 388 633', '414 388 633', NULL, 1, 'assets/icons/agents/Tess_Mattner.jpg'),
(9, 'jed.redden@raywhite.com', '85331630fca2b67c234b6b57e7affc9403d62cf186989c71675956e3ccc2a20d', 'Jed Redden', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, '437 059 580', '437 059 580', NULL, 1, 'assets/icons/agents/Jed_Redden.jpg'),
(10, 'ariana.crowley@harcourts.com.au', '85331630fca2b67c234b6b57e7affc9403d62cf186989c71675956e3ccc2a20d', 'Ariana Crowley', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, '84493330', '409 093 321', NULL, 2, 'assets/icons/agents/Ariana_Crowley.jpg'),
(11, 'andrew.stephens@landmark.com.au', '85331630fca2b67c234b6b57e7affc9403d62cf186989c71675956e3ccc2a20d', 'Andrew Stephens', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, '89521722', '439 337 380', NULL, 2, 'assets/icons/agents/Andrew_Stephens.jpg'),
(12, 'barry@hcby.com.au', '85331630fca2b67c234b6b57e7affc9403d62cf186989c71675956e3ccc2a20d', 'Barry Spice', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, '413 517 963', '413 517 963', NULL, 2, 'assets/icons/agents/Barry_Spice.jpg'),
(13, 'belinda.hocking@landmarkharcourts.com.au', '85331630fca2b67c234b6b57e7affc9403d62cf186989c71675956e3ccc2a20d', 'Belinda Hocking', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, '422 236 946', '422 236 946', NULL, 2, 'assets/icons/agents/Belinda_Hocking.jpg'),
(14, 'tony.che@harcourts.com.au', '85331630fca2b67c234b6b57e7affc9403d62cf186989c71675956e3ccc2a20d', 'Tony Che', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, '412 536 489', '412 536 489', NULL, 3, 'assets/icons/agents/Tony_Che.jpg'),
(15, 'mornington@harcourts.com.au', '85331630fca2b67c234b6b57e7affc9403d62cf186989c71675956e3ccc2a20d', 'Ashlea Minihan', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, '433 666 784', '433 666 784', NULL, 3, 'assets/icons/agents/Ashlea_Minihan.jpg'),
(16, 'amanda.mills@harcourtsalliance.com.au', '85331630fca2b67c234b6b57e7affc9403d62cf186989c71675956e3ccc2a20d', 'Amanda Mills', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, '411 225 665', '411 225 665', NULL, 3, 'assets/icons/agents/Amanda_Mills.jpg'),
(17, 'syfool@gmail.com', '1cb4df1f9cc3eff69f9fa98a554c0cac43000c0fa999e7e51bd80fc23ab644a1', 'Derek Ji', 0, '2018-02-11 02:41:08', '2018-02-11 02:41:08', NULL, NULL, '2018-02-18 00:00:00', 'uGK8Lbp61JNtqoZh', '', '::1', NULL, 1, NULL, NULL, NULL, NULL, 'user-assets/user-images/2018_02_11_02_24_45_0005a7f9b5ded185.png'),
(18, 'editor@gmail.com', '5b3a57853d818af459519d72f1c55bb1fb8cee2ff49838ff0b79b051ffe5e66d', 'EditorA', 0, '2018-02-18 08:11:50', '2018-02-18 08:11:50', NULL, NULL, '2018-02-25 00:00:00', 'mSabWc2IPM9ix5lG', '', '::1', NULL, 1, NULL, NULL, NULL, NULL, 'user-assets/user-images/2018_02_11_02_25_17_0005a7f9b7d3999a.png');

-- --------------------------------------------------------

--
-- Table structure for table `tc_aauth_user_to_group`
--

CREATE TABLE `tc_aauth_user_to_group` (
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tc_aauth_user_to_group`
--

INSERT INTO `tc_aauth_user_to_group` (`user_id`, `group_id`) VALUES
(2, 6),
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
(16, 6),
(17, 4),
(18, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tc_aauth_user_variables`
--

CREATE TABLE `tc_aauth_user_variables` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `key` varchar(100) NOT NULL,
  `value` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tc_about_us`
--

CREATE TABLE `tc_about_us` (
  `Id` int(11) NOT NULL,
  `Lang` varchar(20) NOT NULL,
  `Title` varchar(512) NOT NULL,
  `Descriptions` varchar(4096) NOT NULL,
  `BackgroundImage` varchar(4096) NOT NULL,
  `BackgroundText` varchar(4096) NOT NULL,
  `Keywords` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tc_about_us`
--

INSERT INTO `tc_about_us` (`Id`, `Lang`, `Title`, `Descriptions`, `BackgroundImage`, `BackgroundText`, `Keywords`) VALUES
(1, 'en', 'Best Real Estate Site In Syria TEST', 'The journey of finding the perfect property should be fun, exciting and full of inspiration. You shouldn’t lose all that momentum trying to work out how to finance it.', '', '', 'en key words'),
(2, 'ar', 'AR = BEST REAL ESTATE SITE IN SYRIA = AR', 'ar descriptions em em em', '', '', 'ar key words test 2'),
(3, 'cn', 'CN - 最好的房地产网站 - CN', 'CN - Descriptions -CN', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tc_agency`
--

CREATE TABLE `tc_agency` (
  `Id` int(11) NOT NULL,
  `Name` varchar(128) NOT NULL,
  `Phone` varchar(128) NOT NULL,
  `Email` varchar(128) NOT NULL,
  `Logo` varchar(512) NOT NULL,
  `Website` varchar(255) NOT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tc_agency`
--

INSERT INTO `tc_agency` (`Id`, `Name`, `Phone`, `Email`, `Logo`, `Website`, `IsDeleted`) VALUES
(1, 'Ray White', '08 1111 2222', 'service@raywhite.com.au', 'assets/icons/real-estate/raywhite.png', 'http://raywhiteadelaidegroup.com.au/', 0),
(2, 'LJ Hooker', '08 3333 4444', 'service@ljhooker.com.au', 'assets/icons/real-estate/ljhooker.png', 'https://www.ljhooker.com.au/', 0),
(3, 'Harcourts', '08 5555 6666', 'service@harcourts.com.au', 'assets/icons/real-estate/harcourts.png', 'http://harcourts.com.au/', 0),
(4, 'Toop&Toop', '08 7777 8888', 'service@toop.com.au', 'assets/icons/real-estate/toop.png', 'https://www.toop.com.au/', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tc_contact`
--

CREATE TABLE `tc_contact` (
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

--
-- Dumping data for table `tc_contact`
--

INSERT INTO `tc_contact` (`Id`, `Lang`, `CompanyName`, `Address1`, `Address2`, `Phone`, `Mobile`, `Email`, `Website`, `Twitter`, `Facebook`, `Pinterest`) VALUES
(1, 'en', 'EN - BrickService - EN', 'EN - Address  1 - EN', 'EN- Address  2 - EN', '08 1234 5678', '0411 222 333', 'mouris@brickservices.com', 'http://www.brickservices.com', 'http://', 'http://', 'http://'),
(2, 'ar', 'AR - brickservice AR', 'AR - Addr1 AR', 'AR - Addr2 AR', '08 1234 5678', '0475 101 0222', 'mouris@test.com', 'http://www.test.com', 'http://', 'http://', 'http://'),
(3, 'cn', 'cn -brickservice', 'cn- addre1', 'cn -addre2', '08 1234 5678', '0433 999 777', 'mouris@mailinator.com', 'http://www.brickservices.com', 'http://', 'http://', 'http://');

-- --------------------------------------------------------

--
-- Table structure for table `tc_definedfeature`
--

CREATE TABLE `tc_definedfeature` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Icon` varchar(255) NOT NULL,
  `Comments` text,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `DisplayName` varchar(255) NOT NULL,
  `DisplayNum` int(11) NOT NULL,
  `Importance` int(11) NOT NULL DEFAULT '100'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tc_definedfeature`
--

INSERT INTO `tc_definedfeature` (`Id`, `Name`, `Icon`, `Comments`, `IsDeleted`, `DisplayName`, `DisplayNum`, `Importance`) VALUES
(1, 'Air_Conditioning', '', NULL, 0, '', 0, 100),
(2, 'Balcony', '', NULL, 0, '', 0, 100),
(3, 'Bedding', '', NULL, 0, '', 0, 100),
(4, 'Cable_TV', '', NULL, 0, '', 0, 100),
(5, 'Dishwasher', '', NULL, 0, '', 0, 100),
(6, 'Family_Room', '', NULL, 0, '', 0, 100),
(7, 'Fireplace', '', NULL, 0, '', 0, 100),
(8, 'Grill', '', NULL, 0, '', 0, 100),
(9, 'Outdoor_Kitchen', '', NULL, 0, '', 0, 100),
(10, 'Indoor_Kitchen', '', NULL, 0, '', 0, 100),
(11, 'Sauna', '', NULL, 0, '', 0, 100),
(12, 'Trees_and_Landscaping', '', NULL, 0, '', 0, 100);

-- --------------------------------------------------------

--
-- Table structure for table `tc_definedspecification`
--

CREATE TABLE `tc_definedspecification` (
  `Id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Descriptions` varchar(512) NOT NULL,
  `IsDeleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tc_definedspecification`
--

INSERT INTO `tc_definedspecification` (`Id`, `Name`, `Descriptions`, `IsDeleted`) VALUES
(1, 'Bedrooms', '', 0),
(2, 'Bathrooms', '', 0),
(3, 'Rooms', '', 1),
(4, 'Garages', '', 0),
(5, 'Area', '', 0),
(6, 'LandArea', '', 0),
(7, 'BuildingArea', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tc_definedtype`
--

CREATE TABLE `tc_definedtype` (
  `Id` int(11) NOT NULL,
  `Name` varchar(128) NOT NULL,
  `Icon` varchar(255) NOT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Property Types: Land/House/Apartment';

--
-- Dumping data for table `tc_definedtype`
--

INSERT INTO `tc_definedtype` (`Id`, `Name`, `Icon`, `IsDeleted`) VALUES
(1, 'House', 'assets/icons/real-estate/house.png', 0),
(2, 'Town_House', 'assets/icons/real-estate/townhouse.png', 0),
(3, 'Apartment', 'assets/icons/real-estate/apartment-3.png', 0),
(4, 'Condominium', 'assets/icons/real-estate/condominium.png', 0),
(5, 'Office_Building', 'assets/icons/real-estate/office-building.png', 0),
(6, 'Land', 'assets/icons/real-estate/land.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tc_gallery`
--

CREATE TABLE `tc_gallery` (
  `Id` int(11) NOT NULL,
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
  `IsFloorplan` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tc_gallery`
--

INSERT INTO `tc_gallery` (`Id`, `PropertyId`, `ImageName`, `ImageUrl`, `CreatedOn`, `CreatedBy`, `ModifiedOn`, `ModifiedBy`, `Comments`, `DisplayNum`, `IsDeleted`, `IsFloorplan`) VALUES
(1, 1, '', 'assets/img/items/real-estate/6.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(2, 1, '', 'assets/img/items/real-estate/5.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(3, 1, '', 'assets/img/items/real-estate/4.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(4, 2, '', 'assets/img/items/real-estate/12.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(5, 2, '', 'assets/img/items/real-estate/3.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(6, 2, '', 'assets/img/items/real-estate/5.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(7, 3, '', 'assets/img/items/real-estate/1.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(8, 3, '', 'assets/img/items/real-estate/1.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(9, 3, '', 'assets/img/items/real-estate/6.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(10, 4, '', 'assets/img/items/real-estate/8.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(11, 4, '', 'assets/img/items/real-estate/10.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(12, 4, '', 'assets/img/items/real-estate/9.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(13, 5, '', 'assets/img/items/real-estate/9.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(14, 5, '', 'assets/img/items/real-estate/9.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(15, 5, '', 'assets/img/items/real-estate/10.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(16, 6, '', 'assets/img/items/real-estate/2.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(17, 6, '', 'assets/img/items/real-estate/10.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(18, 6, '', 'assets/img/items/real-estate/11.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(19, 7, '', 'assets/img/items/real-estate/7.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(20, 7, '', 'assets/img/items/real-estate/10.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(21, 7, '', 'assets/img/items/real-estate/11.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(22, 8, '', 'assets/img/items/real-estate/11.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(23, 8, '', 'assets/img/items/real-estate/10.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(25, 9, '', 'assets/img/items/real-estate/2.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(26, 9, '', 'assets/img/items/real-estate/11.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(27, 9, '', 'assets/img/items/real-estate/12.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(28, 10, '', 'assets/img/items/real-estate/3.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(29, 10, '', 'assets/img/items/real-estate/11.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(30, 10, '', 'assets/img/items/real-estate/12.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(31, 11, '', 'assets/img/items/real-estate/4.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(32, 11, '', 'assets/img/items/real-estate/11.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(33, 11, '', 'assets/img/items/real-estate/12.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(34, 12, '', 'assets/img/items/real-estate/5.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(35, 12, '', 'assets/img/items/real-estate/2.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(36, 12, '', 'assets/img/items/real-estate/5.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(37, 13, '', 'assets/img/items/real-estate/6.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(38, 13, '', 'assets/img/items/real-estate/2.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(39, 13, '', 'assets/img/items/real-estate/5.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(40, 14, '', 'assets/img/items/real-estate/8.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(41, 14, '', 'assets/img/items/real-estate/2.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(42, 14, '', 'assets/img/items/real-estate/5.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(43, 15, '', 'assets/img/items/real-estate/9.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(44, 15, '', 'assets/img/items/real-estate/2.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(45, 15, '', 'assets/img/items/real-estate/5.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(46, 16, '', 'assets/img/items/real-estate/10.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(47, 16, '', 'assets/img/items/real-estate/6.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(48, 16, '', 'assets/img/items/real-estate/5.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(49, 17, '', 'assets/img/items/real-estate/11.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(50, 17, '', 'assets/img/items/real-estate/4.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(51, 17, '', 'assets/img/items/real-estate/5.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(52, 18, '', 'assets/img/items/real-estate/12.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(53, 18, '', 'assets/img/items/real-estate/8.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(54, 18, '', 'assets/img/items/real-estate/5.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(55, 19, '', 'assets/img/items/real-estate/5.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(56, 19, '', 'assets/img/items/real-estate/8.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(57, 19, '', 'assets/img/items/real-estate/3.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(58, 20, '', 'assets/img/items/real-estate/6.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(59, 20, '', 'assets/img/items/real-estate/8.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(60, 20, '', 'assets/img/items/real-estate/3.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(61, 21, '', 'assets/img/items/real-estate/7.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(62, 21, '', 'assets/img/items/real-estate/8.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(63, 21, '', 'assets/img/items/real-estate/5.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(64, 22, '', 'assets/img/items/real-estate/10.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(65, 22, '', 'assets/img/items/real-estate/8.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(66, 22, '', 'assets/img/items/real-estate/5.jpg', '2017-12-20 00:00:00', '', '2017-12-20 00:00:00', '', '', 0, 0, 0),
(67, 23, '', 'user-assets/property-images/2018_01_31_03_09_39_0005a71ce23374fe.png', '2018-01-31 15:09:39', '0', '2018-01-31 15:09:39', '0', '', 0, 0, 0),
(68, 23, '', 'user-assets/property-images/2018_01_31_03_09_39_0005a71ce233af97.png', '2018-01-31 15:09:39', '0', '2018-01-31 15:09:39', '0', '', 0, 0, 0),
(69, 23, '', 'user-assets/property-images/2018_01_31_03_09_39_0005a71ce23ccfa9.png', '2018-01-31 15:09:39', '0', '2018-01-31 15:09:39', '0', '', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tc_options`
--

CREATE TABLE `tc_options` (
  `id` int(11) UNSIGNED NOT NULL,
  `key` varchar(200) NOT NULL,
  `value` text,
  `autoload` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `app` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tc_options`
--

INSERT INTO `tc_options` (`id`, `key`, `value`, `autoload`, `user`, `app`) VALUES
(4, 'rest_key', 'K09F0qH8tCaqZzbhTJPS25HYM6TLWJZYSr5OqeN1', 1, 0, 'system'),
(5, 'database_version', '1.1', 1, 0, 'system'),
(6, 'site_name', 'syrian.com', 1, 0, 'system'),
(7, 'first-name', '', 1, 18, 'users'),
(8, 'last-name', '', 1, 18, 'users'),
(9, 'theme-skin', 'skin-blue', 1, 18, 'users'),
(10, 'dashboard-sidebar', 'sidebar-expanded', 1, 3, 'system'),
(11, 'dashboard-sidebar', 'sidebar-expanded', 1, 17, 'system'),
(12, 'first-name', '', 1, 17, 'users'),
(13, 'last-name', '', 1, 17, 'users'),
(14, 'theme-skin', 'skin-blue', 1, 17, 'users'),
(15, 'number-per-page-listing', '5', 0, 0, 'system'),
(16, 'number-per-page-admin', '4', 0, 0, 'system');

-- --------------------------------------------------------

--
-- Table structure for table `tc_people`
--

CREATE TABLE `tc_people` (
  `Id` int(11) NOT NULL,
  `RoleType` int(11) NOT NULL DEFAULT '1' COMMENT '1:agent;2:owner;',
  `Name` varchar(45) DEFAULT NULL,
  `Phone` varchar(45) DEFAULT NULL,
  `Mobile` varchar(45) DEFAULT NULL,
  `Email` varchar(45) DEFAULT NULL,
  `Position` varchar(45) DEFAULT NULL,
  `AgencyId` int(11) DEFAULT NULL,
  `Photo` varchar(255) DEFAULT NULL,
  `IsDeleted` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tc_people`
--

INSERT INTO `tc_people` (`Id`, `RoleType`, `Name`, `Phone`, `Mobile`, `Email`, `Position`, `AgencyId`, `Photo`, `IsDeleted`) VALUES
(1, 1, 'Andrew Shields', '0475 101 022', '0475 101 022', 'andrew.shields@toop.com.au', NULL, 4, 'assets/icons/agents/andrew_shields.jpg', 0),
(2, 1, 'Anita Hardingham', '0413 335 706', '0413 335 706', 'anita.hardingham@toop.com.au', NULL, 4, 'assets/icons/agents/anita_hardingham.jpg', 0),
(3, 1, 'Becky Neale', '0417 832 549', '0417 832 549', 'becky.neale@toop.com.au', NULL, 4, 'assets/icons/agents/becky_neale.jpg', 0),
(4, 1, 'Bronte Manuel', '0439 828 882', '0439 828 882', 'bronte.manuel@toop.com.au', NULL, 4, 'assets/icons/agents/bronte_manuel.jpg', 0),
(5, 1, 'Joseph Marriott', '0488 451 773', '0488 451 773', 'joseph.marriott@toop.com.au', NULL, 4, 'assets/icons/agents/joseph_marriott.jpg', 0),
(6, 1, 'Brett Pilgrim', '432 401 010', '432 401 010', 'brett.pilgrim@raywhite.com', NULL, 1, 'assets/icons/agents/Brett_Pilgrim.jpg', 0),
(7, 1, 'Tess Mattner', '414 388 633', '414 388 633', 'tess.mattner@raywhite.com', NULL, 1, 'assets/icons/agents/Tess_Mattner.jpg', 0),
(8, 1, 'Jed Redden', '437 059 580', '437 059 580', 'jed.redden@raywhite.com', NULL, 1, 'assets/icons/agents/Jed_Redden.jpg', 0),
(9, 1, 'Ariana Crowley', '84493330', '409 093 321', 'ariana.crowley@harcourts.com.au', NULL, 2, 'assets/icons/agents/Ariana_Crowley.jpg', 0),
(10, 1, 'Andrew Stephens', '89521722', '439 337 380', 'andrew.stephens@landmark.com.au', NULL, 2, 'assets/icons/agents/Andrew_Stephens.jpg', 0),
(11, 1, 'Barry Spice', '413 517 963', '413 517 963', 'barry@hcby.com.au', NULL, 2, 'assets/icons/agents/Barry_Spice.jpg', 0),
(12, 1, 'Belinda Hocking', '422 236 946', '422 236 946', 'belinda.hocking@landmarkharcourts.com.au', NULL, 2, 'assets/icons/agents/Belinda_Hocking.jpg', 0),
(13, 1, 'Tony Che', '412 536 489', '412 536 489', 'tony.che@harcourts.com.au', NULL, 3, 'assets/icons/agents/Tony_Che.jpg', 0),
(14, 1, 'Ashlea Minihan', '433 666 784', '433 666 784', 'mornington@harcourts.com.au', NULL, 3, 'assets/icons/agents/Ashlea_Minihan.jpg', 0),
(15, 1, 'Amanda Mills', '411 225 665', '411 225 665', 'amanda.mills@harcourtsalliance.com.au', NULL, 3, 'assets/icons/agents/Amanda_Mills.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tc_property`
--

CREATE TABLE `tc_property` (
  `Id` int(11) NOT NULL,
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
  `StatusId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tc_property`
--

INSERT INTO `tc_property` (`Id`, `Category`, `Address`, `Location`, `Latitude`, `Longitude`, `TypeId`, `Rating`, `CreatedOn`, `Price`, `Featured`, `Color`, `PersonId`, `BuiltYear`, `SpecialOffer`, `AgencyId`, `IsDeleted`, `Description`, `guid`, `StatusId`) VALUES
(1, '1', '3295 Valley Street', 'Collinsville', '51.541599', '-0.112588', 1, 4, '2014-11-04 00:00:00', '210000', 0, '', 3, 1980, 0, 4, 0, 'Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis. Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae, euismod arcu.', '000000-00000-00000', 2),
(2, '1', '534 Roosevelt Way', 'San Francisco', '51.538395', '-0.097418', 1, 4, '2014-11-05 00:00:00', '220000', 1, '', 6, 1980, 0, 1, 0, 'Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis. Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae, euismod arcu.', '000000-00000-00000', 3),
(3, '2', '3019 White Avenue', 'Corpus Christi', '51.551489', '-0.067077', 2, 5, '2014-11-06 00:00:00', '230000', 0, '', 7, 1980, 0, 1, 0, 'Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis. Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae, euismod arcu.', '000000-00000-00000', 1),
(4, '1', '1882 Trainer Avenue', 'Louisville', '51.539212', '-0.118403', 3, 5, '2014-11-07 00:00:00', '240000', 0, '', 9, 1980, 0, 2, 0, 'Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis. Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae, euismod arcu.', '000000-00000-00000', 1),
(5, '1', '4020 Neville Street', 'Salem', '51.522340', '-0.037894', 3, 5, '2014-11-08 00:00:00', '250000', 0, '', 10, 1980, 0, 2, 0, 'Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis. Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae, euismod arcu.', '000000-00000-00000', 1),
(6, '2', '2330 Hampton Meadows', 'South Boston', '51.513965', '-0.038837', 3, 3, '2014-11-09 00:00:00', '260000', 0, '', 11, 1980, 0, 2, 0, 'Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis. Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae, euismod arcu.', '000000-00000-00000', 1),
(7, '1', '4552 Lynn Avenue', 'Eau Claire', '51.503965', '-0.058837', 1, 3, '2014-11-10 00:00:00', '270000', 1, '', 13, 1980, 0, 3, 0, 'Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis. Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae, euismod arcu.', '000000-00000-00000', 1),
(8, '1', '3645 Kenwood Place', 'Fort Lauderdale', '51.555385', '-0.128274', 4, 5, '2014-11-11 00:00:00', '280000', 0, '', 8, 1980, 0, 1, 0, 'Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis. Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae, euismod arcu.', '000000-00000-00000', 1),
(9, '2', '2055 Overlook Drive', 'Indianapolis', '51.560935', '-0.111365', 1, 5, '2014-11-12 00:00:00', '290000', 0, '', 5, 1980, 0, 4, 0, 'Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis. Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae, euismod arcu.', '000000-00000-00000', 1),
(10, '1', '2494 Nancy Street', 'Wake Forest', '51.530189', '-0.078750', 2, 5, '2014-11-13 00:00:00', '300000', 0, '', 4, 1980, 0, 4, 0, 'Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis. Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae, euismod arcu.', '000000-00000-00000', 1),
(11, '1', '4922 Central Avenue', 'Newark', '51.543803', '-0.036607', 1, 4, '2014-11-14 00:00:00', '310000', 0, '', 2, 1980, 0, 4, 0, 'Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis. Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae, euismod arcu.', '000000-00000-00000', 1),
(12, '2', '3316 West Virginia Avenue', 'Mineville', '51.528334', '-0.105012', 4, 4, '2014-11-15 00:00:00', '320000', 1, '', 6, 1980, 0, 1, 0, 'Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis. Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae, euismod arcu.', '000000-00000-00000', 2),
(13, '1', '1634 Winding Way', 'Pawtucket', '51.527306', '-0.140977', 1, 4, '2014-11-16 00:00:00', '330000', 0, '', 4, 1980, 0, 4, 0, 'Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis. Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae, euismod arcu.', '000000-00000-00000', 1),
(14, '1', '4692 Lynn Ogden Lane', 'Beaumont', '51.545244', '-0.070939', 4, 4, '2014-11-17 00:00:00', '340000', 0, '', 15, 1980, 0, 3, 0, 'Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis. Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae, euismod arcu.', '000000-00000-00000', 1),
(15, '2', '1036 Fairmont Avenue', 'Trenton', '51.558907', '-0.041842', 5, 4, '2014-11-18 00:00:00', '350000', 0, '', 14, 1980, 0, 3, 0, 'Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis. Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae, euismod arcu.', '000000-00000-00000', 1),
(16, '1', '4808 McDonald Avenue', 'Orlando', '51.551026', '-0.102321', 5, 4, '2014-11-19 00:00:00', '360000', 0, '', 12, 1980, 0, 2, 0, 'Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis. Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae, euismod arcu.', '000000-00000-00000', 1),
(17, '1', '3858 Brannon Street', 'Los Angeles', '51.550644', '-0.103493', 2, 4, '2014-11-20 00:00:00', '370000', 0, '', 7, 1980, 0, 1, 0, 'Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis. Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae, euismod arcu.', '000000-00000-00000', 1),
(18, '2', '4366 Emerson Road', 'Monroe', '51.532112', '-0.051885', 6, 4, '2014-11-21 00:00:00', '380000', 1, '', 6, 1980, 0, 1, 0, 'Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis. Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae, euismod arcu.', '000000-00000-00000', 2),
(19, '1', 'Big Luxury Apartment', 'Portland', '51.531364', '-0.054545', 2, 5, '2014-11-22 00:00:00', '390000', 0, '', 5, 1980, 0, 4, 0, 'Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis. Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae, euismod arcu.', '000000-00000-00000', 1),
(20, '1', '4261 Providence Lane', 'Los Angeles', '51.531311', '-0.052314', 3, 5, '2014-11-23 00:00:00', '400000', 1, '', 4, 1980, 0, 4, 0, 'Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis. Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae, euismod arcu.', '000000-00000-00000', 1),
(21, '2', 'Big Luxury Apartment', 'Philadelphia', '51.530189', '-0.078750', 3, 5, '2014-11-24 00:00:00', '410000', 0, '', 3, 1980, 0, 4, 0, 'Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis. Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae, euismod arcu.', '000000-00000-00000', 1),
(22, '1', 'Family Flat', 'Philadelphia', '51.530189', '-0.078750', 3, 5, '2014-11-25 00:00:00', '420000', 0, '', 1, 1980, 0, 4, 0, 'Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis. Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae, euismod arcu.', '000000-00000-00000', 1),
(23, '1', '996 Derek St', 'Lebanon', '33.490874', '36.288614', 2, 0, '2018-01-31 15:09:38', '110000', 0, '', 15, 1980, 0, 0, 1, 'created test', 'C592A48C-33E1-4813-BB0D-0E8D0CFC2930', 1),
(24, '1', '123', 'Lebanon', '33.854721', '35.862285', 1, 0, '2018-01-31 15:16:53', '100000', 0, '', 17, 1980, 0, 0, 0, '', 'C945EAA8-AE17-4D27-AD57-454B5D2452D3', 1),
(25, '1', '123', 'Lebanon', '33.854721', '35.862285', 1, 0, '2018-01-31 15:17:31', '100000', 0, '', 9, 1980, 0, 0, 0, '', 'DB42C8C6-EF76-4170-880E-84CF203D4519', 1),
(26, '1', '666 test st', 'Lebanon', '33.854721', '35.862285', 1, 0, '2018-02-01 14:01:41', '100000', 0, '', 4, 1980, 0, 0, 0, '', '97E488C8-FCDB-4663-9F40-2E7C2E36E0F3', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tc_propertyfeature`
--

CREATE TABLE `tc_propertyfeature` (
  `Id` int(11) NOT NULL,
  `PropertyId` int(11) NOT NULL,
  `FeatureId` int(11) NOT NULL,
  `Descriptions` int(11) NOT NULL,
  `Image` int(11) NOT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tc_propertyfeature`
--

INSERT INTO `tc_propertyfeature` (`Id`, `PropertyId`, `FeatureId`, `Descriptions`, `Image`, `IsDeleted`) VALUES
(1, 1, 1, 0, 0, 0),
(2, 1, 2, 0, 0, 0),
(3, 1, 3, 0, 0, 0),
(6, 1, 6, 0, 0, 0),
(11, 1, 12, 0, 0, 0),
(13, 2, 2, 0, 0, 0),
(17, 2, 6, 0, 0, 0),
(19, 2, 8, 0, 0, 0),
(22, 2, 12, 0, 0, 0),
(23, 3, 1, 0, 0, 0),
(26, 3, 4, 0, 0, 0),
(29, 3, 7, 0, 0, 0),
(31, 3, 9, 0, 0, 0),
(33, 3, 12, 0, 0, 0),
(34, 4, 1, 0, 0, 0),
(37, 4, 4, 0, 0, 0),
(38, 4, 5, 0, 0, 0),
(39, 4, 6, 0, 0, 0),
(41, 4, 8, 0, 0, 0),
(43, 4, 11, 0, 0, 0),
(46, 5, 2, 0, 0, 0),
(47, 5, 3, 0, 0, 0),
(51, 5, 7, 0, 0, 0),
(53, 5, 9, 0, 0, 0),
(57, 6, 2, 0, 0, 0),
(58, 6, 3, 0, 0, 0),
(59, 6, 4, 0, 0, 0),
(61, 6, 6, 0, 0, 0),
(62, 6, 7, 0, 0, 0),
(66, 6, 12, 0, 0, 0),
(67, 7, 1, 0, 0, 0),
(69, 7, 3, 0, 0, 0),
(71, 7, 5, 0, 0, 0),
(73, 7, 7, 0, 0, 0),
(74, 7, 8, 0, 0, 0),
(78, 8, 1, 0, 0, 0),
(79, 8, 2, 0, 0, 0),
(82, 8, 5, 0, 0, 0),
(83, 8, 6, 0, 0, 0),
(86, 8, 9, 0, 0, 0),
(87, 8, 11, 0, 0, 0),
(89, 9, 1, 0, 0, 0),
(93, 9, 5, 0, 0, 0),
(94, 9, 6, 0, 0, 0),
(97, 9, 9, 0, 0, 0),
(101, 10, 2, 0, 0, 0),
(102, 10, 3, 0, 0, 0),
(103, 10, 4, 0, 0, 0),
(106, 10, 7, 0, 0, 0),
(107, 10, 8, 0, 0, 0),
(109, 10, 11, 0, 0, 0),
(111, 11, 1, 0, 0, 0),
(113, 11, 3, 0, 0, 0),
(114, 11, 4, 0, 0, 0),
(118, 11, 8, 0, 0, 0),
(121, 11, 12, 0, 0, 0),
(122, 12, 1, 0, 0, 0),
(123, 12, 2, 0, 0, 0),
(127, 12, 6, 0, 0, 0),
(129, 12, 8, 0, 0, 0),
(131, 12, 11, 0, 0, 0),
(134, 13, 2, 0, 0, 0),
(137, 13, 5, 0, 0, 0),
(138, 13, 6, 0, 0, 0),
(139, 13, 7, 0, 0, 0),
(141, 13, 9, 0, 0, 0),
(142, 13, 11, 0, 0, 0),
(143, 13, 12, 0, 0, 0),
(146, 14, 3, 0, 0, 0),
(149, 14, 6, 0, 0, 0),
(151, 14, 8, 0, 0, 0),
(157, 15, 3, 0, 0, 0),
(158, 15, 4, 0, 0, 0),
(159, 15, 5, 0, 0, 0),
(163, 15, 9, 0, 0, 0),
(166, 16, 1, 0, 0, 0),
(167, 16, 2, 0, 0, 0),
(169, 16, 4, 0, 0, 0),
(173, 16, 8, 0, 0, 0),
(174, 16, 9, 0, 0, 0),
(177, 17, 1, 0, 0, 0),
(178, 17, 2, 0, 0, 0),
(179, 17, 3, 0, 0, 0),
(181, 17, 5, 0, 0, 0),
(183, 17, 7, 0, 0, 0),
(186, 17, 11, 0, 0, 0),
(187, 17, 12, 0, 0, 0),
(191, 18, 4, 0, 0, 0),
(193, 18, 6, 0, 0, 0),
(194, 18, 7, 0, 0, 0),
(197, 18, 11, 0, 0, 0),
(199, 19, 1, 0, 0, 0),
(201, 19, 3, 0, 0, 0),
(202, 19, 4, 0, 0, 0),
(206, 19, 8, 0, 0, 0),
(209, 19, 12, 0, 0, 0),
(211, 20, 2, 0, 0, 0),
(213, 20, 4, 0, 0, 0),
(214, 20, 5, 0, 0, 0),
(218, 20, 9, 0, 0, 0),
(219, 20, 11, 0, 0, 0),
(221, 21, 1, 0, 0, 0),
(222, 21, 2, 0, 0, 0),
(223, 21, 3, 0, 0, 0),
(226, 21, 6, 0, 0, 0),
(227, 21, 7, 0, 0, 0),
(229, 21, 9, 0, 0, 0),
(233, 22, 2, 0, 0, 0),
(237, 22, 6, 0, 0, 0),
(239, 22, 8, 0, 0, 0),
(241, 22, 11, 0, 0, 0),
(242, 22, 12, 0, 0, 0),
(243, 23, 1, 0, 0, 0),
(244, 23, 2, 0, 0, 0),
(245, 23, 6, 0, 0, 0),
(246, 23, 12, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tc_propertyspec`
--

CREATE TABLE `tc_propertyspec` (
  `Id` int(11) NOT NULL,
  `PropertyId` int(11) NOT NULL,
  `SpecId` int(11) NOT NULL,
  `SpecValue` int(11) NOT NULL,
  `IsDeleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tc_propertyspec`
--

INSERT INTO `tc_propertyspec` (`Id`, `PropertyId`, `SpecId`, `SpecValue`, `IsDeleted`) VALUES
(1, 1, 1, 2, 0),
(2, 1, 2, 2, 0),
(3, 1, 3, 4, 0),
(4, 1, 4, 1, 0),
(5, 1, 5, 240, 0),
(6, 1, 6, 0, 0),
(7, 1, 7, 0, 0),
(8, 2, 1, 1, 0),
(9, 2, 2, 1, 0),
(10, 2, 3, 3, 0),
(11, 2, 4, 1, 0),
(12, 2, 5, 140, 0),
(13, 2, 6, 0, 0),
(14, 2, 7, 0, 0),
(15, 3, 1, 3, 0),
(16, 3, 2, 5, 0),
(17, 3, 3, 3, 0),
(18, 3, 4, 2, 0),
(19, 3, 5, 385, 0),
(20, 3, 6, 0, 0),
(21, 3, 7, 0, 0),
(22, 4, 1, 2, 0),
(23, 4, 2, 1, 0),
(24, 4, 3, 3, 0),
(25, 4, 4, 1, 0),
(26, 4, 5, 168, 0),
(27, 4, 6, 0, 0),
(28, 4, 7, 0, 0),
(29, 5, 1, 3, 0),
(30, 5, 2, 4, 0),
(31, 5, 3, 6, 0),
(32, 5, 4, 3, 0),
(33, 5, 5, 700, 0),
(34, 5, 6, 0, 0),
(35, 5, 7, 0, 0),
(36, 6, 1, 2, 0),
(37, 6, 2, 1, 0),
(38, 6, 3, 3, 0),
(39, 6, 4, 1, 0),
(40, 6, 5, 300, 0),
(41, 6, 6, 0, 0),
(42, 6, 7, 0, 0),
(43, 7, 1, 2, 0),
(44, 7, 2, 1, 0),
(45, 7, 3, 3, 0),
(46, 7, 4, 1, 0),
(47, 7, 5, 300, 0),
(48, 7, 6, 0, 0),
(49, 7, 7, 0, 0),
(50, 8, 1, 2, 0),
(51, 8, 2, 1, 0),
(52, 8, 3, 3, 0),
(53, 8, 4, 1, 0),
(54, 8, 5, 300, 0),
(55, 8, 6, 0, 0),
(56, 8, 7, 0, 0),
(57, 9, 1, 2, 0),
(58, 9, 2, 1, 0),
(59, 9, 3, 3, 0),
(60, 9, 4, 1, 0),
(61, 9, 5, 300, 0),
(62, 9, 6, 0, 0),
(63, 9, 7, 0, 0),
(64, 10, 1, 2, 0),
(65, 10, 2, 1, 0),
(66, 10, 3, 3, 0),
(67, 10, 4, 1, 0),
(68, 10, 5, 300, 0),
(69, 10, 6, 0, 0),
(70, 10, 7, 0, 0),
(71, 11, 1, 1, 0),
(72, 11, 2, 2, 0),
(73, 11, 3, 2, 0),
(74, 11, 4, 1, 0),
(75, 11, 5, 400, 0),
(76, 11, 6, 0, 0),
(77, 11, 7, 0, 0),
(78, 12, 1, 1, 0),
(79, 12, 2, 2, 0),
(80, 12, 3, 2, 0),
(81, 12, 4, 1, 0),
(82, 12, 5, 400, 0),
(83, 12, 6, 0, 0),
(84, 12, 7, 0, 0),
(85, 13, 1, 1, 0),
(86, 13, 2, 2, 0),
(87, 13, 3, 2, 0),
(88, 13, 4, 1, 0),
(89, 13, 5, 400, 0),
(90, 13, 6, 0, 0),
(91, 13, 7, 0, 0),
(92, 14, 1, 1, 0),
(93, 14, 2, 2, 0),
(94, 14, 3, 2, 0),
(95, 14, 4, 1, 0),
(96, 14, 5, 400, 0),
(97, 14, 6, 0, 0),
(98, 14, 7, 0, 0),
(99, 15, 1, 1, 0),
(100, 15, 2, 2, 0),
(101, 15, 3, 2, 0),
(102, 15, 4, 1, 0),
(103, 15, 5, 400, 0),
(104, 15, 6, 0, 0),
(105, 15, 7, 0, 0),
(106, 16, 1, 1, 0),
(107, 16, 2, 2, 0),
(108, 16, 3, 2, 0),
(109, 16, 4, 1, 0),
(110, 16, 5, 400, 0),
(111, 16, 6, 0, 0),
(112, 16, 7, 0, 0),
(113, 17, 1, 1, 0),
(114, 17, 2, 2, 0),
(115, 17, 3, 2, 0),
(116, 17, 4, 1, 0),
(117, 17, 5, 400, 0),
(118, 17, 6, 0, 0),
(119, 17, 7, 0, 0),
(120, 18, 1, 1, 0),
(121, 18, 2, 2, 0),
(122, 18, 3, 2, 0),
(123, 18, 4, 1, 0),
(124, 18, 5, 400, 0),
(125, 18, 6, 0, 0),
(126, 18, 7, 0, 0),
(127, 19, 1, 1, 0),
(128, 19, 2, 2, 0),
(129, 19, 3, 2, 0),
(130, 19, 4, 1, 0),
(131, 19, 5, 400, 0),
(132, 19, 6, 0, 0),
(133, 19, 7, 0, 0),
(134, 20, 1, 1, 0),
(135, 20, 2, 2, 0),
(136, 20, 3, 2, 0),
(137, 20, 4, 1, 0),
(138, 20, 5, 400, 0),
(139, 20, 6, 0, 0),
(140, 20, 7, 0, 0),
(141, 21, 1, 1, 0),
(142, 21, 2, 2, 0),
(143, 21, 3, 2, 0),
(144, 21, 4, 1, 0),
(145, 21, 5, 400, 0),
(146, 21, 6, 0, 0),
(147, 21, 7, 0, 0),
(148, 22, 1, 1, 0),
(149, 22, 2, 2, 0),
(150, 22, 3, 2, 0),
(151, 22, 4, 1, 0),
(152, 22, 5, 400, 0),
(153, 22, 6, 0, 0),
(154, 22, 7, 0, 0),
(155, 3, 1, 6, 0),
(156, 3, 2, 3, 0),
(157, 3, 3, 0, 0),
(158, 3, 4, 2, 0),
(159, 3, 5, 385, 0),
(160, 3, 6, 0, 0),
(161, 3, 7, 0, 0),
(162, 23, 1, 2, 0),
(163, 23, 2, 1, 0),
(164, 23, 3, 0, 0),
(165, 23, 4, 0, 0),
(166, 23, 5, 80, 0),
(167, 23, 6, 0, 0),
(168, 23, 7, 0, 0),
(169, 24, 1, 2, 0),
(170, 24, 2, 1, 0),
(171, 24, 3, 0, 0),
(172, 24, 4, 0, 0),
(173, 24, 5, 80, 0),
(174, 24, 6, 0, 0),
(175, 24, 7, 0, 0),
(176, 25, 1, 2, 0),
(177, 25, 2, 1, 0),
(178, 25, 3, 0, 0),
(179, 25, 4, 0, 0),
(180, 25, 5, 80, 0),
(181, 25, 6, 0, 0),
(182, 25, 7, 0, 0),
(183, 26, 1, 2, 0),
(184, 26, 2, 1, 0),
(185, 26, 3, 0, 0),
(186, 26, 4, 0, 0),
(187, 26, 5, 80, 0),
(188, 26, 6, 0, 0),
(189, 26, 7, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tc_restapi_keys`
--

CREATE TABLE `tc_restapi_keys` (
  `id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `scopes` text,
  `app_name` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `user` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `expire` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tc_restapi_keys`
--

INSERT INTO `tc_restapi_keys` (`id`, `key`, `scopes`, `app_name`, `level`, `ignore_limits`, `user`, `date_created`, `expire`) VALUES
(1, 'K09F0qH8tCaqZzbhTJPS25HYM6TLWJZYSr5OqeN1', 'core', 'Syrian Properties', 0, 0, 0, '2018-01-29 14:21:06', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tc_system_sessions`
--

CREATE TABLE `tc_system_sessions` (
  `id` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `ip_address` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tc_trackproperty`
--

CREATE TABLE `tc_trackproperty` (
  `Id` int(11) NOT NULL,
  `PropertyId` int(11) DEFAULT NULL,
  `Operation` varchar(45) DEFAULT NULL,
  `DetailJson` varchar(2048) DEFAULT NULL,
  `CreatedOn` datetime DEFAULT NULL,
  `CreatedBy` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tc_trackproperty`
--

INSERT INTO `tc_trackproperty` (`Id`, `PropertyId`, `Operation`, `DetailJson`, `CreatedOn`, `CreatedBy`) VALUES
(1, 1, 'STATUS (2)', '\"2\"', '2018-01-30 15:31:18', '18'),
(2, 2, 'STATUS (2)', '\"2\"', '2018-01-30 15:31:20', '18'),
(3, 2, 'STATUS (3)', '\"3\"', '2018-01-31 15:00:51', '17'),
(4, 3, 'UPDATE', '{\"Id\":\"3\",\"Category\":\"2\",\"Address\":\"3019 White Avenue\",\"Location\":\"Corpus Christi\",\"Latitude\":\"51.551489\",\"Longitude\":\"-0.067077\",\"TypeId\":\"2\",\"Price\":\"230000\",\"Featured\":\"0\",\"BuiltYear\":\"1980\",\"Description\":\"Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet pellentesque mauris. Proin sit amet scelerisque risus. Donec semper semper erat ut mollis. Curabitur suscipit, justo eu dignissim lacinia, ante sapien pharetra duin consectetur eros augue sed ex. Donec a odio rutrum, hendrerit sapien vitae, euismod arcu.\"}', '2018-01-31 15:03:49', '17'),
(5, 23, 'INSERT', '{\"Id\":\"23\",\"Category\":\"1\",\"Address\":\"996 Derek St\",\"Location\":\"Lebanon\",\"Latitude\":\"33.490874\",\"Longitude\":\"36.288614\",\"TypeId\":\"2\",\"Rating\":\"0\",\"CreatedOn\":\"2018-01-31 15:09:38\",\"Price\":\"110000\",\"Featured\":\"0\",\"Color\":\"\",\"PersonId\":\"15\",\"BuiltYear\":\"1980\",\"SpecialOffer\":\"0\",\"AgencyId\":\"0\",\"IsDeleted\":\"0\",\"Description\":\"created test\",\"guid\":\"C592A48C-33E1-4813-BB0D-0E8D0CFC2930\",\"StatusId\":\"1\"}', '2018-01-31 15:09:38', '15'),
(6, 23, 'STATUS (2)', '\"2\"', '2018-01-31 15:12:13', '17'),
(7, 23, 'DELETE ()', '\"23\"', '2018-01-31 15:12:36', '17'),
(8, 24, 'INSERT', '{\"Id\":\"24\",\"Category\":\"1\",\"Address\":\"123\",\"Location\":\"Lebanon\",\"Latitude\":\"33.854721\",\"Longitude\":\"35.862285\",\"TypeId\":\"1\",\"Rating\":\"0\",\"CreatedOn\":\"2018-01-31 15:16:53\",\"Price\":\"100000\",\"Featured\":\"0\",\"Color\":\"\",\"PersonId\":\"17\",\"BuiltYear\":\"1980\",\"SpecialOffer\":\"0\",\"AgencyId\":\"0\",\"IsDeleted\":\"0\",\"Description\":\"\",\"guid\":\"C945EAA8-AE17-4D27-AD57-454B5D2452D3\",\"StatusId\":\"1\"}', '2018-01-31 15:16:53', '17'),
(9, 25, 'INSERT', '{\"Id\":\"25\",\"Category\":\"1\",\"Address\":\"123\",\"Location\":\"Lebanon\",\"Latitude\":\"33.854721\",\"Longitude\":\"35.862285\",\"TypeId\":\"1\",\"Rating\":\"0\",\"CreatedOn\":\"2018-01-31 15:17:31\",\"Price\":\"100000\",\"Featured\":\"0\",\"Color\":\"\",\"PersonId\":\"9\",\"BuiltYear\":\"1980\",\"SpecialOffer\":\"0\",\"AgencyId\":\"0\",\"IsDeleted\":\"0\",\"Description\":\"\",\"guid\":\"DB42C8C6-EF76-4170-880E-84CF203D4519\",\"StatusId\":\"1\"}', '2018-01-31 15:17:31', '17'),
(10, 25, 'STATUS (2)', '\"2\"', '2018-01-31 15:17:56', '17'),
(11, 25, 'STATUS (3)', '\"3\"', '2018-01-31 15:17:59', '17'),
(12, 3, 'STATUS (2)', '\"2\"', '2018-02-01 14:00:32', '17'),
(13, 25, 'STATUS (3)', '\"3\"', '2018-02-01 14:00:35', '17'),
(14, 3, 'STATUS (3)', '\"3\"', '2018-02-01 14:00:48', '17'),
(15, 1, 'STATUS (3)', '\"3\"', '2018-02-01 14:01:12', '17'),
(16, 26, 'INSERT', '{\"Id\":\"26\",\"Category\":\"1\",\"Address\":\"666 test st\",\"Location\":\"Lebanon\",\"Latitude\":\"33.854721\",\"Longitude\":\"35.862285\",\"TypeId\":\"1\",\"Rating\":\"0\",\"CreatedOn\":\"2018-02-01 14:01:41\",\"Price\":\"100000\",\"Featured\":\"0\",\"Color\":\"\",\"PersonId\":\"4\",\"BuiltYear\":\"1980\",\"SpecialOffer\":\"0\",\"AgencyId\":\"0\",\"IsDeleted\":\"0\",\"Description\":\"\",\"guid\":\"97E488C8-FCDB-4663-9F40-2E7C2E36E0F3\",\"StatusId\":\"1\"}', '2018-02-01 14:01:41', '17'),
(17, 26, 'STATUS (2)', '\"2\"', '2018-02-01 14:02:00', '17'),
(18, 26, 'STATUS (3)', '\"3\"', '2018-02-01 14:02:25', '18'),
(19, 1, 'STATUS (2)', '\"2\"', '2018-02-18 05:12:54', '3'),
(20, 2, 'STATUS (2)', '\"2\"', '2018-02-18 08:09:51', '18'),
(21, 26, 'STATUS (3)', '\"3\"', '2018-02-18 08:09:56', '18'),
(22, 2, 'STATUS (3)', '\"3\"', '2018-02-18 08:12:03', '18'),
(23, 12, 'STATUS (2)', '\"2\"', '2018-02-18 08:12:14', '18'),
(24, 18, 'STATUS (2)', '\"2\"', '2018-02-18 08:12:24', '18'),
(25, 26, 'STATUS (3)', '\"3\"', '2018-02-18 08:12:29', '18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tc_aauth_groups`
--
ALTER TABLE `tc_aauth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tc_aauth_perms`
--
ALTER TABLE `tc_aauth_perms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tc_aauth_perm_to_group`
--
ALTER TABLE `tc_aauth_perm_to_group`
  ADD PRIMARY KEY (`perm_id`,`group_id`);

--
-- Indexes for table `tc_aauth_perm_to_user`
--
ALTER TABLE `tc_aauth_perm_to_user`
  ADD PRIMARY KEY (`perm_id`,`user_id`);

--
-- Indexes for table `tc_aauth_pms`
--
ALTER TABLE `tc_aauth_pms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `full_index` (`id`,`sender_id`,`receiver_id`,`read`);

--
-- Indexes for table `tc_aauth_system_variables`
--
ALTER TABLE `tc_aauth_system_variables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tc_aauth_users`
--
ALTER TABLE `tc_aauth_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tc_aauth_user_to_group`
--
ALTER TABLE `tc_aauth_user_to_group`
  ADD PRIMARY KEY (`user_id`,`group_id`);

--
-- Indexes for table `tc_aauth_user_variables`
--
ALTER TABLE `tc_aauth_user_variables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_index` (`user_id`);

--
-- Indexes for table `tc_about_us`
--
ALTER TABLE `tc_about_us`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tc_agency`
--
ALTER TABLE `tc_agency`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tc_contact`
--
ALTER TABLE `tc_contact`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tc_definedfeature`
--
ALTER TABLE `tc_definedfeature`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tc_definedspecification`
--
ALTER TABLE `tc_definedspecification`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tc_definedtype`
--
ALTER TABLE `tc_definedtype`
  ADD PRIMARY KEY (`Id`) USING BTREE;

--
-- Indexes for table `tc_gallery`
--
ALTER TABLE `tc_gallery`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tc_options`
--
ALTER TABLE `tc_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tc_people`
--
ALTER TABLE `tc_people`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tc_property`
--
ALTER TABLE `tc_property`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tc_propertyfeature`
--
ALTER TABLE `tc_propertyfeature`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tc_propertyspec`
--
ALTER TABLE `tc_propertyspec`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tc_restapi_keys`
--
ALTER TABLE `tc_restapi_keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tc_trackproperty`
--
ALTER TABLE `tc_trackproperty`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Id_UNIQUE` (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tc_aauth_groups`
--
ALTER TABLE `tc_aauth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tc_aauth_perms`
--
ALTER TABLE `tc_aauth_perms`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tc_aauth_pms`
--
ALTER TABLE `tc_aauth_pms`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tc_aauth_system_variables`
--
ALTER TABLE `tc_aauth_system_variables`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tc_aauth_users`
--
ALTER TABLE `tc_aauth_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tc_aauth_user_variables`
--
ALTER TABLE `tc_aauth_user_variables`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tc_about_us`
--
ALTER TABLE `tc_about_us`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tc_agency`
--
ALTER TABLE `tc_agency`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tc_contact`
--
ALTER TABLE `tc_contact`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tc_definedfeature`
--
ALTER TABLE `tc_definedfeature`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tc_definedspecification`
--
ALTER TABLE `tc_definedspecification`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tc_definedtype`
--
ALTER TABLE `tc_definedtype`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tc_gallery`
--
ALTER TABLE `tc_gallery`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `tc_options`
--
ALTER TABLE `tc_options`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tc_people`
--
ALTER TABLE `tc_people`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tc_property`
--
ALTER TABLE `tc_property`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tc_propertyfeature`
--
ALTER TABLE `tc_propertyfeature`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `tc_propertyspec`
--
ALTER TABLE `tc_propertyspec`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

--
-- AUTO_INCREMENT for table `tc_restapi_keys`
--
ALTER TABLE `tc_restapi_keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tc_trackproperty`
--
ALTER TABLE `tc_trackproperty`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
