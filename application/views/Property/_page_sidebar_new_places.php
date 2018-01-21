<section>
    <header><h2><?=get_lang('New Places') ?></h2></header>
    <?php
    $this->load->helper("MY_data_helper");
    $this->load->helper("MY_model_helper");
    $latest = get_property_latest(3);

    foreach($latest as $property)
    {
        $gallery = array_value($property->gallery, 0, "assets/img/syr/no-image-house.png");
    ?>
        <a href="<?= lang_site_url('Property/Detail/'.$property->Id.'/') ?>" class="item-horizontal small">
        <h3><?php echo $property->Address; ?></h3>
        <figure><?php echo $property->Location; ?></figure>
        <div class="wrapper">
            <div class="image"><img src="<?=site_url($gallery) ?>" alt=""></div>
            <div class="info">
                <div class="type">
                    <i><img src="<?=site_url($property->type_icon) ?>" alt=""></i>
                    <span><?=get_lang($property->type) ?></span>
                </div>
                <!-- <div class="rating" data-rating="3"></div> -->
            </div>
        </div>
    </a>
    <?php
    }
    ?>
</section>