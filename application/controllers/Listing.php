<?php
defined('BASEPATH') OR exit('No direct script access allowed');

defined('__ROOT__') OR define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/controllers/BaseDB_Controller.php'); 

class Listing extends BaseDB_Controller {

    function __construct()
     {
         parent::__construct();
         parent::Init("Property_model");
         $this->model = new Property_model();
     }

     /**
     * GET: ~/Property/Index/{id}
     */
	public function index()
	{
        $this->Grid();
    }
    
    /**
     * 
     */
    public function List()
    {
        // $data = $this->GetData();
        
        // $this->load->view("Listing/List", $data);
        $this->load->view("Listing/List");
    }

    /**
     * 
     */
    public function Grid()
    {
        // $data = $this->GetData();   

        // $this->load->view("Listing/Grid", $data);
        $this->load->view("Listing/Grid");
    }

    /**
     * 
     */
    protected function GetData()
    {
        $this->load->helper("MY_data_helper");
        $result = get_property_list();
        $data["list"] = $result;
        $data["typesResult"] = get_defined_types();
        $data["types"] = get_defined_types();
        $data['latest'] = get_property_latest(3);
        $data['featured'] = get_property_featured(3);


        return $data;
    }
}
