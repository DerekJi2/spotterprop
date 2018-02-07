<?php defined('BASEPATH') OR exit('No direct script access allowed');

    function get_aboutus($lang)
    {
        $CI = @get_instance();
        $CI->load->model("AboutUs_model");		
		$model = new AboutUs_model();
		return $model->getModel($lang);
    }

    function save_aboutus($lang, $title, $desc, $bgImage, $bgText)
    {
        $CI = @get_instance();
        $CI->load->model("AboutUs_model");		
		$model = new AboutUs_model();
		return $model->saveModel($lang, $title, $desc, $bgImage, $bgText);
    }
