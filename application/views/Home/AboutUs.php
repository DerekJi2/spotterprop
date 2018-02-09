<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$this->load->helper('MY_data_helper');
$this->load->helper('MY_AboutUs_helper');
$lang = get_lang_from_url();
$aboutUs = get_aboutus($lang);

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
    <link rel="icon" href="<?= site_url('assets/img/syr/icon.ico') ?>" type="image/ico">

    <link href="<?=site_url('assets/fonts/font-awesome.css'.$_Timestamp) ?>" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?=site_url('assets/bootstrap/css/bootstrap.css'.$_Timestamp) ?>" type="text/css">
    <link rel="stylesheet" href="<?=site_url('assets/css/bootstrap-select.min.css'.$_Timestamp) ?>" type="text/css">
    <link rel="stylesheet" href="<?=site_url('assets/css/owl.carousel.css'.$_Timestamp) ?>" type="text/css">

    <link rel="stylesheet" href="<?=site_url('assets/css/style.css'.$_Timestamp) ?>" type="text/css">
    <link rel="stylesheet" href="<?=site_url('assets/css/user.style.css'.$_Timestamp) ?>" type="text/css">
    <link rel="stylesheet" href="<?=site_url('assets/css/user.spotter.css'.$_Timestamp) ?>" type="text/css">

    <title>About Us</title>

</head>

<body onunload="" class="page-subpage page-about-us navigation-off-canvas" id="page-top">

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
                <section class="container">
                    <header>
                        <h1 class="page-title"><?= get_lang("About Us") ?></h1>
                    </header>
                </section>
                <!--/.container-->
                <section id="image">
                    <div class="container">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="text-banner">
                                <figure>
                                    <img src="<?=site_url('assets/img/marker.png'); ?>" alt="">
                                </figure>
                                <div class="description">
                                    <h2><?= $aboutUs->Title ?></h2>
                                    <p><?= $aboutUs->Descriptions ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/.container-->
                    <div class="background">
                        <img src="<?=site_url('assets/img/about-us-bg.jpg'); ?>" alt="">
                    </div>
                    <!--/.bakcground-->
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
<script type="text/javascript" src="<?=site_url('assets/js/local.redirect.js'.$_Timestamp) ?>"></script>
<script type="text/javascript" src="<?=site_url('assets/js/local.common.js'.$_Timestamp) ?>"></script>

<?php $this->view("templates/google_translate"); ?>

<script>
    $(window).load(function(){
        nsRedirect.OnLoad();

        var rtl = false; // Use RTL
        initializeOwl(rtl);
    });
</script>

<!--[if lte IE 9]>
<script type="text/javascript" src="assets/js/ie-scripts.js"></script>
<![endif]-->
</body>
</html>