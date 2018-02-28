
<link rel="icon" href="<?= site_url('assets/img/syr/icon.ico') ?>" type="image/ico">

<?php
$uri = $_SERVER['REQUEST_URI'];
$isDoSetup = strpos(strtolower($uri), 'do-setup');

if (!$isDoSetup)
{
    $this->load->helper('MY_data_helper');
    $this->load->helper('MY_AboutUs_helper');
    $lang = get_lang_from_url();
    $aboutUs = get_aboutus($lang);
}


?>

<meta name="keywords" content="<?= $isDoSetup ? "" : $aboutUs->Keywords ?>" />
<meta name="description" content="<?= $isDoSetup ? "" : $aboutUs->Descriptions ?>" />

<?php

if (!$isDoSetup)
{
    $this->load->model("Options");
    $options = new Options();
    $npp_listing = $options->get("number-per-page-listing");
    $npp_admin = $options->get("number-per-page-admin");
}
?>
<input type="hidden" id="header_npp_listing" value="<?= $isDoSetup ? 0 : $npp_listing ?>" />
<input type="hidden" id="header_npp_admin" value="<?= $isDoSetup ? 0 : $npp_admin ?>" />