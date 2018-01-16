<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$this->load->helper('MY_data_helper');

$_DEBUG_ = true;
$_Timestamp = "?v=";
$_Timestamp .= $_DEBUG_ ? time() : date("Y.m.d");
?><!DOCTYPE html>
<script type="text/javascript">
var BASEURL = "<?php echo site_url() ?>";
</script>
<html lang="en-US">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link href="<?php echo site_url('assets/fonts/font-awesome.css') ?>" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo site_url('assets/bootstrap/css/bootstrap.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo site_url('assets/css/bootstrap-select.min.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo site_url('assets/css/owl.carousel.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo site_url('assets/css/style.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo site_url('assets/css/user.style.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo site_url('assets/css/user.spotter.css'.$_Timestamp) ?>" type="text/css">

    <title>Spotter - Universal Directory Listing HTML Template</title>

</head>

<body onunload="" class="page-subpage page-item-detail navigation-off-canvas" id="page-top">

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
                <div class="breadcrumb-wrapper">
                    <div class="container">
                        <?php $this->view("templates/redefine_search_bar"); ?>
                    </div>
                </div>
            </section>
            <!--end Sub Header-->
            <!--Page Content-->
            <div id="page-content">

                <div id="map-detail"></div>
                <section class="container">
                    <div class="row">
                        <!--Item Detail Content-->
                        <div class="col-md-9">
                            <section class="block" id="main-content">
                                <header class="page-title">
                                    <div class="title">
                                        <h1><?php echo $vw->title; ?></h1>
                                        <figure><?php echo $vw->location; ?></figure>
                                    </div>
                                    <div class="info">
                                        <div class="type">
                                            <i><img src="<?php echo site_url($vw->type_icon) ?>" alt=""></i>
                                            <span><?= get_lang($vw->type) ?></span>
                                        </div>
                                    </div>
                                </header>
                                <div class="row">
                                    <?php $this->view("Property/_detail_left_sidebar", $agent); ?>
                                    <!--Content-->
                                    <div class="col-md-8 col-sm-8">
                                        <section>
                                            <article class="item-gallery">
                                                <div class="owl-carousel item-slider">
                                                <?php
                                                    $count = 0;
                                                    foreach($vw->gallery as $image)
                                                    {
                                                        $count++;
                                                        $imagePath = site_url($image);
                                                        $div = "<div class=\"slide\"><img alt=\"\" src=\"$imagePath\" data-hash=\"$count\"></div>";
                                                        echo $div;
                                                    }
                                                ?>                                                    
                                                </div>
                                                <!-- /.item-slider -->
                                                <div class="thumbnails">
                                                    <?php if ($count > 5) { ?>
                                                    <span class="expand-content btn framed icon" data-expand="#gallery-thumbnails" >More<i class="fa fa-plus"></i></span>
                                                    <?php } ?>
                                                    <div class="expandable-content height collapsed show-70" id="gallery-thumbnails">
                                                        <div class="content">
                                                        <?php
                                                            $count = 0;
                                                            foreach($vw->gallery as $image)
                                                            {
                                                                $count++;
                                                                $imagePath = site_url($image);
                                                                $thumbnail = "<a href=\"#$count\" id=\"thumbnail-$count\" class=\"active\">
                                                                <img alt=\"\" src=\"$imagePath\"></a>";
                                                                echo $thumbnail;
                                                            }
                                                        ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                            <!-- /.item-gallery -->
                                            <article class="block">
                                                <header><h2><?= get_lang('Description') ?></h2></header>
                                                <p>
                                                <?php echo $vw->description; ?>
                                                </p>
                                            </article>
                                            <!-- /.block -->
                                            <article class="block">
                                                <header><h2><?= get_lang('Features') ?></h2></header>
                                                <ul class="bullets">
                                                <?php 
                                                    foreach ($vw->features as $feature)
                                                    {
                                                        echo "<li>".get_lang($feature)."</li>";
                                                    } 
                                                ?>
                                                </ul>
                                            </article>
                                            <!-- /.block -->
                                        </section>                                        
                                        
                                        <?php 
                                        // $this->view("Property/_reviews"); 
                                        // $this->view("Property/_review_form"); 
                                        ?>
                                    </div>
                                    <!-- /.col-md-8-->
                                </div>
                                <!-- /.row -->
                            </section>
                            <!-- /#main-content-->
                        </div>
                        <!-- /.col-md-8-->

                        <?php $this->view("Property/_page_sidebar", $latest); ?>
                    </div><!-- /.row-->
                </section>
                <!-- /.container-->
            </div>
            <!-- end Page Content-->
        </div>
        <!-- end Page Canvas-->

        <?php $this->view("Home/_page_footer"); ?>
    </div>
    <!-- end Inner Wrapper -->
</div>
<!-- end Outer Wrapper-->

<script type="text/javascript" src="<?php echo site_url('assets/js/jquery-2.1.0.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/js/before.load.js'.$_Timestamp) ?>"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;libraries=places&key=AIzaSyCVbV919dtZDR5eKhk1LuRpuS26tdeyHBc"></script>
<script type="text/javascript" src="<?php echo site_url('assets/js/jquery-migrate-1.2.1.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/js/markerclusterer.js'.$_Timestamp) ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/js/richmarker-compiled.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/js/smoothscroll.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/js/infobox.js'.$_Timestamp) ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/js/bootstrap-select.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/js/jquery.hotkeys.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/js/custom.js'.$_Timestamp) ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/js/maps.js'.$_Timestamp) ?>"></script>
<script type="text/javascript" src="<?=site_url('assets/js/local.common.js'.$_Timestamp) ?>"></script>

<?php $this->view("templates/google_translate"); ?>

<script>
    var itemID = <?php echo $vw->id; ?>;
    $.getJSON(BASEURL + 'Property/JsonList')
        .done(function(json) {
                $.each(json.data, function(a) {
                    if( json.data[a].id == itemID ) {
                        itemDetailMap(json.data[a]);
                    }
                });
        })
        .fail(function( jqxhr, textStatus, error ) {
            console.log(error);
        })
    ;
    $(window).load(function(){
        setInputsWidth();

        var rtl = false; // Use RTL
        initializeOwl(rtl);
    });
</script>


<!--[if lte IE 9]>
<script type="text/javascript" src="<?php echo site_url('assets/js/ie-scripts.js') ?>"></script>
<![endif]-->
</body>
</html>