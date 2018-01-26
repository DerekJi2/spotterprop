<?php defined('BASEPATH') OR exit('No direct script access allowed');

    function GUID()
    {
        if (function_exists('com_create_guid') === true)
        {
            return trim(com_create_guid(), '{}');
        }

        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }

    function track_property($operation, $propertyData)
    {
        $CI = @get_instance();
        $CI->load->model("TrackProperty_Model");		
		$model = new TrackProperty_Model();
		return $model->insert($operation, $propertyData);
    }

    function add_property($propertyData, $new_features, $specs)
    {
        $CI = @get_instance();
        $CI->load->model("Property_model");		
		$model = new Property_model();
        $createdProperty = $model->insert($propertyData);
        if ($createdProperty != null)
        {
            $propId = $createdProperty->Id;

            // Update property's features
            $ok_feature = update_property_features($propId, $new_features);

            // Update property's specs
            $ok_specs = add_property_specs($propId, $specs);

            // Track history
            track_property("INSERT", $createdProperty);
            return $createdProperty;
        }
    }

    function update_property_features($propertyId, $new_features)
    {
        if ($new_features == null || sizeof($new_features) < 1)
            return;

        $CI = @get_instance();
        $CI->load->model("PropertyFeature_model");		
		$featuresModel = new PropertyFeature_model();
        $cur_features = $featuresModel->get_result_by_propertyid($propertyId);
        
        $add_list = array();
        foreach ($new_features as $item)
        {
            $feature_id = $item;
            if (!$featuresModel->feature_exists($cur_features, $feature_id))
            {
                array_push($add_list, $feature_id);
            }
        }

        $delete_list = array();
        foreach ($cur_features as $item)
        {
            $feature_id = $item->FeatureId;
            if (!in_array($feature_id, $new_features))
            {
                array_push($delete_list, $feature_id);
            }
        }

        $ok_add = $featuresModel->insert_array($propertyId, $add_list);        

        $mark_only = false;
        $ok_delete = $featuresModel->delete_array($propertyId, $delete_list, $mark_only);
    }

    function add_property_specs($propertyId, $specs)
    {
        $CI = @get_instance();
        $CI->load->model("PropertySpec_model");		
		$specsModel = new PropertySpec_model();
        $ok = $specsModel->insert_specs($propertyId, $specs);        
        return $ok;
    }

    function array_value($array, $key, $default = 0)
    {
        if ($array == null || sizeof($array) < 1)
            return $default;

        if (!array_key_exists($key, $array))
            return $default;

        if ($array[$key] == null || $array[$key] == "")
            return $default;
        
        return $array[$key];
    }

    function upload_image($imgSource, $type = "property")
	{
        $filename = get_image_uniqname($type);
        $ok = file_put_contents($filename, base64_decode($imgSource));

        return $filename;
    }
    
    function get_image_uniqname($imageType = "property")
    {
        $dir = "user-assets/$imageType-images";
        $name = date('Y_m_d_h_i_s_v').uniqid();
        $filename = "$dir/$name.png";
        return $filename;
    }

    function insert_gallery($propertyId, $imageUrl, $personId = 0, $displayNum = 0, $isFloorPlan = 0)
    {
        $CI = @get_instance();
        $CI->load->model("Gallery_model");		
		$galleryModel = new Gallery_model();
        $ok = $galleryModel->insert($propertyId, $imageUrl, $personId, $displayNum, $isFloorPlan);
        return $ok;
    }

    function get_property_details($property_id)
    {
        $CI = @get_instance();

        $CI->load->model("Property_model");
        $propModel = new Property_model();
        $result = $propModel->get_json($property_id);
        $json_data = $result->data;
        $data["vw"] = $json_data;

        $latest = $propModel->get_latest_result(3);
        $data['latest'] = $latest;

        $CI->load->model("DefinedSpecification_model");
        $defSpecModel = new DefinedSpecification_model();
        $specResult = $defSpecModel->get_result();
        $data["specs"] = $specResult;

        $CI->load->model("DefinedType_model");
        $defTypeModel = new DefinedType_model();
        $typesResult = $defTypeModel->get_result();
        $data["types"] = $typesResult;

        $CI->load->model("Agent_model");
        $agentModel = new Agent_model();
        $agentQuery = $agentModel->query_by_propertyid($property_id);
        $agentResult = $agentQuery->result();
        $data["agent"] = ($agentResult == null || sizeof($agentResult) < 1) ? null : $agentResult[0];

        return $data;
    }
