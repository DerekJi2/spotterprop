<?php
    $this->load->helper("MY_AboutUs_helper");
    $this->load->helper("MY_Data_helper");
    $lang = get_lang_from_url();
    $aboutus = get_aboutus($lang);
?>

<div class="div-tab div-tab-1">
    <h3><?= get_lang("About Us") ?></h3>
    <div class="container-fluid" id="form-about-us">
        <input type="hidden" name="lang" value="<?= $lang ?>">
        <div class="row form-group">
            <label for="title"><?= get_lang("Title") ?>:</label>
            <input type="text" class="form-control" name="title" id="title" value="<?= $aboutus->Title ?>" />
        </div>
        <div class="row form-group">
            <label for="descriptions"><?= get_lang("Descriptions") ?>:</label>
            <textarea class="form-control" name="descriptions" id="descriptions" ><?= $aboutus->Descriptions ?></textarea>
        </div>
        <div class="row form-group">
            <label for="keywords">SEO <?= get_lang("Keywords") ?>:</label>
            <textarea class="form-control" name="keywords" id="keywords" ><?= $aboutus->Keywords ?></textarea>
        </div>
        <div class="row form-group">
            <button type="button" class="btn btn-primary pull-right" onclick="javascript:saveAboutUs();"><?= get_lang("Save") ?></button>
        </div>
    </div>
</div>

<script type="text/javascript">
function saveAboutUs()
{
    var URL = BASEURL + "settings/save_aboutus";

    var promise = $.ajax({
        type: 'POST',
        url: URL,
        data: {
            lang: $("#form-about-us").find(`input[name=lang]`).val(),
            title: $("#form-about-us").find(`input[name=title]`).val(),
            desc: $("#form-about-us").find(`textarea[name=descriptions]`).val(),
            keywords: $("#form-about-us").find(`textarea[name=keywords]`).val()
        }
    });

    promise.done((response) => {
        alert('<?= get_lang("saved successfully") ?>');
    });
}
</script>