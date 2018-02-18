<?php
defined('BASEPATH') OR exit('No direct script access allowed');

defined('__ROOT__') OR define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/controllers/BaseDB_Controller.php'); 

class Pms extends BaseDB_Controller {

    function __construct()
     {
         parent::__construct();
     }

     public function SetRead()
     {
         $ci = @get_instance();
         $pm_id = $this->input->post("pmid");

         $this->load->helper("MY_Pms");
         $result = set_as_read_pm($pm_id);

         echo $result;
     }
}
