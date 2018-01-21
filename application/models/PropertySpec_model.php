
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

    public function insert_specs($propertyId, $specs)
    {
        if ($specs == null || sizeof($specs) < 1)
            return true;

        $values = array();
        for ($i = 1; $i < sizeof($specs); $i++)
        {
            $spec_id = $i;
            $spec_value = $specs[$i];
            $value = sprintf("(%d, %d, %d)", $propertyId, $spec_id, $spec_value);

            array_push($values, $value);
        }
        $values_string = implode(", ", $values);
        // echo $values_string."\r\n";
        $sql = sprintf("INSERT INTO %s(PropertyId, SpecId, SpecValue) VALUES %s", $this->tableName, $values_string);

        // echo $sql."\r\n";

        $ok = $this->db->query($sql);
        return $ok;
    }

    public function update_specs($propertyId, $specs)
    {
        if ($specs == null || sizeof($specs) < 1)
            return true;

        $ok = 0;
        for ($i = 1; $i <= sizeof($specs); $i++)
        {
            $spec_id = $i;
            $spec_value = $specs[$i];
            $sql = sprintf("UPDATE %s SET SpecValue=%d WHERE PropertyId=%d AND SpecId=%d AND SpecValue!=%d)", $propertyId, $spec_id, $spec_value);

            $ok = $this->db->query($sql);
        }
        return $ok;
    }
}

class PropertySpecPair
{
    public $Name;
    public $Amount;
}