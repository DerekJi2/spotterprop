<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BaseDB_Controller extends CI_Controller {
    protected $ci = null;
    protected $modelName = "";
    protected $model = null;

    protected function Init($pModelName) {
        $this->ci = &get_instance();
        $this->modelName = $pModelName;
        $this->ci->load->model($this->modelName);
        //$this->model = $pModel;
    }

     /**
     * GET: ~/DefinedFeature/
     * 
     * Get list of DefinedFeature
     * 
     */
	public function index()
	{
        $this->ci->load->model($this->modelName);

        $result = ($this->model != null) ? $this->model->get_result() : null;
    
        //add the header here
        header('Content-Type: application/json');
        echo json_encode( $result );
    }
    
    /**
     * GET: ~/DefinedType/DetailApiP/{id}
     * 
     */
    public function DetailApi($id = 0) {
        $this->ci->load->model($this->modelName);

        $result = ($this->model != null) ? $this->model->get_row($id) : null;
    
        //add the header here
        header('Content-Type: application/json');
        echo json_encode( $result );
    }

}
