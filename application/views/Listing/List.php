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

    <title>Listing - List Mode</title>

</head>

<body onunload="" class="page-subpage page-listing-list navigation-off-canvas" id="page-top">

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

            <?php $this->view("Listing/List_PageContent"); ?>
        </div>
        <!-- end Page Canvas-->
        <?php // Page Footer
            $this->view("Home/_page_footer");
        ?>
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
<script type="text/javascript" src="<?=site_url('assets/js/custom.js'.$_Timestamp); ?>"></script>
<script type="text/javascript" src="<?=site_url('assets/js/local.common.js'.$_Timestamp) ?>"></script>
<script type="text/javascript" src="<?=site_url('assets/js/local.redirect.js'.$_Timestamp) ?>"></script>
<script type="text/javascript" src="<?=site_url('assets/js/local.listing.js'.$_Timestamp) ?>"></script>
<script type="text/javascript" src="<?=site_url('assets/js/local.listing.pages.js'.$_Timestamp) ?>"></script>
<script type="text/javascript" src="<?=site_url('assets/js/local.searchengine.js'.$_Timestamp) ?>"></script>
<script type="text/javascript" src="<?=site_url('assets/js/local.redefinesearch.js'.$_Timestamp); ?>"></script>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;libraries=places&key=AIzaSyCVbV919dtZDR5eKhk1LuRpuS26tdeyHBc"></script>

<?php $this->view("templates/google_translate"); ?>

<?php 
    $queryString = strtolower($_SERVER['QUERY_STRING']);
?>

<script>
    var queryString = "<?=$queryString; ?>";

    $(window).load(function(){
        nsRedirect.OnLoad();
        nsListing.OnLoad();
        
        nsRedefineSearch.RedefineOnQuery(queryString);

        nsListingPages.OnLoad();
    });
</script>

<!--[if lte IE 9]>
<script type="text/javascript" src="assets/js/ie-scripts.js"></script>
<![endif]-->
</body>
</html>