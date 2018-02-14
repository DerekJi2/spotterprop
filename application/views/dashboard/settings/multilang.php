<?php
    $this->load->view("dashboard/properties/_framework_header");

    $this->load->helper("MY_LangConfig_helper");

    $langConfigs = load_all_langs();
?>

<style>
.lang-form, .lang-button { margin:12px; }
.row-lang-item { margin: 10px; padding:10px 15px; }
.row-even { background:#f3f3ff; }
.row-odd { background:#e6f7f0; }
.row-newly-added { background:#4CAF50; color: white; }
.alert-warning { background: #fff3cd !important; color: black !important;}
</style>

	<section class="content-header">
        <h1>
            <?= get_lang("Multilingual Support") ?> <small></small>
        </h1>
    </section> <!-- section .content-header -->
    
    <div class="content lang-form">
        <div class="alert alert-warning col-sm-8 col-md-8 col-lg-8" role="alert" style="display:none;"></div>

        <?php 
        if ($langConfigs != null && sizeof($langConfigs) > 0)
        {
        ?>
        <div class="row form-group lang-button">
            <div class="col col-sm-4 col-md-4 col-lg-4">
                <input type="hidden" name="lang" id="lang" value="<?= get_lang_from_url() ?>" />
            </div>
            <div class="col col-sm-2 col-md-2 col-lg-2">
            </div>
            <div class="col col-sm-2 col-md-2 col-lg-2" style="text-align:right;">
                <button type="button" class="btn btn-primary" onclick="add()"><?= get_lang("Add") ?></button>
                <button type="button" class="btn btn-danger" onclick="save()"><?= get_lang("Save") ?></button>
            </div>
        </div>
        <?php
            $index = 0;
            foreach ($langConfigs as $item)
            {
                $index++;
                $row_even = ($index % 2 == 0) ? "row-even" : "row-odd";
        ?>
            <div class="row lang-item col-sm-8 col-md-8 col-lg-8 row-lang-item <?= $row_even ?>">
                <div class="form-group">
                    <label><?= get_lang("Keyword") ?>:</label>
                    <input type="text" class="form-control txt-lang-key" name="" value="<?= $item->keyword ?>" />
                </div>
                <div class="form-group">
                    <label><?= get_lang("English") ?>:</label>
                    <input type="text" class="form-control txt-lang-value-en" name="" value="<?= $item->en ?>" />
                </div>
                <div class="form-group">
                    <label><?= get_lang("Arabic") ?>:</label>
                    <input type="text" class="form-control txt-lang-value-ar" name="" value="<?= $item->ar ?>" />
                </div>
                <div class="form-group">
                    <label><?= get_lang("Chinese") ?>:</label>
                    <input type="text" class="form-control txt-lang-value-cn" name="" value="<?= $item->cn ?>" />
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

<div class="dv-new-row-template" style="display:none;">
    <div class="row lang-item col-sm-8 col-md-8 col-lg-8 row-lang-item row-newly-added">
        <div class="form-group">
            <label><?= get_lang("Keyword") ?>:</label>
            <input type="text" class="form-control txt-lang-key" name="" value="" />
        </div>
        <div class="form-group">
            <label><?= get_lang("English") ?>:</label>
            <input type="text" class="form-control txt-lang-value-en" name="" value="" />
        </div>
        <div class="form-group">
            <label><?= get_lang("Arabic") ?>:</label>
            <input type="text" class="form-control txt-lang-value-ar" name="" value="" />
        </div>
        <div class="form-group">
            <label><?= get_lang("Chinese") ?>:</label>
            <input type="text" class="form-control txt-lang-value-cn" name="" value="" />
        </div>
        <div class="col col-sm-4 col-md-4 col-lg-4">
            <a href="javascript:void(0);" onclick="remove(this)">Remove</a>
        </div>
    </div>
</div>

<?php
    $this->load->view("dashboard/properties/_framework_end");
?>

<script>

function add()
{
    var html = $(".dv-new-row-template").html();
    $(html).insertAfter($(".lang-button"));
}

function save()
{
    configs_en = [];
    configs_ar = [];
    configs_cn = [];
    $(".lang-item").each(function(idx){
        var key = $(this).find("input.txt-lang-key").val();
        
        var value_en = $(this).find("input.txt-lang-value-en").val();
        var config_en = new LangConfig(key, value_en);
        configs_en.push(config_en);

        var value_ar = $(this).find("input.txt-lang-value-ar").val();
        var config_ar = new LangConfig(key, value_ar);
        configs_ar.push(config_ar);

        var value_cn = $(this).find("input.txt-lang-value-cn").val();
        var config_cn = new LangConfig(key, value_cn);
        configs_cn.push(config_cn);

    });

    $(".alert").html('');
    ajaxSaveRequest("en", configs_en);
    ajaxSaveRequest("ar", configs_ar);
    ajaxSaveRequest("cn", configs_cn);
}

function ajaxSaveRequest(lang, configs)
{
    var saveUrl = BASEURL + "settings/save_langs";
    var promise = $.ajax({
        type: 'POST',
        url: saveUrl, 
        data: { 
            lang: lang,
            configs: JSON.stringify(configs)
        }
    });
    
    promise.done((response) => {
        console.log(response);
        alert_html = $(".alert").html();
        alert_html += '<p>' + 'Language of "' + lang + '" <?= get_lang("saved successfully!") ?>' + '</p>';

        $(".alert").html(alert_html);
        $(".alert").show();

        var ms = 750;
        if ($('.alert').find("p").length >= 3)
        {
            // setTimeout(function(){
            //     alert("All saved successfully!");
            //     location.href = location.href;
            // }, ms);
            $('.alert').append($('<button onclick="javascript:location.reload();" type="button" class="btn btn-info pull-right">OK</button>'))
        }
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