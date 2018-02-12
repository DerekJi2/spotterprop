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
         $keywords = $this->input->post("keywords");
 
         $result = save_aboutus($lang, $title, $desc, $keywords);

         echo $result;
     }

     public function save_contact()
     {
         $ci = @get_instance();
         $ci->load->helper("MY_Contact_helper");
         $ci->load->model("Contact_Model");
        //  $ci->load->model("ContactClass");

         $model = new Contact_Model();

         $model->Lang = $this->input->post("Lang");
         $model->CompanyName = $this->input->post("CompanyName");
         $model->Address1 = $this->input->post("Address1");
         $model->Address2 = $this->input->post("Address2");
         $model->Phone = $this->input->post("Phone");
         $model->Mobile = $this->input->post("Mobile");
         $model->Email = $this->input->post("Email");
         $model->Website = $this->input->post("Website");
         $model->Twitter = $this->input->post("Twitter");
         $model->Facebook = $this->input->post("Facebook");
         $model->Pinterest = $this->input->post("Pinterest");
 
         $result = $model->saveModel();

         echo $result;
     }

     public function save_pagesetting()
     {
        $npp_listing = $this->input->post("npp_listing");
        $npp_admin = $this->input->post("npp_admin");

        $ci = @get_instance();
        $ci->load->model("Options");

        $model = new Options();
        if ($npp_listing != "" && $npp_listing > 0) 
        {
            $model->set('number-per-page-listing', $npp_listing);
        }
        if ($npp_admin != "" && $npp_admin > 0) 
        {
            $model->set('number-per-page-admin', $npp_admin);
        }

        echo "1";
     }

     public function save_langs()
     {
        // INPUT from POST
        $lang = $this->input->post("lang");
        $configs_str = $this->input->post("configs");

        // GET Configs
        $configs = json_decode($configs_str);
        $langConfigs = array();
        foreach ($configs as $config)
        {
            $langConfigs[$config->key] = $config->val;
        }
        
        $ci = @get_instance();
        $ci->load->helper("MY_LangConfig_helper");

        save_as_lang($lang, $langConfigs);
     }
}
