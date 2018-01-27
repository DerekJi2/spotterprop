<?php
defined('BASEPATH') OR exit('No direct script access allowed');

defined('__ROOT__') OR define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/controllers/BaseDB_Controller.php'); 

class Property extends BaseDB_Controller {

    function __construct()
     {
         parent::__construct();
         parent::Init("Property_model");
         $this->model = new Property_model();
     }

     /**
     * GET: ~/Property/Index/{id}
     */
	public function index($id = 0)
	{
        $this->Detail($id);
    }
    
    /**
     * GET: ~/Property/Detail/{id}
     */
    public function Detail($id = 0)
	{
        $this->load->helper("MY_model_helper");
        $data= get_property_details($id);

        $this->load->view('Property/Detail', $data);
    }

    /**
     * GET: ~/Property/QuickView/{id}
     */
    public function QuickView($id = 0)
	{
        $this->ci->load->model($this->modelName);

        $result = ($this->model != null) ? $this->model->get_json($id) : null;

        
        $json_data = $result->data;
 
        $data["vw"] = $json_data;

        $this->ci->load->model("DefinedSpecification_model");
        $defSpecModel = new DefinedSpecification_model();
        $specResult = $defSpecModel->get_result();

        $data["specs"] = $specResult;

        $this->load->view('Property/Quickview', $data);
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

    /**
     * 
     */
    public function Json($id = 0)
    {
        $this->ci->load->model($this->modelName);

        $result = ($this->model != null) ? $this->model->get_json($id) : null;
    
        //add the header here
        header('Content-Type: application/json');
        echo json_encode( $result );
    }

    public function Create()
    {
        $this->ci->load->helper("MY_model_helper");

        $data = array(
            'Category'  => $this->input->post("Category"),
            'Address'   => $this->input->post("Address"),
            'Location'  => $this->input->post("Location"),
            'Latitude'  => $this->input->post("Latitude"),
            'Longitude' => $this->input->post("Longitude"),
            'TypeId'    => $this->input->post("TypeId"),
            'Rating'    => 0,
            'CreatedOn' => date('Y-m-d H:i:s'),
            'Price'     => $this->input->post("Price"),
            'Featured'  => $this->input->post("Featured"),
            'BuiltYear' => $this->input->post("BuiltYear"),
            'PersonId'  => $this->input->post("PersonId"),
            'Description' => $this->input->post("Description"),
            'StatusId'  => 1, // draft
            'guid'      => GUID(), //$this->input->post("guid") // identify the property 
        );

        $features = $this->input->post("Features");
        $specs = $this->input->post("Specs");

        /*
        $this->ci->load->model($this->modelName);
        $data["DbResult"] = ($this->model != null) ? $this->model->insert($data) : null;
*/
        $userid = $this->input->post("UserId");
        $result = add_property($data, $features, $specs, $userid);
        $data["DbResult"] = $result;
        //return $this->load->view("Property/Create", $data);

        echo $result->Id;
    }

    public function Update()
    {
        $this->ci->load->helper("MY_model_helper");

        $data = array(
            'Id'        => $this->input->post("Id"),
            'Category'  => $this->input->post("Category"),
            'Address'   => $this->input->post("Address"),
            'Location'  => $this->input->post("Location"),
            'Latitude'  => $this->input->post("Latitude"),
            'Longitude' => $this->input->post("Longitude"),
            'TypeId'    => $this->input->post("TypeId"),
            // 'Rating'    => 0,
            // 'CreatedOn' => date('Y-m-d H:i:s'),
            'Price'     => $this->input->post("Price"),
            'Featured'  => $this->input->post("Featured"),
            'BuiltYear' => $this->input->post("BuiltYear"),
            // 'PersonId'  => $this->input->post("PersonId"),
            'Description' => $this->input->post("Description"),
            // 'StatusId'  => 1, // draft
        );

        $features = $this->input->post("Features");
        $specs = $this->input->post("Specs");

        $userid = $this->input->post("UserId");
        $result = update_property($data, $features, $specs, $userid);

        echo $result;
    }

    public function Delete()
    {
        $this->ci->load->helper("MY_model_helper");

        $property_id = $this->input->post("PropertyId");
        $really = $this->input->post("Really");
        $userid = $this->input->post("UserId");

        $really = ($really == "True" || $really == "true") ? true : false;

        $result = delete_property($property_id, $userid, $really);

        echo $result;
    }

    public function UpdateStatus()
    {
        $this->ci->load->helper("MY_model_helper");

        $property_id = $this->input->post("PropertyId");
        $userid = $this->input->post("UserId");
        $statusid = $this->input->post("StatusId");

        $result = 0;
        if (in_array($statusid, [1, 2, 3]))
        {
            $result = update_property_status($property_id, $statusid, $userid);
        }
        echo $result;
    }
}
