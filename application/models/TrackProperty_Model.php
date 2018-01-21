<?php

defined('__ROOT__') OR define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/models/BaseTable_model.php'); 
require_once(__ROOT__.'/models/Property_JsonModel.php'); 
require_once(__ROOT__.'/models/Gallery_model.php'); 
require_once(__ROOT__.'/models/PropertyFeature_model.php'); 
require_once(__ROOT__.'/models/PropertySpec_model.php'); 
require_once(__ROOT__.'/models/DefinedType_model.php'); 

class TrackProperty_model extends BaseTable_model {
    
    /**
     * 
     */
    function __construct()
    {
        $tablename = "trackproperty";
        parent::__construct($tablename);
    }

    /**
     * 
     */
    function insert($operation, $propData)
    {
        $data = array(
            'PropertyId'    => $propData->Id,
            'Operation'     => $operation,
            'DetailJson'    => json_encode($propData),
            'CreatedOn'     => date('Y-m-d H:i:s'),
            'CreatedBy'     => $propData->PersonId,
        );
        $ok = $this->db->insert($this->tableName, $data);
        
        return $ok;
    }
}