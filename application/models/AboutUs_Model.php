
<?php

defined('__ROOT__') OR define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/models/BaseTable_model.php'); 

class Gallery_model extends BaseTable_model {
   
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
    function getModel($lang)
    {
        $tablename = $this->db->dbprefix($this->tableName);
        $sql = "SELECT * FROM $tablename WHERE Lang=$lang";

        $result = $this->db->query($sql).result();

        return $result;
    }

    /**
     * 
     */
    function saveModel($lang, $title, $desc, $bgImage, $bgText)
    {
        $tablename = $this->db->dbprefix($this->tableName);
        $sql = "UPDATE $tablename SET
            Title='$title',
            Descriptions='$desc',
            BackgroundImage='$bgImage',
            BackgroundText='$bgText'        
        WHERE Lang=$lang";

        $result = $this->db->query($sql);
        return $result;
    }

}