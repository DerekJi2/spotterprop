
<?php

defined('__ROOT__') OR define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/models/BaseTable_model.php'); 

class PropertyFeature_model extends BaseTable_model {
    
    /**
     * 
     */
    function __construct()
    {
        $tablename = "property"."feature";
        parent::__construct($tablename);
    }

    /**
     * 
     */
    public function get_result_by_propertyid($propId = 0)
    {
        $this->load->database();

        $tablePropertyFeature = $this->db->dbprefix("PropertyFeature");
        $tableDefinedFeature = $this->db->dbprefix("DefinedFeature");
        
        $sql = "SELECT DF.Name, F.* 
        FROM $tablePropertyFeature F
            LEFT JOIN $tableDefinedFeature DF on F.FeatureId=DF.id
        WHERE PropertyId=".$propId;

        $query = $this->db->query($sql);

        return $query->result();
    }
}