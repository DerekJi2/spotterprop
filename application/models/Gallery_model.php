
<?php

defined('__ROOT__') OR define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/models/BaseTable_model.php'); 

class Gallery_model extends BaseTable_model {
    
    /**
     * 
     */
    function __construct()
    {
        $tablename = "gallery";
        parent::__construct($tablename);
    }

    
    public function get_result_by_propertyid($propId = 0)
    {
        $this->load->database();
        $query = $this->db->get_where($this->tableName, array('PropertyId' => $propId));

        return $query->result();
    }


}