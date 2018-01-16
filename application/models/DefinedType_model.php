
<?php

defined('__ROOT__') OR define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/models/BaseTable_model.php'); 

class DefinedType_model extends BaseTable_model {
    
    /**
     * 
     */
    function __construct()
    {
        $tablename = "defined"."type";
        parent::__construct($tablename);
    }

}