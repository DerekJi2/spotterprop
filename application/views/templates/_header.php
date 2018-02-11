
<link rel="icon" href="<?= site_url('assets/img/syr/icon.ico') ?>" type="image/ico">

<?php
$this->load->helper('MY_data_helper');
$this->load->helper('MY_AboutUs_helper');
$lang = get_lang_from_url();
$aboutUs = get_aboutus($lang);
?>

<meta name="keywords" content="<?= $aboutUs->Keywords ?>" />
<meta name="description" content="<?= $aboutUs->Descriptions ?>" />