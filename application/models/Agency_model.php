
<?php

defined('__ROOT__') OR define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/models/BaseTable_model.php'); 

class Agency_model extends BaseTable_model {
    
    /**
     * 
     */
    function __construct()
    {
        $tablename = "agency";
        parent::__construct($tablename);
    }

}