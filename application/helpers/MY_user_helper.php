<?php defined('BASEPATH') OR exit('No direct script access allowed');

function get_login_user()
{
    $CI = @get_instance();
    $CI->load->model("Users_Model");
    $userModel = new Users_model();
    $user = $userModel->current;

    return $user;
}