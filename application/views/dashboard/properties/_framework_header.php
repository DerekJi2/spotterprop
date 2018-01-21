<?php 

$this->load->helper('url');
$this->load->helper('MY_data_helper');
$this->load->helper('MY_model_helper');
$this->Gui->output_framework(); 

$_DEBUG_ = true;
$_Timestamp = "?v=";
$_Timestamp .= $_DEBUG_ ? time() : date("Y.m.d");
?>


<div class="content-wrapper" style="min-height: 916px;" id="content-box" name="content-box" >