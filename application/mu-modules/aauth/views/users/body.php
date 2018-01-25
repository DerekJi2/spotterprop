<?php
/**
 * 	File Name 	: 	body.php
 *	Description :	header file for each admin page. include <html> tag and ends at </head> closing tag
 *	Since		:	1.4
**/

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

    $delete_button = '<a onclick="return confirm( \'' . _s( 'Would you like to delete this account ?', 'aauth' ) . '\' )" href="' . site_url(array( 'dashboard', 'users', 'delete', $user->user_id )) . '">' . __('Delete', 'aauth') . '</a>';

    // Editors should NOT be able to delete Admin/Editor accounts
    if ($login_group_id != 4 && $login_group_id >= $user_group_id)
    {
        $delete_button = "";
    }

    $complete_users[]    =    array(
        $user->user_id ,
        '<a href="' . site_url(array( 'dashboard', 'users', 'edit', $user->user_id )) . '">' . $user->user_name . '</a>' ,
        $user->group_name,
        $user->email ,
        $user->last_login,
        $user->banned   ==  1 ? __( 'Unactive' , 'aauth') : __( 'Active' , 'aauth'), $delete_button,
    );
}

$this->Gui->col_width(1, 4);

$this->Gui->add_meta(array(
    'namespace'         =>      'user-list',
    'title'             =>      __('List', 'aauth'),
    'pagination'        =>      array( true ),
    'col_id'            =>      1,
    'type'              =>      'box-primary',
    'hide_body_wrapper' =>      true
));

$this->Gui->add_item(array(
    'type'        =>    'table',
    'cols'        =>    array( __('Id', 'aauth'), __('Username', 'aauth'), __('Role', 'aauth'), __('Email', 'aauth'),  __('Activity', 'aauth'), __( 'Status' , 'aauth'), __('Actions', 'aauth') ),
    'rows'        =>    $complete_users
), 'user-list', 1);

// Adding user list

$this->Gui->add_item(array(
    'type'        =>    'dom',
    'content'    =>    $pagination
), 'user-list', 1);

$this->Gui->output();
