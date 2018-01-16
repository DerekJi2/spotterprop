
<?php

defined('__ROOT__') OR define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/models/BaseTable_model.php'); 

class PropertySpec_model extends BaseTable_model {
    
    /**
     * 
     */
    function __construct()
    {
        $tablename = "property"."spec";
        parent::__construct($tablename);
    }

    /**
     * 
     */
    public function get_result_by_propertyid($propId = 0)
    {
        $this->load->database();

        $tablePropertySpec = $this->db->dbprefix("PropertySpec");
        $tableDefinedSpecification = $this->db->dbprefix("DefinedSpecification");

        $sql = "SELECT DS.Name, S.* 
                FROM $tablePropertySpec S 
                LEFT JOIN $tableDefinedSpecification DS on S.SpecId=dS.id 
                WHERE DS.IsDeleted=false
                    AND S.IsDeleted=false
                    AND SpecValue>0
                    AND PropertyId=".$propId;

        $query = $this->db->query($sql);

        return $query->result();
    }
}

class PropertySpecPair
{
    public $Name;
    public $Amount;
}