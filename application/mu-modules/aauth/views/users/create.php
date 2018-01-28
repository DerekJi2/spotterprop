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
            'label'    =>    __(get_lang('Create User'), 'aauth')
        )
    )
));

// User name

$this->Gui->add_item(array(
    'type'            =>    'text',
    'label'            =>    __(get_lang('User Name'), 'aauth'),
    'name'            =>    'username',
), 'create_user', 1);

// User email

$this->Gui->add_item(array(
    'type'            =>    'text',
    'label'            =>    __(get_lang('User Email'), 'aauth'),
    'name'            =>    'user_email',
), 'create_user', 1);

// user password

$this->Gui->add_item(array(
    'type'            =>    'password',
    'label'            =>    __(get_lang('Password'), 'aauth'),
    'name'            =>    'password',
), 'create_user', 1);

// user password config

$this->Gui->add_item(array(
    'type'            =>    'password',
    'label'            =>    __(get_lang('Confirm'), 'aauth'),
    'name'            =>    'confirm',
), 'create_user', 1);

$this->Gui->add_item(array(
    'type'        =>    'select',
    'name'        =>    'user_status',
    'label'        =>    __(get_lang('User Status'), 'aauth'),
    'options'    =>    array(
        'default'   =>  __( get_lang('Default'), 'aauth'),
        '0'    =>  __( get_lang('Active') , 'aauth'),
        '1'  =>  __( get_lang('Unactive') , 'aauth')
    )
), 'create_user',1 );

// add to a group

$groups_array    =    array();


$userId = $this->users->current->id; // ignore $index here. it's useless actually
$user_group            =    farray($this->users->auth->get_user_groups($userId));
$user_group_id = $user_group->group_id;

foreach ($groups as $group) {
    if ($user_group_id <= $group->id)
    {
        $groups_array[ $group->id ] = $group->definition != null ? get_lang($group->definition) : get_lang($group->name);
    }
}

$this->Gui->add_item(array(
    'type'            =>    'select',
    'label'            =>    __(get_lang('Add to a group'), 'aauth'),
    'name'            =>    'userprivilege',
    'options'        =>    $groups_array
), 'create_user', 1);

// load custom field for user creatin

$this->events->do_action('load_users_custom_fields', array(
    'mode'            =>    'create',
    'groups'        =>    $groups_array,
    'meta_namespace'=>    'create_user',
    'col_id'        =>    1,
    'gui'            =>    $this->Gui
));

$this->Gui->output();
