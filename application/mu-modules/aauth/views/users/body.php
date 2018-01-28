<?php
/**
 * 	File Name 	: 	body.php
 *	Description :	header file for each admin page. include <html> tag and ends at </head> closing tag
 *	Since		:	1.4
**/
$this->load->helper("MY_data_helper");
$complete_users    =    array();

// Get current login user's group_id
$loginId = $this->users->current->id; 
$login_group            =    farray($this->users->auth->get_user_groups($loginId));
$login_group_id = $login_group->group_id;

// adding user to complete_users array
foreach ($users as $user) {
    $userId = $user->user_id;
    $user_group            =    farray($this->users->auth->get_user_groups($userId));
    $user_group_id = $user_group->group_id;

    $delete_confirm_string = get_lang("Would you like to delete this account ?");
    
    $user_edit_link = site_url(array( get_lang_from_url() . '/dashboard', 'users', 'edit', $user->user_id ));
    $delete_button = '<a onclick="return confirm( \'' . _s( $delete_confirm_string, 'aauth' ) . '\' )" href="' . site_url(array( 'dashboard', 'users', 'delete', $user->user_id )) . '">' . __(get_lang('Delete'), 'aauth') . '</a>';

    // Editors should NOT be able to delete or edit Admin/Editor accounts
    if ($login_group_id != 4 && $login_group_id >= $user_group_id)
    {
        $delete_button = "";
        $delete_confirm_string = get_lang('Insufficient privileges: you can not edit this account.');
        $user_edit_link = "javascript: alert('$delete_confirm_string');";
    }

    $complete_users[]    =    array(
        $user->user_id ,
        '<a href="' . $user_edit_link . '">' . $user->user_name . '</a>' ,
        $user->group_name,
        $user->email ,
        $user->last_login,
        $user->banned   ==  1 ? __( get_lang('Unactive') , 'aauth') : __( get_lang('Active') , 'aauth'), $delete_button,
    );
}

$this->Gui->col_width(1, 4);

$this->Gui->add_meta(array(
    'namespace'         =>      'user-list',
    'title'             =>      __(get_lang('Users List'), 'aauth'),
    'pagination'        =>      array( true ),
    'col_id'            =>      1,
    'type'              =>      'box-primary',
    'hide_body_wrapper' =>      true
));

$this->Gui->add_item(array(
    'type'        =>    'table',
    'cols'        =>    array( 
        __(get_lang('Id'), 'aauth'), 
        __(get_lang('Username'), 'aauth'), 
        __(get_lang('Role'), 'aauth'), 
        __(get_lang('Email'), 'aauth'),  
        __(get_lang('Activity'), 'aauth'), 
        __(get_lang('Status') , 'aauth'), 
        __(get_lang('Actions'), 'aauth') ),
    'rows'        =>    $complete_users
), 'user-list', 1);

// Adding user list

$this->Gui->add_item(array(
    'type'        =>    'dom',
    'content'    =>    $pagination
), 'user-list', 1);

$this->Gui->output();
