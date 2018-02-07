<?php
    $this->load->helper("MY_AboutUs_helper");
    $this->load->helper("MY_Data_helper");
    $aboutus = get_aboutus("en");
?>

<div class="div-tab div-tab-1">
    <h3><?= get_lang("About Us") ?></h3>
    <div class="container-fluid" id="form-about-us">
        <input type="hidden" name="lang" value="en">
        <div class="row form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" name="title" id="title" value="<?= $aboutus->Title ?>" />
        </div>
        <div class="row form-group">
            <label for="descriptions">Descriptions:</label>
            <textarea class="form-control" name="descriptions" id="descriptions" ><?= $aboutus->Descriptions ?></textarea>
        </div>
        <div class="row form-group">
            <button type="button" class="btn btn-primary pull-right" onclick="javascript:saveAboutUs();">Save</button>
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
            desc: $("#form-about-us").find(`textarea[name=descriptions]`).val()
        }
    });

    promise.done((response) => {
        alert('<?= get_lang("saved successfully") ?>');
    });
}
</script>