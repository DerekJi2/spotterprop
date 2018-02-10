<?php
$latestNumber = 5;
$this->load->helper("MY_data_helper");
$loginId = $this->users->current->id;
$groupId = get_group_id($loginId);
$loginId = ($groupId == 6) ? $loginId : 0;
$latest = get_property_latest($latestNumber, false, [1,2,3], $loginId);
?>

<div class="col-md-8 col-sm-12">    
    <!--Latest Items-->
    <section class="block listing div-properties-container">
    <h2><?= get_lang("Latest Properties") ?></h2>
        <?php 
            $list = get_json_array_by_result($latest); //get_property_list(false, [3]);
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
        <div class="div-property-item div-property-item-<?=$count;?> redefine-visible" id="div-item-<?=$item->id; ?>" data-createdon="<?=$item->date_created; ?>" data-propid="<?=$item->id; ?>" data-price="<?=$item->price; ?>">
            <div class="item list">
                <div class="image">
                    <div class="quick-view" data-propid="<?=$item->id; ?>"><i class="fa fa-eye"></i><span><?= get_lang('Quick_View') ?></span></div>
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
        </div>
        <?php } ?>
    </section>
    <!--end New Items-->
        </div>



<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css?v=1518189290" type="text/css">
<link rel="stylesheet" href="assets/css/bootstrap-select.min.css?v=1518189290" type="text/css">
<link rel="stylesheet" href="assets/css/owl.carousel.css?v=1518189290" type="text/css">
<link rel="stylesheet" href="assets/css/jquery.mCustomScrollbar.css?v=1518189290" type="text/css">
<link rel="stylesheet" href="assets/css/jquery.nouislider.min.css?v=1518189290" type="text/css">
<link rel="stylesheet" href="assets/css/colors/green.css?v=1518189290" type="text/css">
<link rel="stylesheet" href="assets/css/user.style.css?v=1518189290" type="text/css">
<link rel="stylesheet" href="assets/css/user.spotter.css?v=1518189290" type="text/css">

<style>

</style>