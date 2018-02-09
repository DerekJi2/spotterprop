<?php
    $lang = get_lang_from_url();

    $this->load->helper("MY_Contact_helper");
    $contact = get_contact($lang);
    $this->load->helper("MY_AboutUs_helper");
    $aboutus = get_aboutus($lang);
?>

<div class="col-md-4 col-sm-4">
    <section>
        <h2><?=get_lang('ABOUT_US') ?></h2>
        <address>
            <div><?= $contact->CompanyName ?></div>
            <div><?= $contact->Address1 ?></div>
            <div><?= $contact->Address2 ?></div>
            <figure>
                <div class="info">
                    <i class="fa fa-mobile"></i>
                    <span><?= $contact->Mobile ?></span>
                </div>
                <div class="info">
                    <i class="fa fa-phone"></i>
                    <span><?= $contact->Phone ?></span>
                </div>
                <div class="info">
                    <i class="fa fa-globe"></i>
                    <a href="<?= $contact->Website ?>" target="_blank"><?= $contact->Website ?></a>
                </div>
            </figure>
        </address>
        <div class="social">
            <?php if ($contact->Twitter != null && $contact->Twitter != "") {?>
            <a href="<?= $contact->Twitter ?>" class="social-button"><i class="fa fa-twitter"></i></a>
            <?php } ?>
            
            <?php if ($contact->Facebook != null && $contact->Facebook != "") {?>
            <a href="<?= $contact->Facebook ?>" class="social-button"><i class="fa fa-facebook"></i></a>
            <?php } ?>
            
            <?php if ($contact->Pinterest != null && $contact->Pinterest != "") {?>
            <a href="<?= $contact->Pinterest ?>" class="social-button"><i class="fa fa-pinterest"></i></a>
            <?php } ?>
        </div>

        <a href="<?php echo lang_site_url('Home/Contact') ?>" class="btn framed icon"><?=get_lang('Contact_Us') ?><i class="fa fa-angle-right"></i></a>
    </section>
</div>