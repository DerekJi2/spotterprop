<?php  // CHECKING

$this->load->helper("MY_user_helper");
$this->load->helper("MY_model_helper");

$userId = $this->users->current->id;
$group_id = get_group_id($userId);
$statusid = 0;
$error = false;
$errmsg = '';   

// Check 1: user level
if ($group_id == 6) // Users
{
    $property_owner_id = get_property_person_id($property_id);     
    
    if ($property_owner_id != $userId)
    {
        $error = true;
        $errmsg = '<p>Sorry, you are not allowed to submit this property.</p>';
    }
}

// Check 2: property status
$property_data = get_property_details($property_id);
$statusid = $property_data["vw"]->StatusId;
if ($target_status_id == 2 && $statusid != 1)
{
    $error = true;
    $errmsg = '<p>Sorry, this property had been submitted already.</p>';
}
elseif ($target_status_id == 3 && $statusid != 2)
{
    $error = true;
    $errmsg = '<p>Sorry, this property had been published already.</p>';
}

// Publish View
if ($error)
{   
?>
    <?php
        $this->load->view("dashboard/properties/_framework_header");
    ?>

        <section class="content-header">
            <h1>
                Submit Property<small></small>
            </h1>
            <a class="btn btn-primary btn-sm pull-right ng-binding" href="http://localhost:8080/syrian/dashboard/props/list"><?= get_lang("Return to the list") ?></a>
        </section> <!-- section .content-header -->
        
        <div class="content">        
            <h2>Warning!</h2>
            <?= $errmsg ?>
            <p>If you are pretty sure there must be something wrong in our system, please contact our service staff.</p>
            <p>Phone: 08 1234 5678</p>
            <p>Email: <a href="mailto:service@brickservices.com">service@brickservices.com</a></p>
        </div> <!-- div .content -->

    <?php
        $this->load->view("dashboard/properties/_framework_end");
    ?>
<?php 
}
else // successful!
{
    $ok = update_property_status($property_id, $target_status_id, $userId);
    // $this->load->mu_module_view( 'aauth', 'props/list', null);
    header("Location: ".site_url()."dashboard/props/list");
    exit;
} ?>


