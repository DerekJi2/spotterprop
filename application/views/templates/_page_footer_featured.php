<?php

$this->load->helper("MY_data_helper");
$featured = get_property_featured(3);
?>

<div class="col-md-4 col-sm-4">
    <!--New Items-->
    <section>
        <h2><?= get_lang('FEATURED') ?></h2>
        <?php 
        $maxCount = 2;
        $count = 0;
        foreach($featured as $item) 
        { 
            $count++; 
            if ($count > $maxCount) 
            {
                break;
            } 

            $imgSrc = ($item->gallery != null && sizeof($item->gallery) > 0) ? site_url($item->gallery[0]) : "";
        ?>
        <a href="<?=lang_site_url('Property/Detail/'.$item->Id."/") ?>" class="item-horizontal small">
            <h3><?php echo $item->Address; ?></h3>
            <figure><?php echo $item->Location; ?></figure>
            <div class="wrapper">
                <div class="image"><img src="<?=$imgSrc ?>" alt=""></div>
                <div class="info">
                    <div class="type">
                        <i><img src="<?php echo site_url($item->type_icon) ?>" alt=""></i>
                        <span><?= get_lang($item->type) ?></span>
                    </div>
                    <!-- <div class="rating" data-rating="4"></div> -->
                </div>
            </div>
        </a>
        <?php } ?>
    </section>
    <!--end New Items-->
</div>