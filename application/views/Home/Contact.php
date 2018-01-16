<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$this->load->helper('MY_data_helper');

$_DEBUG_ = true;
$_Timestamp = "?v=";
$_Timestamp .= $_DEBUG_ ? time() : date("Y.m.d");
?>
<!DOCTYPE html>
<script type="text/javascript">
var BASEURL = "<?=site_url() ?>";
</script>
<html lang="en-US">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="<?=site_url('assets/fonts/font-awesome.css'.$_Timestamp) ?>" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?=site_url('assets/bootstrap/css/bootstrap.css'.$_Timestamp) ?>" type="text/css">
    <link rel="stylesheet" href="<?=site_url('assets/css/bootstrap-select.min.css'.$_Timestamp) ?>" type="text/css">
    <link rel="stylesheet" href="<?=site_url('assets/css/owl.carousel.css'.$_Timestamp) ?>" type="text/css">

    <link rel="stylesheet" href="<?=site_url('assets/css/style.css'.$_Timestamp) ?>" type="text/css">
    <link rel="stylesheet" href="<?=site_url('assets/css/user.style.css'.$_Timestamp) ?>" type="text/css">
    <link rel="stylesheet" href="<?=site_url('assets/css/user.spotter.css'.$_Timestamp) ?>" type="text/css">


    <title>Contact</title>

</head>

<body onunload="" class="page-subpage page-contact navigation-off-canvas" id="page-top">

<!-- Outer Wrapper-->
<div id="outer-wrapper">
    <!-- Inner Wrapper -->
    <div id="inner-wrapper">
        <?php 
            $this->view("templates/navigation"); 
        ?>
        <!-- Page Canvas-->
        <div id="page-canvas">
            <!--Off Canvas Navigation-->
            <nav class="off-canvas-navigation">
                <header><?= get_lang('Navigation') ?></header>
                <div class="main-navigation navigation-off-canvas">
                    <?php
                        $this->view("templates/navigation_menu");
                    ?>
                </div>
            </nav>
            <!--end Off Canvas Navigation-->

            <!--Sub Header-->
            <section class="sub-header">
                <div class="search-bar horizontal collapse" id="redefine-search-form">
                    <?php $this->view("templates/redefine_search_panel"); ?>
                </div>
                <!-- /.search-bar -->
                <div class="breadcrumb-wrapper">
                    <?php $this->view("templates/redefine_search_bar"); ?>
                    <!-- /.container-->
                </div>
                <!-- /.breadcrumb-wrapper-->
            </section>
            <!--end Sub Header-->

            <!--Page Content-->
            <div id="page-content">
                <section id="map-simple" class="map-contact"></section>
                <section class="container">
                    <div class="row">
                        <!--Content-->
                        <div class="col-md-9">
                            <header>
                                <h1 class="page-title">Contact</h1>
                            </header>
                            <section>
                                <div class="row">
                                    <div class="col-md-4 col-sm-4">
                                        <header class="no-border"><h3>Address</h3></header>
                                        <address>
                                            <div><strong>Spotter Limited</strong></div>
                                            <div>63 Birch Street</div>
                                            <div>Granada Hills, CA 91344</div>
                                            <br>
                                            <figure>
                                                <div class="info">
                                                    <i class="fa fa-mobile"></i>
                                                    <span>818-832-5258</span>
                                                </div>
                                                <div class="info">
                                                    <i class="fa fa-phone"></i>
                                                    <span>+1 123 456 789</span>
                                                </div>
                                                <div class="info">
                                                    <i class="fa fa-globe"></i>
                                                    <a href="#">www.spotterlimited.com</a>
                                                </div>
                                            </figure>
                                        </address>
                                    </div>
                                    <!--/.col-md-4-->
                                    <div class="col-md-4 col-sm-4">
                                        <header class="no-border"><h3>Social Networks</h3></header>
                                        <a href="#" class="social-button"><i class="fa fa-twitter"></i>Twitter</a>
                                        <a href="#" class="social-button"><i class="fa fa-facebook"></i>Facebook</a>
                                        <a href="#" class="social-button"><i class="fa fa-pinterest"></i>Pinterest</a>
                                    </div>
                                    <!--/.col-md-4-->
                                    <div class="col-md-4 col-sm-4">
                                        <header class="no-border"><h3>About Us</h3></header>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean tristique imperdiet
                                            nibh tincidunt fermentum. Nunc enim nibh, convallis et tincidunt in, vehicula a diam.
                                            Nullam in risus erat
                                        </p>
                                        <a href="<?=site_url('Home/AboutUs'); ?>" class="read-more icon">Read More</a>
                                    </div>
                                    <!--/.col-md-4-->
                                </div>
                                <!--/.row-->
                            </section>
                            <hr>
                        </div>
                        <!--Sidebar-->
                        <?php // Page Footer
                            $this->view("Property/_page_sidebar");
                        ?>
                        <!-- /.col-md-3-->
                        <!--end Sidebar-->
                    </div>
                </section>
            </div>
            <!-- end Page Content-->
        </div>
        <!-- end Page Canvas-->
        <!--Page Footer-->
        <?php // Page Footer
            $this->view("Home/_page_footer");
        ?>
        <!--end Page Footer-->
    </div>
    <!-- end Inner Wrapper -->
</div>
<!-- end Outer Wrapper-->


<script type="text/javascript" src="<?=site_url('assets/js/jquery-2.1.0.min.js'); ?>"></script>
<script type="text/javascript" src="<?=site_url('assets/js/before.load.js'); ?>"></script>
<script type="text/javascript" src="<?=site_url('assets/js/jquery-migrate-1.2.1.min.js'); ?>"></script>
<script type="text/javascript" src="<?=site_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?=site_url('assets/js/smoothscroll.js'); ?>"></script>
<script type="text/javascript" src="<?=site_url('assets/js/bootstrap-select.min.js'); ?>"></script>
<script type="text/javascript" src="<?=site_url('assets/js/jquery.hotkeys.js'); ?>"></script>
<script type="text/javascript" src="<?=site_url('assets/js/custom.js'); ?>"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;libraries=places&key=AIzaSyCVbV919dtZDR5eKhk1LuRpuS26tdeyHBc"></script>
<script type="text/javascript" src="<?=site_url('assets/js/richmarker-compiled.js'.$_Timestamp) ?>"></script>
<script type="text/javascript" src="<?=site_url('assets/js/maps.js'.$_Timestamp) ?>"></script>
<script type="text/javascript" src="<?=site_url('assets/js/local.redirect.js'.$_Timestamp) ?>"></script>
<script type="text/javascript" src="<?=site_url('assets/js/local.common.js'.$_Timestamp) ?>"></script>

<?php $this->view("templates/google_translate"); ?>

<script>
    $(window).load(function(){
        nsRedirect.OnLoad();
        
        var _latitude = 51.541599;
        var _longitude = -0.112588;
        var draggableMarker = false;
        simpleMap(_latitude, _longitude,draggableMarker);
    });
</script>

<!--[if lte IE 9]>
<script type="text/javascript" src="assets/js/ie-scripts.js"></script>
<![endif]-->
</body>
</html>