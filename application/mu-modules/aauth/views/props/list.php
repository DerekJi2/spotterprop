<?php 

$this->load->helper('url');
$this->load->helper('MY_data_helper');
$this->Gui->output_framework(); 

$_DEBUG_ = true;
$_Timestamp = "?v=";
$_Timestamp .= $_DEBUG_ ? time() : date("Y.m.d");
?>

<div class="content-wrapper" style="min-height: 916px;" id="content-box" name="content-box" >
	<section class="content-header">
        <h1>
            Property List <small></small>
        </h1>
    </section> <!-- section .content-header -->
    <div class="content">

        <?php $this->load->view("dashboard/properties/list_content"); ?>

    </div> <!-- div .content -->
</div> <!-- div .content-wrapper -->

<?php $this->Gui->output_end(); ?>

