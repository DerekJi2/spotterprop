<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$this->load->helper('MY_data_helper');
$this->load->helper('MY_model_helper');

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

    <title>Listing - Grid Mode</title>

</head>

<body onunload="" class="page-subpage page-listing-grid navigation-off-canvas" id="page-top">

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
                    <div class="">
                        <!--Content-->
                        <div class="">
                            <header>
                                <h1 class="page-title"><?= get_lang("LISTING") ?></h1>
                            </header>
                            <figure class="filter clearfix">
                                <div class="buttons pull-left">
                                    <a href="<?=lang_site_url('Listing/Grid'); ?>" class="btn icon"><i class="fa fa-th"></i><?= get_lang("Grid") ?></a>
                                    <a href="<?=lang_site_url('Listing/List'); ?>" class="btn icon active"><i class="fa fa-th-list"></i><?= get_lang("List") ?></a>
                                </div>
                                <div class="pull-right">
                                    <aside class="sorting">
                                        <span><?= get_lang("Sorting") ?></span>
                                        <div class="form-group">
                                            <select class="framed" name="sort">
                                                <option value=""><?= get_lang("Date_Newest_First") ?></option>
                                                <option value="1"><?= get_lang("Date_Oldest_First") ?></option>
                                                <option value="2"><?= get_lang("Price_Highest_First") ?></option>
                                                <option value="3"><?= get_lang("Price_Lowest_First") ?></option>
                                            </select>
                                        </div>
                                        <!-- /.form-group -->
                                    </aside>
                                </div>
                            </figure>

                            <!--Listing Grid-->
                            <section class="block equal-height">
                                <div class="row div-properties-container">
                                <?php 
                                    $list = get_property_list(false, [3]);
                                ?>
                                <?php 
                                $count = 0;
                                $total_count = sizeof($list->data);
                                
                                foreach ($list->data as $item) { 
                                ?>
                                <?php
                                    $count++; 
                                    $gallery = array_value($item->gallery, 0, "assets/img/syr/no-image-house.png");
                                ?>
                                <div class="div-property-item div-property-item-<?=$count;?> redefine-visible" id="div-item-<?=$item->id; ?>" data-createdon="<?=$item->date_created; ?>" data-propid="<?=$item->id; ?>" data-price="<?=$item->price; ?>" data-typeid="<?=$item->TypeId; ?>">
                                    <div class="col-md-3 col-sm-4">
                                        <div class="item">
                                            <div class="image">
                                                <div class="quick-view" data-propid="<?=$item->id; ?>"  ><i class="fa fa-eye"></i><span><?= get_lang('Quick_View') ?></span></div>
                                                <a href="<?=lang_site_url('Property/Detail/'.$item->id.'/'); ?>">
                                                    <div class="overlay">
                                                        <div class="inner">
                                                            <div class="content">
                                                                <h4><?= get_lang('Description') ?></h4>
                                                                <p><?=substr($item->description, 0, 100).' ...'; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="item-specific">
                                                        <span title="<?= get_lang('Bedrooms') ?>"><img src="<?=site_url('assets/img/bedrooms.png'); ?>" alt=""><?=array_value($item->item_specific, "Bedrooms", 0); ?></span>
                                                        <span title="<?= get_lang('Bathrooms') ?>"><img src="<?=site_url('assets/img/bathrooms.png'); ?>" alt=""><?=array_value($item->item_specific, "Bathrooms", 0); ?></span>
                                                        <span title="<?= get_lang('Area') ?>"><img src="<?=site_url('assets/img/area.png'); ?>" alt=""><?=array_value($item->item_specific, "Area", 0); ?>m<sup>2</sup></span>
                                                        <span title="<?= get_lang('Garages') ?>"><img src="<?=site_url('assets/img/garages.png'); ?>" alt=""><?=array_value($item->item_specific, "Garages", 0); ?></span>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="fa fa-thumbs-up"></i>
                                                    </div>
                                                    <img src="<?=site_url($gallery); ?>" alt="">
                                                </a>
                                            </div>
                                            <div class="wrapper">
                                                <a href="<?=lang_site_url('Property/Detail/'.$item->id.'/'); ?>"><h3><?=$item->title; ?></h3></a>
                                                <figure><?=$item->location; ?></figure>
                                                <div class="info">
                                                    <div class="type">
                                                        <i><img src="<?=site_url($item->type_icon); ?>" alt=""></i>
                                                        <span><?= get_lang($item->type); ?></span>
                                                    </div>
                                                    <div class="price"><figure>$<?=$item->price; ?></figure></div>

                                                    <!-- <div class="rating" data-rating="4"></div> -->
                                                </div>
                                            </div>
                                            <div class="hdn-property-json" style="display:none;"><?=json_encode($item); ?></div>
                                        </div>
                                        <!-- /.item-->
                                    </div>
                                </div>
                                <?php } ?>
                                </div>
                                <!--/.row-->
                            </section>
                            <!--end Listing Grid-->
                            <!--Pagination-->
                            <nav style="text-align:center;">
                                <ul class="pagination"></ul>
                                <input type="hidden" value="1" id="hdn-list-page-number" />
                            </nav>
                            <!--end Pagination-->
                        </div>

                    </div>
                </section>
            </div>
            <!-- end Page Content-->
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