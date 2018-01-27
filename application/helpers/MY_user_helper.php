<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
function get_login_user()
{
    $CI = @get_instance();
    $CI->load->model("Users_Model");
    $userModel = new Users_model();
    $user = $userModel->current;

    return $user;
}

/**
 * 
 */
function get_group_id($userId)
{
    $CI = @get_instance();
    $CI->load->model("Agent_model");
    $agentModel = new Agent_model();
    $group_id = $agentModel->get_group_id($userId);

    return $group_id;
}

function get_property_person_id($property_id)
{
    $CI = @get_instance();
    $CI->load->model("Property_model");
    $propModel = new Property_model();
    $prop = $propModel->get_row($property_id);
    $property_owner_id = $prop->PersonId;

    return $property_owner_id;
    
}

/**
 * 
 */
function filter_properties($properties_list, $userid)
{
    $user_group_id = get_group_id($userid);

    if ($user_group_id == 6)
    {
        $filtered_list = array();
        foreach ($properties_list as $prop)
        {
            if ($prop->person_id == $userid)
            {
                array_push($filtered_list, $prop);
            }
        }
        $properties_list = $filtered_list;
    }

    return $properties_list;
}

function get_users()
{
    $CI = @get_instance();
    $CI->load->model("Users_Model");
    $userModel = new Users_model();
    $users = $userModel->get_result();

    return $users;
}