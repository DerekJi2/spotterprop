
<?php

defined('__ROOT__') OR define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/models/BaseTable_model.php'); 

class Agent_model extends BaseTable_model {
    
    /**
     * 
     */
    function __construct()
    {
        $tablename = "agent";
        parent::__construct($tablename);
    }

    /**
     * 
     */
    function query_by_propertyid($propId)
    {
        $tablePeople = $this->db->dbprefix("People");
        $tableProperty = $this->db->dbprefix("Property");
        $tableAgency = $this->db->dbprefix("Agency");

        $sql = "SELECT A.*, C.Website, C.Name AS AgencyName
                FROM $tablePeople A
                    LEFT JOIN $tableProperty P ON P.PersonId=A.Id
                    LEFT JOIN $tableAgency C ON A.AgencyId=C.Id
                WHERE A.RoleType = 1
                    AND P.Id = ?";

        $query = $this->db->query($sql, array($propId));
        return $query;
    }

}