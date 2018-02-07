<?php
defined('BASEPATH') OR exit('No direct script access allowed');

defined('__ROOT__') OR define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/controllers/BaseDB_Controller.php'); 

class Settings extends BaseDB_Controller {

    function __construct()
     {
         parent::__construct();
     }

     public function save_aboutus()
     {
         $ci = @get_instance();
         $ci->load->helper("MY_AboutUs_helper");

         $lang = $this->input->post("lang");
         $title = $this->input->post("title");
         $desc = $this->input->post("desc");
 
         $result = save_aboutus($lang, $title, $desc);

         echo $result;
     }
}
