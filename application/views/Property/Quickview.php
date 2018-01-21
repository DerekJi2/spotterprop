<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$this->load->helper('MY_data_helper');
$this->lang->load('home', 'english');
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>

<div class="modal-window fade_in">
    <div class="modal-wrapper"><h2><?php echo $vw->title; ?></h2>
        <figure><?php echo $vw->location; ?></figure>
        <!-- <div class="rating" data-rating="4"></div> -->
        <div class="modal-body">
            <div class="gallery">
                <div class="image">
                    <div class="price">$<?php echo number_format($vw->price); ?></div>
                    <div class="type"><i><img src="<?php echo site_url($vw->type_icon); ?>" alt=""></i><span><?= get_lang($vw->type) ?></span></div>
                    <div class="owl-carousel gallery">
                        <?php 
                        foreach ($vw->gallery as $image_src)
                        {
                            $image_path = site_url($image_src);
                            echo "<img src=\"".$image_path."\">";
                        }
                        ?>
                    </div>
                </div>
                <div class="features"><h3><?= get_lang('Features') ?></h3>
                    <ul class="bullets">
                        <?php 
                            foreach ($vw->features as $feature)
                            {
                                $featureName = get_lang($feature);
                                echo "<li>".$featureName."</li>";
                            }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="modal-content">
                <section><h3><?= get_lang('Description') ?></h3>
                    <p>
                        <?php echo $vw->description; ?>
                    </p>
                </section>
                <section><h3><?= get_lang('Overview') ?></h3>
                    <dl>
                        <?php
                            $propSpecs = $vw->item_specific;
                            foreach ($specs as $spec)
                            {
                                if ($spec->IsDeleted == 0)
                                {
                                    $spec_name = $spec->Name;
                                    $spec_count = array_key_exists($spec_name, $propSpecs) ? $propSpecs[$spec_name] : 0;
                                    if ($spec_count > 0)
                                    {
                                        $specName = get_lang(''.$spec_name);
                                        echo "<dt>".$specName."</dt>";
                                        echo "<dd>".$spec_count."</dd>";
                                    }
                                }
                            }
                        ?>
                    </dl>
                </section>
                <!-- REMOVED
                <section><h3>Last Review</h3>
                    <div class="rating" data-rating="5"></div>
                    <p>Curabitur odio nibh, luctus non pulvinar a, ultricies ac diam. Donec neque massa, viverra interdum eros ut, imperdiet</p>
                </section> 
                -->
                <a href="<?= lang_site_url('Property/Detail/'.$vw->id.'/'); ?>" class="btn btn-default btn-large"><?= get_lang('Show_Detail') ?></a></div>
        </div>
        <div class="modal-close"><img src="<?php echo site_url('assets/img/close.png'); ?>"></div>
    </div>
    <div class="modal-background fade_in"></div>
</div>

<script>
    // Render Owl carousel gallery

    var _rtl = false;
    drawOwlCarousel(_rtl);

    // Render Rating stars

    rating('.modal-window');

    // Remove modal element form DOM

    $('.modal-window .modal-background, .modal-close').live('click',  function(e){
        $('.modal-window').addClass('fade_out');
        setTimeout(function() {
            $('.modal-window').remove();
        }, 300);
    });
</script>

<!--[if lte IE 9]>
<script type="text/javascript" src="assets/js/ie-scripts.js"></script>
<![endif]-->
</body>
</html>