<!--Contact-->
<section>
    <header><h3><?= get_lang('Contact Agent') ?></h3></header>
    <?php
        $agent_photo = ($agent == null || $agent->Photo == null || $agent->Photo == "") ? "assets/img/syr/no-image-user.png" : $agent->Photo;
        $agent_name = ($agent == null || $agent->name == null || $agent->name == "") ? "<i style=\"color:grey;\">(unknown)</i>" : $agent->name;
        $agent_phone = ($agent == null || $agent->Phone == null || $agent->Phone == "") ? "" : $agent->Phone;
        $agent_email = ($agent == null || $agent->email == null || $agent->email == "") ? "" : $agent->email;
        $agent_mobile = ($agent == null || $agent->Mobile == null || $agent->Mobile == "") ? "" : $agent->Mobile;
        $agent_website = ($agent == null || $agent->Website == null || $agent->Website == "") ? "" : $agent->Website;
    ?>
    <figure>
        <a href="<?php echo site_url('#') ?>" class="person">
            <div class="image">
                <img src="<?php echo site_url($agent_photo) ?>" alt="">
            </div>
            <div class="wrapper">
                <h5><?= $agent_name; ?></h5>
            </div>
        </a>
    </figure>
    <address>
        <?php if ($agent != null) { ?>
        <figure>
            <div class="info">
                <i class="fa fa-mobile icon-mobile"></i>
                <span><?php echo $agent_mobile; ?></span>
            </div>

            <?php if ($agent_mobile != $agent_phone) { ?>
            <div class="info">
                <i class="fa fa-phone"></i>
                <span><?php echo $agent_phone; ?></span>
            </div>
            <?php } ?>

            <div class="info">
                <i class="fa fa-envelope-o"></i>
                <span style="font-size:12px;"><a href="mailto: <?php echo $agent_email; ?>" target="_blank"><?php echo $agent_email; ?></a></span>
            </div>

            <div class="info">
                <i class="fa fa-globe"></i>
                <span style="font-size:12px;"><a href="#" onclick='window.open("<?php echo $agent_website; ?>")' target="_blank"><?php echo $agent_website; ?></a></span>
            </div>
        </figure>
        <?php } ?>
    </address>
</section>
<!--end Contact-->