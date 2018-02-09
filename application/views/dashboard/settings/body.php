<?php
    $this->load->view("dashboard/properties/_framework_header");
?>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


	<section class="content-header">
        <h1>
            <?= get_lang("Settings") ?> <small></small>
        </h1>
    </section> <!-- section .content-header -->
    
    <div class="content">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="javascript:void(0);" onclick="javascript:clickTab(this);" data-id="1"><?= get_lang("About Us") ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="javascript:void(0);" onclick="javascript:clickTab(this);" data-id="2"><?= get_lang("Contact") ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="javascript:void(0);" onclick="javascript:clickTab(this);" data-id="3"><?= get_lang("Page Setting") ?></a>
            </li>
        </ul>
        <?php $this->load->view("dashboard/settings/aboutus"); ?>
        <?php $this->load->view("dashboard/settings/contact"); ?>
        <?php $this->load->view("dashboard/settings/pages"); ?>
    </div> <!-- div .content -->

<?php
    $this->load->view("dashboard/properties/_framework_end");
?>

<script>
function clickTab(obj)
{
    var id = $(obj).data("id");

    $(".nav-link").removeClass("active");
    $(obj).addClass("active");

    
    $(".div-tab").hide();
    $(".div-tab-" + id).show();

}
</script>