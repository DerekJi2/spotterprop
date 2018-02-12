<?php
    $this->load->view("dashboard/properties/_framework_header");

    $this->load->helper("MY_LangConfig_helper");

    $lang = get_lang_from_url();

    $langfile = get_lang_file($lang);
    $langConfigs = load_langs_by_lang($lang);
?>

<style>
.lang-form, .lang-button { margin:12px; }

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
        ?>
        <div class="row form-group lang-button">
            <div class="col col-sm-4 col-md-4 col-lg-4">
                <input type="hidden" name="lang" id="lang" value="<?= get_lang_from_url() ?>" />
            </div>
            <div class="col col-sm-4 col-md-4 col-lg-4">
            </div>
            <div class="col col-sm-4 col-md-4 col-lg-4">
                <button type="button" class="btn btn-primary" onclick="save()"><?= get_lang("Save") ?></button>
            </div>
        </div>
        <?php
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
    configs = [];
    $(".lang-item").each(function(idx){
        var key = $(this).find("input.txt-lang-key").val();
        var value = $(this).find("input.txt-lang-value").val();
        var config = new LangConfig(key, value);
        configs.push(config);

    });

    var saveUrl = BASEURL + "settings/save_langs";
    var promise = $.ajax({
        type: 'POST',
        url: saveUrl, 
        data: { 
            lang: $("#lang").val(),
            configs: JSON.stringify(configs)
        }
    });
    
    promise.done((response) => {
        console.log(response);
        alert('<?= get_lang("saved successfully") ?>');
    });
}

function LangConfig(key, val)
{
    this.key = key;
    this.val = val;
}

function remove(obj)
{
    $(obj).parent().parent().remove();
}
</script>