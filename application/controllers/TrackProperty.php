<?php
defined('BASEPATH') OR exit('No direct script access allowed');

defined('__ROOT__') OR define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/controllers/BaseDB_Controller.php'); 

class TrackProperty extends BaseDB_Controller {

    function __construct()
     {
         parent::__construct();
         parent::Init("TrackProperty_model");
         $this->model = new TrackProperty_model();
     }

     /**
      * 
      */
    public function GetList($propertyId)
    {
        $this->ci->load->model($this->modelName);

        $result = ($this->model != null) ? $this->model->get_list($propertyId) : null;

        //add the header here
        header('Content-Type: application/json');
        echo json_encode( $result );
    }
    
    /**
     * 
     */
    public function JsonList()
    {
        $this->ci->load->model($this->modelName);

        $result = ($this->model != null) ? $this->model->get_json_array(false, [3]) : null;
    
        //add the header here
        header('Content-Type: application/json');
        echo json_encode( $result );
    }

}
