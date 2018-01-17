<?php
/**
 * 	File Name 	: 	create.php
 *	Description :	file for user creation form
 *	Since		:	1.4
**/

$this->Gui->col_width(1, 2);

$this->Gui->add_meta(array(
    'col_id'    =>    1,
    'namespace'    =>    'create_user',
    'gui_saver'    =>    false,
    'custom'    =>    array(
        'action'    =>    null,
        'app'        =>    'users'
    ),
    'autoload'    =>    false,
    'footer'    =>    array(
        'submit'    =>    array(
            'label'    =>    __('Create User', 'aauth')
        )
    )
));

// User name

$this->Gui->add_item(array(
    'type'            =>    'text',
    'label'            =>    __('User Name', 'aauth'),
    'name'            =>    'username',
), 'create_user', 1);

// User email

$this->Gui->add_item(array(
    'type'            =>    'text',
    'label'            =>    __('User Email', 'aauth'),
    'name'            =>    'user_email',
), 'create_user', 1);

// user password

$this->Gui->add_item(array(
    'type'            =>    'password',
    'label'            =>    __('Password', 'aauth'),
    'name'            =>    'password',
), 'create_user', 1);

// user password config

$this->Gui->add_item(array(
    'type'            =>    'password',
    'label'            =>    __('Confirm', 'aauth'),
    'name'            =>    'confirm',
), 'create_user', 1);

$this->Gui->add_item(array(
    'type'        =>    'select',
    'name'        =>    'user_status',
    'label'        =>    __('User Status', 'aauth'),
    'options'    =>    array(
        'default'   =>  __( 'Default', 'aauth'),
        '0'    =>  __( 'Active' , 'aauth'),
        '1'  =>  __( 'Unactive' , 'aauth')
    )
), 'create_user',1 );

// add to a group

$groups_array    =    array();

$this->Gui->output();
