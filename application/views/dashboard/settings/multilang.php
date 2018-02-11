<?php
    $this->load->view("dashboard/properties/_framework_header");

    $this->load->helper("MY_LangConfig_helper");

    $langfile = get_lang_file("ar");
    $langConfigs = load_langs_by_lang("ar");
?>

<style>
.lang-form { margin:12px; }

</style>

	<section class="content-header">
        <h1>
            <?= get_lang("Multilingual Support") ?> <small></small>
        </h1>
    </section> <!-- section .content-header -->
    
    <div class="content lang-form">

        <?php 
        if ($langConfigs != null && sizeof($langConfigs) > 0)
        {
            foreach ($langConfigs as $key => $value)
            {
        ?>
            <div class="row form-group lang-item">
                <div class="col col-sm-4 col-md-4 col-lg-4">
                    <input type="text" class="form-control txt-lang-key" name="" value="<?= $key ?>" />
                </div>
                <div class="col col-sm-4 col-md-4 col-lg-4">
                    <input type="text" class="form-control txt-lang-value" name="" value="<?= $value ?>" />
                </div>
                <div class="col col-sm-4 col-md-4 col-lg-4">
                    <a href="javascript:void(0);" onclick="remove(this)">Remove</a>
                    <span> | </span>
                    <a href="javascript:void(0);" onclick="edit()">Edit</a>
                </div>
            </div>
                
        <?php
            } 
        }
        ?>
    </div> <!-- div .content -->

<?php
    $this->load->view("dashboard/properties/_framework_end");
?>

<script>

function save()
{
    $(".lang-item").each(function(idx){

    });
}

function remove(obj)
{
    $(obj).parent().parent().remove();
}
</script>