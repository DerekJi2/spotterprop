<?php defined('BASEPATH') OR exit('No direct script access allowed');

    function get_contact($lang)
    {
        $CI = @get_instance();
        $CI->load->model("Contact_model");		
		$model = new Contact_model();
        $result = $model->getModel($lang);

        return $result;
    }
