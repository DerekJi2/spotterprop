
<?php

defined('__ROOT__') OR define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/models/BaseTable_model.php'); 


class Contact_model extends BaseTable_model {

    public $Id;
    public $Lang;
    public $CompanyName;
    public $Address1;
    public $Address2;
    public $Phone;
    public $Mobile;
    public $Email;
    public $Website;
    public $Twitter;
    public $Facebook;
    public $Pinterest;
   
    /**
     * 
     */
    function __construct()
    {
        $tablename = "contact";
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
    function saveModel()
    {
        $tablename = $this->db->dbprefix($this->tableName);
        $sql = "UPDATE $this->tableName SET";
        $sql .= " " . "CompanyName='$this->CompanyName',";      
        $sql .= " " . "Address1='$this->Address1',";          
        $sql .= " " . "Address2='$this->Address2',";          
        $sql .= " " . "Phone='$this->Phone',";          
        $sql .= " " . "Mobile='$this->Mobile',";          
        $sql .= " " . "Email='$this->Email',";          
        $sql .= " " . "Website='$this->Website',";          
        $sql .= " " . "Twitter='$this->Twitter',";          
        $sql .= " " . "Facebook='$this->Facebook',";          
        $sql .= " " . "Pinterest='$this->Pinterest'";          
        $sql .= " " . "WHERE Lang='$this->Lang'";

        $result = $this->db->query($sql);
        return $result;
    }

}