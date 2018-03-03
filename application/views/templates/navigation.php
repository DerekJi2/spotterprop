<link rel="stylesheet" href="<?=site_url('assets/css/languages.min.css') ?>" type="text/css">
<style>
.navigation-langs {
    font-size:12px;
    display:inline-block;
    position:relative;
    top:15px;
    float:right;
}

.navigation-items {
    float:right;
}

.toggle-navigation {
    float:right;
}

@media screen and (max-width:530px) {
    .brand { text-align: center; width:100%; }
    .navigation-langs { display:block; text-align:center; width:100%;}
}
</style>

<!-- Navigation-->
<div class="header">
    <div class="wrapper">
      <div class="title-box col-xl-10 col-lg-10 col-md-9 col-sm-9">
        <div class="brand">
            <a href="<?= lang_site_url('') ?>">
                <img src="<?= site_url('assets/img/syr/logo.png') ?>" alt="logo" style="margin:5px; height:25px;">
                <span style="font-size:24px;">Syrian Properties</span>
            </a>            
        </div>
        <div class="navigation-langs">
            <!-- <ul class="main-navigation navigation-top-header " role="menu">
                <li><a href="<?= site_url('en') ?>"><span class="lang-sm lang-lbl" lang="en"></a></li>
                <li><a href="<?= site_url('ar') ?>"><span class="lang-sm lang-lbl" lang="ar"></a></li>
            </ul> -->
            <a href="<?= site_url('en') ?>"><span class="lang-sm lang-lbl" lang="en"></a>
            <span> | </span>
            <a href="<?= site_url('ar') ?>"><img src="<?= site_url('assets/img/syria-flag.png') ?>" width="24"/><span style="font-size:18px;">عربى</span></a>
            <span> | </span>
            <a href="<?= site_url('cn') ?>"><span class="lang-sm lang-lbl" lang="zh"></a>
        </div>
      </div> 
        <nav class="navigation-items">
            <div class="wrapper">
                <ul class="user-area">
                    <li><a href="#" class="btn-admin-signin"><?= get_lang('SignIn') ?></a></li>
                    <li><a href="#" class="btn-admin-register"><strong><?= get_lang('Register') ?></strong></a></li>
                </ul>
                <div class="toggle-navigation">
                    <div class="icon">
                        <div class="line"></div>
                        <div class="line"></div>
                        <div class="line"></div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- end Navigation-->