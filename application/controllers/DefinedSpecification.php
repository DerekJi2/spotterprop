<?php
defined('BASEPATH') OR exit('No direct script access allowed');

define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/controllers/BaseDB_Controller.php'); 

class DefinedSpecification extends BaseDB_Controller {

     function __construct()
     {
         parent::__construct();
         parent::Init("DefinedSpecification_model");
         $this->model = new DefinedSpecification_model();
     }
}
