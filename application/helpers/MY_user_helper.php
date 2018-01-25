<?php defined('BASEPATH') OR exit('No direct script access allowed');

function get_login_user()
{
    $CI = @get_instance();
    $CI->load->model("Users_Model");
    $userModel = new Users_model();
    $user = $userModel->current;

    return $user;
}

// function get_login_groupid()
// {
//     $userId = $this->users->current->id; // ignore $index here. it's useless actually
//     $user_group            =    farray($this->users->auth->get_user_groups($userId));
//     $user_group_id = $user_group->group_id;
// }