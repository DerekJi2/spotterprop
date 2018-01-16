<!--Contact-->
<section>
    <header><h3><?= get_lang('Contact Agent') ?></h3></header>
    <figure>
        <a href="<?php echo site_url('#') ?>" class="person">
            <div class="image">
                <img src="<?php echo site_url($agent->Photo) ?>" alt="">
            </div>
            <div class="wrapper">
                <h5><?php echo $agent->Name; ?></h5>
            </div>
        </a>
    </figure>
    <address>
        <figure>
            <div class="info">
                <i class="fa fa-mobile"></i>
                <span><?php echo $agent->Mobile; ?></span>
            </div>

            <?php if ($agent->Mobile != $agent->Phone) { ?>
            <div class="info">
                <i class="fa fa-phone"></i>
                <span><?php echo $agent->Phone; ?></span>
            </div>
            <?php } ?>

            <div class="info">
                <i class="fa fa-envelope-o"></i>
                <span style="font-size:12px;"><a href="mailto: <?php echo $agent->Email; ?>" target="_blank"><?php echo $agent->Email; ?></a></span>
            </div>

            <div class="info">
                <i class="fa fa-globe"></i>
                <span style="font-size:12px;"><a href="#" onclick='window.open("<?php echo $agent->Website; ?>")' target="_blank"><?php echo $agent->Website; ?></a></span>
            </div>
        </figure>
    </address>
</section>
<!--end Contact-->