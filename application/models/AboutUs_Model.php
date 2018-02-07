
<?php

defined('__ROOT__') OR define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/models/BaseTable_model.php'); 

class AboutUs_model extends BaseTable_model {
   
    /**
     * 
     */
    function __construct()
    {
        $tablename = "about_us";
        parent::__construct($tablename);
    }

    /**
     * 
     */
    function getModel($lang = "en")
    {
        $sql = "SELECT * FROM $this->tableName WHERE Lang='$lang'";

        $query = $this->db->query($sql);
        $result = $query->result();
        return $result[0];
    }

    /**
     * 
     */
    function saveModel($lang, $title, $desc, $bgImage = "", $bgText = "")
    {
        $tablename = $this->db->dbprefix($this->tableName);
        $sql = "UPDATE $this->tableName SET
            Title='$title',
            Descriptions='$desc'
            -- BackgroundImage='$bgImage',
            -- BackgroundText='$bgText'        
        WHERE Lang='$lang'";

        $result = $this->db->query($sql);
        return $result;
    }

}