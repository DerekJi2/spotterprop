<?php defined('BASEPATH') OR exit('No direct script access allowed');



    function get_property_list()
    {
        $CI = @get_instance();
        $CI->load->model("Property_model");		
		$propertyModel = new Property_model();
		return $propertyModel->get_json_array();
    }

    function get_property_latest($top)
    {
        $CI = @get_instance();
        $CI->load->model("Property_model");		
		$propertyModel = new Property_model();
		return $propertyModel->get_latest_result($top);
    }

    function get_property_featured($top)
    {
        $CI = @get_instance();
        $CI->load->model("Property_model");		
		$propertyModel = new Property_model();
		return $propertyModel->get_featured($top);
    }

    function get_defined_features()
    {
        $CI = @get_instance();
        $CI->load->model("DefinedFeature_model");		
		$featuresModel = new DefinedFeature_model();
		return $featuresModel->get_result();
    }

    function get_defined_types()
    {
        $CI = @get_instance();
        $CI->load->model("DefinedType_model");		
		$typesModel = new DefinedType_model();
		return $typesModel->get_result();
    }

    function get_agent($propId)
    {
        $CI = @get_instance();
        $CI->load->model("Agent_model");
        $agentModel = new Agent_model();
        $agentQuery = $agentModel->query_by_propertyid($propId);
        $agentResult = $agentQuery->result();
        $agent = ($agentResult != null && sizeof($agentResult) > 0) ? $agentResult[0] : null;
        return $agent;
    }

    function get_lang_from_url()
    {
        $uri = $_SERVER['REQUEST_URI'];
        
        $columns = explode("/", $uri);
        $a1 = (sizeof($columns) > 1) ? $columns[1] : "";

        $langs = array("en", "ar", "cn");
        $pos = in_array($a1, $langs) ;
   
        $lang = ($pos == 1) ? $a1 : "";

        return $lang;
    }

    function get_language_from_url()
    {
        $lang = get_lang_from_url();

        if ($lang == "" || $lang == "en")
            return "english";

        if ($lang == "ar")
            return "arabic";

        if ($lang == "cn")
            return "chinese";

        return $lang;
    }

    function get_uri()
    {
        return $_SERVER['REQUEST_URI']; 
    }

    function lang_site_url($addr = "")
    {
        $lang = get_lang_from_url();
        if ($lang == "")
            return site_url($addr);
        else
        {
            $site_url = site_url();

            $lang_site_url = "$site_url$lang/$addr";
            return $lang_site_url;
        }
    }

    function get_lang($word, $module = "home_")
    {
        $CI = @get_instance();
        $langWord = $CI->lang->line($module.$word);
        if ($langWord == null || $langWord == "")
        {
            return $word;
        }

        return $langWord;
    }

    // multiple languages
    $this->lang->load('home', get_language_from_url());