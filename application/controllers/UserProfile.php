<?php
defined('BASEPATH') OR exit('No direct script access allowed');

defined('__ROOT__') OR define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/controllers/BaseDB_Controller.php'); 

class UserProfile extends BaseDB_Controller {

    function __construct()
     {
         parent::__construct();
     }

     public function upload_photo()
     {
         $ci = @get_instance();
         $ci->load->helper("MY_model_helper");
         $imgSource = $this->input->post("imgSource");
 
         $filename = upload_image($imgSource, "user");

         echo $filename;
     }
}
