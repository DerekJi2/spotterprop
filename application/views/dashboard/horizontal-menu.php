<?php
defined('BASEPATH') or exit('No direct script access allowed');

$this->load->helper("MY_data_helper");
/**
 * 	@details : Admin header page
 *	@role : This page page is used to displays dashboard header
 * 	@since : 1.5
 *
**/
?>
<body class="<?php echo xss_clean($this->events->apply_filters('dashboard_body_class', 'skin-blue'));?> fixed sidebar-mini" <?php echo xss_clean($this->events->apply_filters('dashboard_body_attrs', 'ng-app="tendooApp"'));?>>
    <?php echo $this->events->do_action( 'before_body_content' );?>
    <div class="wrapper">
        <header class="main-header">

            <!-- Logo -->
            <a href="<?php echo lang_site_url('dashboard');?>" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><?php echo $this->events->apply_filters('dashboard_logo_small', $this->config->item('tendoo_logo_min'));?></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><?php echo xss_clean($this->events->apply_filters('dashboard_logo_long', $this->config->item('syprop_logo_long')));?></span> </a>

            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas"> <span class="sr-only">Toggle navigation</span> </a>
                <?php echo $this->events->apply_filters( 'tendoo_spinner', '<div class="pull-left" id="tendoo-spinner" style="margin-top:7px;margin-left:7px"></div>' );?>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <?php $this->events->do_action('display_admin_header_menu');?>
                        <!-- Notifications: style can be found in dropdown.less -->

                        <?php $this->load->view("dashboard/header_pms"); ?>
                        
                        <?php
                            $this->load->helper("MY_user_helper");
                            $loginUser = get_login_user();
                            $username = ($loginUser == null || $loginUser->name == null || $loginUser->name == "") ? 
                                            $this->config->item('default_user_names') :
                                            $loginUser->name;
                            $userImage = $loginUser->Photo;
                            if ($userImage == "") 
                                $userImage = $this->events->apply_filters('user_menu_card_avatar_src', '');
                        ?>
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        	<img class="img-circle" alt="<?php echo $this->events->apply_filters('user_menu_card_avatar_alt', '');?>" src="<?= $userImage ?>" width="20"/>
                            <span class="hidden-xs"><?php echo xss_clean($this->events->apply_filters('user_menu_name', $username));?></span> </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                	<img class="img-circle" alt="<?php echo $this->events->apply_filters('user_menu_card_avatar_alt', '');?>" src="<?= $userImage?>"/>
                                    <p><?php echo xss_clean($this->events->apply_filters('user_menu_card_header', $username));?></p>
                                </li>
                                <!-- Menu Body -->
                                <?php echo xss_clean($this->events->apply_filters('after_user_card', ''));?>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                <?php
                                $profile_url = $this->events->apply_filters('user_header_profile_link', '#');
                                $profile_url = str_replace(site_url(), lang_site_url(), $profile_url);

                                $sign_out_url = $this->events->apply_filters('user_header_sign_out_link', site_url(array( 'sign-out' )) . '?redirect=' . urlencode(current_url()));
                                ?>
                                    <div class="pull-left"> <a href="<?php echo xss_clean($profile_url);?>" class="btn btn-default btn-flat"><?php _e(get_lang('Profile'));?></a> </div>
                                    <div class="pull-right"> <a href="<?php echo xss_clean($sign_out_url);?>" class="btn btn-default btn-flat"><?php _e(get_lang('Sign Out'));?></a> </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
