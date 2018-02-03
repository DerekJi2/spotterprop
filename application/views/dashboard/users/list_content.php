

<style>
.prop-list-table  tr img.gallery { width:100px;} 
.prop-list-row-loc { color: grey; display:inline-block; margin-left:5px; }
.type-icon { height:24px; }
.item-specific { margin: 4px 0; }
.item-specific img.item-spec { width:12px; margin-right:3px; }
.item-specific span { display:inline-block; }
.item-specific span.spn-item-spec-sm { width:30px; }
.item-specific span.spn-item-spec-lg { width:60px; }

.agent-image img { width:60px; margin-right:10px; }
.td-agent { width:120px; }
.agent-info i { display:inline-block; margin-right:3px; width:14px; }
.td-status .label { display:inline-block; width:60px; }
.td-status div { width:100%; text-align:center; }
.td-status div a { font-size:12px; }
</style>

<?php
/**
 * 	File Name 	: 	body.php
 *	Description :	header file for each admin page. include <html> tag and ends at </head> closing tag
 *	Since		:	1.4
**/
$this->load->helper("MY_data_helper");
$users =    get_users();
$complete_users    =    array();

// Get current login user's group_id
$loginId = $this->users->current->id; 
$login_group            =    farray($this->users->auth->get_user_groups($loginId));
$login_group_id = $login_group->group_id;

// adding user to complete_users array
foreach ($users as $user) {
    $userId = $user->id;
    $user_group            =    farray($this->users->auth->get_user_groups($userId));
    $user_group_id = $user_group->group_id;

    $delete_confirm_string = get_lang("Would you like to delete this account ?");
    
    $user_edit_link = site_url(array( get_lang_from_url() . '/dashboard', 'users', 'edit', $user->id ));
    $delete_button = '<a onclick="return confirm( \'' . _s( $delete_confirm_string, 'aauth' ) . '\' )" href="' . site_url(array( 'dashboard', 'users', 'delete', $user->id )) . '">' . '<i class="fa fa-trash-o"></i></a>';

    // Editors should NOT be able to delete or edit Admin/Editor accounts
    if ($login_group_id != 4 && $login_group_id >= $user_group_id)
    {
        $delete_button = "";
        $delete_confirm_string = get_lang('Insufficient privileges: you can not edit this account.');
        $user_edit_link = "javascript: alert('$delete_confirm_string');";
    }

    $complete_users[]    =    array(
        $user->id ,
        '<a href="' . $user_edit_link . '">' . $user->name . '</a>' ,
        //$user->group_name,
        $user->email ,
        $user->last_login,
        $user->banned   ==  1 ? __( get_lang('Unactive') , 'aauth') : __( get_lang('Active') , 'aauth'), $delete_button,
    );
}

?>

<?php //$this->load->view("dashboard/properties/list_paging"); ?>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<div class="container container-fluid">
<?php 
    $count = 0;
    $total_count = sizeof($complete_users);
    foreach ($users as $user) { ?>
        <?php
            $count++; 
            $field_name = '<a href="' . $user_edit_link . '">' . $user->name . '</a>';
            $field_activity = $user->remember_time;
            $field_email = '<a href="mailto:' . $user->email . '">' . $user->email . '</a>';
            $field_status = $user->banned   ==  1 ? __( get_lang('Unactive') , 'aauth') : __( get_lang('Active') , 'aauth'); 
        ?>
        <div class="row user-row">
            <div class="col-sm-5 col-md-5 col-lg-4">
                <strong>#<?= $user->id ?>. </strong>
                <small class="user-role-<?= $user->roles ?>"><?= get_lang($user->roles) ?></small>
                <span class="user-name"><?= $field_name ?></span>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6">
                <span><?= $field_email ?></span>
            </div>
            <div class="col-sm-1 col-md-1 col-lg-1 user-delete">
                <?= $delete_button ?>
            </div>

            
            <!-- <div class="col-sm-12 col-md- col-lg-2"><?= $field_activity ?></div> -->
        </div>
        
    <?php } ?>

</div>

<style>
.user-row {
    /* border: 1px solid #939393; */
    font-size:12px;
    margin-bottom: 5px;
    width:80%;
}

.user-name a { font-weight:bold; text-decoration:none;  color: #3333ff;}
.user-role { font-size:10px; }
.user-role-Users { color:#9a9a9a; }
.user-role-Editors { color:#dd9933; }
.user-role-Admin { color:#ff3333; }

.user-delete a { text-decoration:none; color:#EE0000;}
</style>