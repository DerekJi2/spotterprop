<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends CI_Controller {

	function __constuctor() {
		parent::__constuctor();

		
	}

	public function index()
	{
		$this->load->view('Gallery/index');
    }
    
    public function BytesFromBase64String($base64_encoded)
    {
        $base64_decoded = base64_decode($base64_encoded);
        $bytes = array();
        foreach(str_split($base64_decoded) as $code)
        {
            $bytes[] = sprintf("%08b", ord($code));
        }
        return $bytes;
    }

	public function Upload()
	{
        $ci = @get_instance();
        $ci->load->helper("MY_model_helper");
        $imgSource = $this->input->post("imgSource");
        $propId = $this->input->post("propertyId");

        $filename = upload_image($imgSource);
        $ok = 0;
        if ($filename != null && $filename != "")
        {
            
            $ok = insert_gallery($propId, $filename);
        }

        echo $ok;
        /**/
    }
    

}
