<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');

$_DEBUG_ = true;
$_Timestamp = "?v=";
$_Timestamp .= $_DEBUG_ ? time() : date("Y.m.d");
?>
<!DOCTYPE html>
<script type="text/javascript">
var BASEURL = "<?php echo site_url() ?>";
</script>
<html lang="en-US">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="<?=base_url()?>/assets/img/syr/icon.ico" type="image/ico">
    <link href="<?php echo site_url('assets/fonts/font-awesome.css'.$_Timestamp) ?>" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo site_url('assets/bootstrap/css/bootstrap.css'.$_Timestamp) ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo site_url('assets/css/bootstrap-select.min.css'.$_Timestamp) ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo site_url('assets/css/owl.carousel.css'.$_Timestamp) ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo site_url('assets/css/jquery.mCustomScrollbar.css'.$_Timestamp) ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo site_url('assets/css/jquery.nouislider.min.css'.$_Timestamp) ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo site_url('assets/css/colors/green.css'.$_Timestamp) ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo site_url('assets/css/user.style.css'.$_Timestamp) ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo site_url('assets/css/user.spotter.css'.$_Timestamp) ?>" type="text/css">

    <script type="text/javascript" src="<?php echo site_url('assets/js/jquery-2.1.0.min.js'.$_Timestamp) ?>"></script>

    <title>Syrian Properties</title>

</head>

<body onunload="" class="map-fullscreen page-homepage navigation-off-canvas" id="page-top">

<!-- Outer Wrapper-->
<div id="outer-wrapper">
    <!-- Inner Wrapper -->
    <div id="inner-wrapper">
        <!-- Navigation-->
        <div class="header">
            <div class="wrapper">
                <div class="brand">
                    <a href="<?php echo site_url('Home') ?>">
                        <img src="<?php echo site_url('assets/img/syr/logo.png') ?>" alt="logo" style="margin:5px; height:25px;">
                        <span style="font-size:24px;">Syrian Properties</span>
                    </a>
                </div>
                <nav class="navigation-items">
                    <div class="wrapper">
                        <ul class="main-navigation navigation-top-header"></ul>
                        <ul class="user-area">
                            <li><a href="<?php echo site_url('sign-in.html') ?>">Sign In</a></li>
                            <li><a href="<?php echo site_url('register.html') ?>"><strong>Register</strong></a></li>
                        </ul>
                        <a href="<?php echo site_url('submit.html') ?>" class="submit-item">
                            <div class="content"><span>Submit Your Item</span></div>
                            <div class="icon">
                                <i class="fa fa-plus"></i>
                            </div>
                        </a>
                        <div class="toggle-navigation">
                            <div class="icon">
                                <div class="line"></div>
                                <div class="line"></div>
                                <div class="line"></div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- end Navigation-->
        <!-- Page Canvas-->
        <div id="page-canvas">
            <!--Off Canvas Navigation-->
            <nav class="off-canvas-navigation">
                <header>Navigation</header>
                <div class="main-navigation navigation-off-canvas"></div>
            </nav>
            <!--end Off Canvas Navigation-->