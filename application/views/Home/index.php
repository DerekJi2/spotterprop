<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$this->load->helper('MY_data_helper');

$_DEBUG_ = true;
$_Timestamp = "?v=";
$_Timestamp .= $_DEBUG_ ? time() : date("Y.m.d");

?>
<!DOCTYPE html>

<script type="text/javascript" src="assets/js/local.i18.js<?=$_Timestamp?>"></script>
<script type="text/javascript">
var BASEURL = "<?=site_url() ?>";
var LANGSITEURL = "<?= lang_site_url();?>";
</script>
<html lang="en-US">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="<?= site_url() ?>" />
    <?php 
    $hrefs = array(
        "assets/bootstrap/css/bootstrap.css" ,
        "assets/css/bootstrap-select.min.css" ,
        "assets/css/owl.carousel.css" ,
        "assets/css/jquery.mCustomScrollbar.css" ,
        "assets/css/jquery.nouislider.min.css" ,
        "assets/css/colors/green.css" ,
        "assets/css/user.style.css" ,
        "assets/css/user.spotter.css" ,
    );

    
    ?>

    <link rel="icon" href="assets/img/syr/icon.ico" type="image/ico">
    <link href="assets/fonts/font-awesome.css<?=".$_Timestamp" ?>" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    <?php foreach($hrefs as $href) { ?>
        <link rel="stylesheet" href="<?=$href.$_Timestamp?>" type="text/css">
    <?php } ?>

    <title>Syrian Properties</title>

</head>
<?php /* $this->load->view('templates/_header'); */ ?>

<body onunload="" class="map-fullscreen page-homepage navigation-off-canvas" id="page-top">

<?php $this->view("templates/_lang_i18"); ?>

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
            <!--Page Content-->
            <div id="page-content">
                <!-- Map Canvas-->
                <div class="map-canvas list-solid">
                    <?php 
                        $this->view("Home/_map"); 
                    ?>

                    <!--Items List-->
                    <div class="items-list">
                        <div class="inner">
                            <?php 
                                $this->view("Home/_search_filter"); 
                            ?>
                            
                            <header class="clearfix">
                                <h3 class="pull-left"><?= get_lang('RESULTS') ?></h3><span>&nbsp;</span><span>(<span id="span-search-results-count"></span>)</span>
                                <div class="buttons pull-right">
                                    <span><?= get_lang('Display') ?>:</span>
                                    <span class="icon active" id="display-grid"><i class="fa fa-th"></i></span>
                                    <span class="icon" id="display-list"><i class="fa fa-th-list"></i></span>
                                </div>
                            </header>
                            <ul class="results grid">

                            </ul>
                        </div>
                        <!--results-->
                    </div>
                    <!--end Items List-->
                </div>
                <!-- end Map Canvas-->

                <?php // Partial Views: Why us | Featured | Recent | Promotion | Our Team | Partners 
                    // Why Us
                    // $this->view("Home/_whyus");

                    // Featured
                    // $this->view("Home/_featured");

                    // Recent
                    // $this->view("Home/_recent");

                    // Promotion: "submit your property today"
                    // $this->view("Home/_promotion");

                    // Our Team
                    // $this->view("Home/_ourteam");

                    // Partners
                    // $this->view("Home/_partners");
                ?>
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

<div id="hdn-div-properties-div" style="display:none;"></div>

<section class="page-scripts">
    <script type="text/javascript" src="assets/js/jquery-2.1.0.min.js<?=$_Timestamp ?>"></script>
    <script type="text/javascript" src="assets/js/before.load.js<?=$_Timestamp ?>"></script>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;libraries=places&key=AIzaSyCVbV919dtZDR5eKhk1LuRpuS26tdeyHBc"></script>

    <?php $scripts = array(
        "assets/js/local.i18.js", 
        "assets/js/jquery-migrate-1.2.1.min.js", 
        "assets/js/markerclusterer.js", 
        "assets/bootstrap/js/bootstrap.min.js", 
        "assets/js/richmarker-compiled.js", 
        "assets/js/smoothscroll.js", 
        "assets/js/infobox.js", 
        "assets/js/bootstrap-select.min.js", 
        "assets/js/icheck.min.js", 
        "assets/js/jquery.hotkeys.js", 
        "assets/js/jquery.mCustomScrollbar.concat.min.js", 
        "assets/js/jquery.nouislider.all.min.js", 
        "assets/js/custom.js", 
        "assets/js/maps.js", 
        "assets/js/local.common.js", 
        "assets/js/local.searchengine.js", 
        "assets/js/local.searchpanel.js", 
        "assets/js/local.property.js", 
        "assets/js/local.redirect.js", 
    );?>

    <?php foreach($scripts as $script) { ?>
        <script type="text/javascript" src="<?=$script.$_Timestamp?>"></script>
    <?php } ?>
</section>


<?php //$this->view("templates/google_translate"); ?>

<script>
    var LANG = get_lang_from_url();
    var _latitude = 51.541216;
    var _longitude = -0.095678;
    // var jsonPath = '<?=site_url('assets/json/real-estate.json.txt')?>';
    var jsonPath = "<?= lang_site_url() ?>" + "Property/JsonList";
    
    // Load JSON data and create Google Maps

    $.getJSON(jsonPath)
            .done(function(json) {
                $('#hdn-div-properties-div').text(JSON.stringify(json));
                createHomepageGoogleMap(_latitude,_longitude,json);
            })
            .fail(function( jqxhr, textStatus, error ) {
                console.log(error);
            })
    ;

    // Set if language is RTL and load Owl Carousel

    $(window).load(function(){
        nsSearchPanel.OnLoad();
        nsRedirect.OnLoad();

        var rtl = false; // Use RTL
        initializeOwl(rtl);
    });

    autoComplete();

    
    console.log("lang = " + LANG);
</script>

<!--[if lte IE 9]>
<script type="text/javascript" src="assets/js/ie-scripts.js"></script>
<![endif]-->
</body>
</html>
