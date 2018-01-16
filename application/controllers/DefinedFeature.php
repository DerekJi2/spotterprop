<?php
defined('BASEPATH') OR exit('No direct script access allowed');

defined('__ROOT__') OR define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/controllers/BaseDB_Controller.php'); 

class DefinedFeature extends BaseDB_Controller {

     function __construct()
     {
         parent::__construct();
         parent::Init("DefinedFeature_model");
         $this->model = new DefinedFeature_model();
     }
}

