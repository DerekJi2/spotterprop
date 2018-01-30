<?php
defined('BASEPATH') or exit('No direct script access allowed');

class aauth_dashboard extends CI_model
{
    public function __construct()
    {
        $this->events->add_action('load_dashboard', array( $this, 'dashboard' ));
        $this->events->add_filter('admin_menus', array( $this, 'menu' ));
        $this->events->add_filter('dashboard_body_class', array( $this, 'dashboard_body_class' ), 5, 1);
        // Change user name in the user menu
        $this->events->add_filter('user_menu_name', array( $this, 'user_menu_name' ));
        $this->events->add_filter('user_menu_card_header', array( $this, 'user_menu_header' ));
        $this->events->add_filter('tendoo_object_user_id', array( $this, 'user_id' ));
        $this->events->add_filter('user_header_profile_link', array( $this, 'user_profile_link' ));
    }
    public function user_profile_link($link)
    {
        return site_url(array( 'dashboard', 'users', 'profile' ));
    }
    public function user_id($user_id)
    {
        if ($user_id == 'false') {
            return $this->users->auth->get_user_id();
        }
    }
    public function before_dashboard_menu()
    {
        ob_start();
        ?>
      <div class="user-panel">
         <!-- <div class="pull-left image"><img class="img-circle" alt="user image" src=""/></div>-->
         <div class="pull-left info">
           <p><?php echo $this->events->apply_filters('user_menu_name', $this->config->item('default_user_names'));
        ?></p>
           <a href="#"><i class="fa fa-circle text-success"></i> Online</a> </div>
       </div>
      <?php
        return ob_get_clean();
    }
    public function dashboard()
    {
        $this->Gui->register_page('users', array( $this, 'users' ));
        $this->Gui->register_page('groups', array( $this, 'groups' ));
        $this->Gui->register_page('props', array( $this, 'props' ));
    }
    public function menu($menus)
    {
        $users_menu = $this->menu_users($menus);

        $props_menu = $this->menu_props($users_menu);

        return $props_menu;

        // $props_menu = $this->menu_props($menus);

        // $users_menu = $this->menu_props($props_menu);

        // return $users_menu;
    }

    public function menu_users($menus)
    {
        $menus[ 'users' ]        =    array(
            array(
                'title'            =>        __(get_lang('Users'), 'aauth'),
                'icon'            =>        'fa fa-users',
                'href'            =>        lang_site_url('dashboard/users'),
                'disable'    => true
            )
        );

        /**
         * Checks whether a user can manage user
        **/

        if (
            User::can('create_users') ||
            User::can('edit_users') ||
            User::can('delete_users')
        ) {
            // Top level
            $menus[ 'users' ]        =    array(
                array(
                    'title'     =>        __(get_lang('Users Management'), 'aauth'),
                    'icon'      =>        'fa fa-users',
                    'href'      =>        lang_site_url('dashboard/users'),
                    'disable'   =>        true  // disable menu title showed as first submenu
                )
            );

            // Sub level - 1. List all users
            $menus[ 'users' ][]    =                array(
                'title'            =>        __(get_lang('Users List'), 'aauth'),
                'icon'            =>        'fa fa-users',
                'href'            =>        lang_site_url('dashboard/users/list')
            );


            // Sub level - 2. Create a user
            $menus[ 'users' ][]    =                array(
                'title'            =>        __(get_lang('Create New'), 'aauth'),
                'icon'            =>        'fa fa-user-plus',
                'href'            =>        lang_site_url('dashboard/users/create')
            );

            // Sub leve - 3. Delete a user
            // $menus[ 'users' ][]    =                array(
            //     'title'            =>        __('Delete', 'aauth'),
            //     'icon'            =>        'fa fa-trash',
            //     'href'            =>        site_url('dashboard/users/delete')
            // );
        }        

        $menus[ 'users' ][]    =                array(
            'title'            =>        __(get_lang('My Profile'), 'aauth'),
            'icon'            =>        'fa fa-user-circle',
            'href'            =>        lang_site_url('dashboard/users/profile')
        );

        if (
            User::can("manage_core")
        )
        {
            $menus[ 'roles' ]        =        array(
                array(
                    'title'            =>        __(get_lang('Roles & Permissions'), 'aauth'),
                    'icon'            =>        'fa fa-shield',
                    'href'            =>        lang_site_url('dashboard/groups')
                )
            );
        }

        return $menus;
    }

    public function menu_props($menus)
    {
        $menus[ 'props' ]        =    array(
            array(
                'title'            =>        __('Props', 'aauth'),
                'icon'            =>        'fa fa-home',
                'href'            =>        lang_site_url('dashboard/props'),
                'disable'    => true
            )
        );

        /**
         * Checks whether a user can manage user
        **/

        if (
            User::can('create_property') ||
            User::can('edit_property') ||
            User::can('delete_property')
        ) {
            $menus[ 'props' ]        =    array(
                array(
                    'title'     =>        __(get_lang('Property Management'), 'aauth'),
                    'icon'      =>        'fa fa-home',
                    'href'      =>        lang_site_url('dashboard/props'),
                    'disable'   =>        true  // disable menu title showed as first submenu
                )
            );

            $menus[ 'props' ][]    =                array(
                'title'            =>        __(get_lang('Property List'), 'aauth'),
                'icon'            =>        'fa fa-list',
                'href'            =>        lang_site_url('dashboard/props/list')
            );

            $menus[ 'props' ][]    =                array(
                'title'            =>        __(get_lang('Create New Property'), 'aauth'),
                'icon'            =>        'fa fa-plus',
                'href'            =>        lang_site_url('dashboard/props/create')
            );

        //     $menus[ 'roles' ]        =        array(
        //         array(
        //             'title'            =>        __('Roles & Permissions', 'aauth'),
        //             'icon'            =>        'fa fa-shield',
        //             'href'            =>        site_url('dashboard/groups')
        //         )
        //     );
        // }

        // $menus[ 'users' ][]    =                array(
        //     'title'            =>        __('Delete', 'aauth'),
        //     'icon'            =>        'fa fa-trash',
        //     'href'            =>        lang_site_url('dashboard/users/delete')
        // );

        // $menus[ 'users' ][]    =                array(
        //     'title'            =>        __('My profile', 'aauth'),
        //     'icon'            =>        'fa fa-user-circle',
        //     'href'            =>        lang_site_url('dashboard/users/profile')
        // );

            return $menus;
        }
    }

    /**
     * Perform Change over Auth emails config
     *
     * @access : public
     * @param : string user names
     * @return : string
    **/

    public function user_menu_name($user_name)
    {
        $name    =    $this->users->get_meta('first-name');
        $last    =    $this->users->get_meta('last-name');
        $full    =    trim(ucwords(substr($name, 0, 1)) . '.' . ucwords($last));
        return $full == '.' ? $user_name : $full;
    }

    /**
     * Perform Change over Auth emails config
     *
     * @access : public
     * @param : string user names
     * @return : string
    **/

    public function user_menu_header($user_name)
    {
        $name    =    $this->users->get_meta('first-name');
        $last    =    $this->users->get_meta('last-name');
        $full    =    trim(ucwords(substr($name, 0, 1)) . '.' . ucwords($last));
        return $full == '.' ? $user_name : $full;
    }



    /**
     * Get dashboard skin for current user
     *
     * @access : public
     * @param : string
     * @return : string
    **/

    public function dashboard_body_class($class)
    {
        //var_dump( $this->users->get_meta( 'theme-skin' ) );die;
        // skin is defined by default
        $class    =    ($db_skin = $this->users->get_meta('theme-skin')) ? $db_skin : $class; // weird ??? lol

        unset($db_skin);

        // get user sidebar status
        $sidebar        =    $this->users->get_meta('dashboard-sidebar');
        if ($sidebar == true) {
            $class    .= ' ' . $sidebar;
        } else {
            $class    .=    ' sidebar-expanded';
        }
        return $class;
    }

    public function users_list($index)
    {
        if (
            ! User::can('edit_users') &&
            ! User::can('delete_users') &&
            ! User::can('create_users')
        ) {
            redirect(array( 'dashboard', 'access-denied' ));
        }

        $this->load->library('pagination');

        $config['base_url']             =    site_url(array( 'dashboard', 'users', 'list' )) . '/';
        $config['total_rows']           =    $this->users->auth->count_users();
        $config['per_page']             =    30;
        $config['full_tag_open']        =    '<ul class="pagination">';
        $config['full_tag_close']       =    '</ul>';
        $config['next_tag_open']        =    $config['prev_tag_open']    =    $config['num_tag_open']        =    '<li>';
        $config['next_tag_close']       =    $config['prev_tag_close']    =    $config['num_tag_close']    =    '</li>';
        $config['cur_tag_open']         =    '<li class="active"><a href="#">';
        $config['cur_tag_close']        =    '</a></li>';
        $config['num_links']            =     $config['total_rows'];

        $this->pagination->initialize($config);

        $users                          =    $this->users->auth->list_users( false, $index, $config['per_page'], true);

        $this->events->add_filter( 'gui_page_title', function( $filter ) {
            $filter     =  '<section class="content-header">
              <h1>
                    ' . str_replace('&mdash; ' . get('core_signature'), '', Html::get_title()) . '<small></small>
                    <a class="btn btn-primary btn-sm pull-right ng-binding" href="' . lang_site_url('dashboard/users/create') . '">' . __( get_lang('Add A User'), 'aauth' ) . '</a>
              </h1>

            </section>';
            return $filter;
        });

        $this->Gui->set_title(sprintf(__(get_lang("Users") . ' &mdash; %s', 'aauth'), get('core_signature')));

        $this->load->mu_module_view( 'aauth', 'users/body', array(
            'users'                    =>    $users,
            'pagination'                =>    $this->pagination->create_links()
        ));
    }

    public function users_edit($index)
    {
        // if current user matches user id
        if ($this->users->auth->get_user_id() == $index) {
            redirect(array( 'dashboard', 'users', 'profile' ));
        }

        if (! User::can('edit_users')) {
            redirect(array( 'dashboard', 'access-denied' ));
        }

        $user_group            =    farray($this->users->auth->get_user_groups($index));

        // validation rules
        $this->load->library('form_validation');

        $this->form_validation->set_rules('user_email', __('User Email', 'aauth'), 'required|valid_email');
        $this->form_validation->set_rules('password', __('Password', 'aauth'), 'min_length[6]');
        $this->form_validation->set_rules('confirm', __('Confirm', 'aauth'), 'matches[password]');
        $this->form_validation->set_rules('userprivilege', __('User Privilege', 'aauth'), 'required');

        // load custom rules
        $this->events->do_action('user_creation_rules');

        if ($this->form_validation->run()) {

            $exec    =    $this->users->edit(
                $index,
                $this->input->post('user_email'),
                $this->input->post('password'),
                $this->input->post('userprivilege'),
                $user_group,
                $this->input->post( 'confirm' ),
                $mode   =   'edit',
                $this->input->post( 'user_status' )
            );

            $this->notice->push_notice($this->lang->line('user-updated'));
        }

        // User Goup
        $user                   =    $this->users->auth->get_user($index);
        $user_group             =    farray($this->users->auth->get_user_groups($user->id));
        // selecting groups
        $groups                 =    $this->users->auth->list_groups();
        if (! $user) {
            redirect(array( 'dashboard', 'unknow-user' ));
        }

        $this->events->add_filter( 'gui_page_title', function( $filter ) {
            $filter     =  '<section class="content-header">
                <h1>
                    ' . str_replace('&mdash; ' . get('core_signature'), '', Html::get_title()) . '<small></small>
                    <a class="btn btn-primary btn-sm pull-right ng-binding" href="' . site_url([ get_lang_from_url() . '/dashboard', 'users' ] )  . '">' . __( 'Return to the list', 'aauth' ) . '</a>
                </h1>

            </section>';
            return $filter;
        });

        $this->Gui->set_title(sprintf(__('Edit user &mdash; %s', 'aauth'), get('core_signature')));
        $this->load->mu_module_view( 'aauth', 'users/edit', array(
            'groups'        =>    $groups,
            'user'            =>    $user,
            'user_group'    =>    $user_group
        ));
    }

    public function users_create($index)
    {
        if (! User::can('create_users')) {
            redirect(array( 'dashboard', 'access-denied' ));
        }

        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', __('User Name', 'aauth'), 'required|min_length[5]');
        $this->form_validation->set_rules('user_email', __('User Email', 'aauth'), 'required|valid_email');
        $this->form_validation->set_rules('password', __('Password', 'aauth'), 'required|min_length[6]');
        $this->form_validation->set_rules('confirm', __('Confirm', 'aauth'), 'required|matches[password]');
        $this->form_validation->set_rules('userprivilege', __('User Privilege', 'aauth'), 'required');

        // load custom rules
        $this->events->do_action('user_creation_rules');

        if ($this->form_validation->run()) {

            $exec    =    $this->users->create(
                $this->input->post('user_email'),
                $this->input->post('password'),
                $this->input->post('username'),
                $this->input->post('userprivilege'),
                $this->input->post( 'user_status' )
            );

            if ($exec == 'user-created') {
                redirect(array( 'dashboard', 'users?notice=' . $exec ));
                exit;
            }

            if (is_string($exec)) {
                $this->notice->push_notice($this->lang->line($exec));
            }
        }

        // selecting groups
        $groups                =    $this->users->auth->list_groups();

        $this->events->add_filter( 'gui_page_title', function( $filter ) {
            $filter     =  '<section class="content-header">
              <h1>
                    ' . str_replace('&mdash; ' . get('core_signature'), '', Html::get_title()) . '<small></small>
                    <a class="btn btn-primary btn-sm pull-right ng-binding" href="' . site_url([ get_lang_from_url() . '/dashboard', 'users' ] ) . '">' . __( 'Return to the list', 'aauth' ) . '</a>
              </h1>

            </section>';
            return $filter;
        });

        $this->Gui->set_title(sprintf(__(get_lang('Create a new user') . ' &mdash; %s', 'aauth'), get('core_signature')));

        $this->load->mu_module_view( 'aauth', 'users/create', array(
            'groups'    =>    $groups
        ));
    }

    public function users_delete($index)
    {
        if (! User::can('delete_users')) {
            redirect(array( 'dashboard', 'access-denied' ));
        }

        $user    =    $this->users->auth->get_user($index);

        if( User::id() == $user->id ) {
            redirect( array( 'dashboard', 'users?notice=cant-delete-yourself' ) );
        }

        if ($user) {
            $this->users->delete($index);
            redirect(array( 'dashboard', 'users?notice=user-deleted' ));
        }

        redirect(array( 'dashboard', 'unknow-user' ));
    }

    public function users_profile($index)
    {
        if (! User::can('edit_profile')) {
            redirect(array( 'dashboard', 'access-denied' ));
        }

        $userId = $this->users->current->id; // ignore $index here. it's useless actually

        $user_group            =    farray($this->users->auth->get_user_groups($userId));

        $this->load->library('form_validation');

        $this->form_validation->set_rules('user_email', __('User Email', 'aauth'), 'valid_email');
        $this->form_validation->set_rules('old_pass', __('Old Pass', 'aauth'), 'min_length[6]');
        $this->form_validation->set_rules('password', __('Password', 'aauth'), 'min_length[6]');
        $this->form_validation->set_rules('confirm', __('Confirm', 'aauth'), 'matches[password]');

        // Launch events for user profiles edition rules
        $this->events->do_action('user_profile_rules');

        if ($this->form_validation->run()) {
            $exec    =    $this->users->edit(
                $this->users->auth->get_user_id(),
                $this->input->post('user_email'),
                $this->input->post('password'),
                $user_group->group_id, //$this->input->post('userprivilege'),
                $user_group, // user Privilege can't be editer through profile dash
                $this->input->post('confirm'),
                'edit',
                "0",
                    $this->input->post('Phone'),
                    $this->input->post('Mobile'),
                    $this->input->post('Photo')
            );
            // return;

            // force refresh current user - otherwise page will load old information after saved
            $this->users->current = $this->auth->get_user(false, true);
            // var_dump( $exec );die;

            $this->notice->push_notice_array($exec);
        }
        
        $this->load->library( 'oauthLibrary' );

        $data                   =   array();
        $data[ 'apps' ]         =   $this->oauthlibrary->getUserApp( User::id() );
        $this->Gui->set_title(sprintf(__(get_lang("My Profile").' &mdash; %s', 'aauth'), get('core_signature')));

        $this->load->mu_module_view( 'aauth', 'users/profile', $data );
    }

    public function users_test($index)
    {
        if (! User::can('edit_profile')) {
            redirect(array( 'dashboard', 'access-denied' ));
        }

        $this->load->library('form_validation');

        $this->form_validation->set_rules('user_email', __('User Email', 'aauth'), 'valid_email');
        $this->form_validation->set_rules('old_pass', __('Old Pass', 'aauth'), 'min_length[6]');
        $this->form_validation->set_rules('password', __('Password', 'aauth'), 'min_length[6]');
        $this->form_validation->set_rules('confirm', __('Confirm', 'aauth'), 'matches[password]');

        // Launch events for user profiles edition rules
        $this->events->do_action('user_profile_rules');

        if ($this->form_validation->run()) {
            $exec    =    $this->users->edit(
                $this->users->auth->get_user_id(),
                $this->input->post('user_email'),
                $this->input->post('password'),
                $this->input->post('userprivilege'),
                null, // user Privilege can't be editer through profile dash
                $this->input->post('old_pass'),
                'profile'
            );

            // var_dump( $exec );die;

            $this->notice->push_notice_array($exec);
        }

        $this->load->library( 'oauthLibrary' );

        $data                   =   array();
        $data[ 'apps' ]         =   $this->oauthlibrary->getUserApp( User::id() );
        $this->Gui->set_title(sprintf(__(get_lang("My Profile").' &mdash; %s', 'aauth'), get('core_signature')));

         $this->load->mu_module_view( 'aauth', 'users/profile', $data );
    } 

    public function users($page = 'list', $index = 0)
    {
        if ($page == 'list') {
            $this->users_list($index);
        }
        elseif ($page == 'edit') {
            $this->users_edit($index);
        }
        elseif ($page == 'create') {
            $this->users_create($index);
        }
        elseif ($page == 'delete') {
            $this->users_delete($index);
        } 
        elseif ($page == 'profile') {
            $this->users_profile($index);
        }
        elseif ($page == 'test') {
            $this->users_test($index);
        }
    }

    /**
     * Admin Roles
     *
     * Handle Groups management
     * @since 1.5
    **/

    public function groups($page = 'list', $index = 1)
    {
        if (
            ! User::can('create_users') &&
            ! User::can('edit_users') &&
            ! User::can('delete_users')
        ) {
            redirect(array( 'dashboard', 'access-denied' ));
        }

        // Display all roles
        if ($page == 'list') {
            $groups        =    $this->users->auth->list_groups();

            $this->Gui->set_title(sprintf(__(get_lang('Roles') . ' &mdash; %s', 'aauth'), get('core_signature')));

            $this->load->mu_module_view( 'aauth', 'groups/body', array(
                'groups'    =>    $groups
            ));
        }
    }

    public function props($page = 'list', $index = 1)
    {
        $data["property_id"] = $index;

        if ($page == 'list') {
            $this->Gui->set_title(__('Properties', 'aauth'));
            $this->load->mu_module_view( 'aauth', 'props/list', null);
        }
        elseif ($page == 'create') {
            $this->Gui->set_title(__('Create a Property', 'aauth'));
            $this->load->mu_module_view( 'aauth', 'props/create', null);
        }
        elseif ($page == 'edit') {
            $this->Gui->set_title(__('Edit Property', 'aauth'));
            $this->load->mu_module_view( 'aauth', 'props/edit', $data);
        }
        elseif ($page == 'delete') {
            $this->Gui->set_title(__('Edit Property', 'aauth'));
            $this->load->mu_module_view( 'aauth', 'props/delete', $data);
        }
        elseif ($page == 'submit') {
            $this->Gui->set_title(__('Submit Property', 'aauth'));
            $data["target_status_id"] = 2;
            $this->load->mu_module_view( 'aauth', 'props/update_status', $data);
        }
        elseif ($page == 'publish') {
            $this->Gui->set_title(__('Publish Property', 'aauth'));
            $data["target_status_id"] = 3;
            $this->load->mu_module_view( 'aauth', 'props/update_status', $data);
        }
    }
}
new aauth_dashboard;
