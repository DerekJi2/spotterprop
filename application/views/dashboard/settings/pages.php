<?php
    $this->load->model("Options");
    $model = new Options();
    $npp_listing = $model->get("number-per-page-listing");
    $npp_admin = $model->get("number-per-page-admin");
?>

<div class="div-tab div-tab-3" style="display:none;">
    <h3><?= get_lang("Page Setting") ?></h3>
    <div class="container-fluid" id="form-page-setting">
        <div class="row form-group">
            <label for="npp_listing"><?= get_lang("The Number of Properties per Page (Listing)") ?>:</label>
            <input type="number" class="form-control" name="npp_listing" id="npp_listing" value="<?= $npp_listing ?>" min="1" max="100"/>
        </div>
        <div class="row form-group">
            <label for="npp_admin"><?= get_lang("The Number of Properties per Page (Admin)") ?>:</label>
            <input type="number" class="form-control" name="npp_admin" id="npp_admin" value="<?= $npp_admin ?>" min="1" max="100"/>
        </div>
        <div class="row form-group">
            <button type="button" class="btn btn-primary pull-right" onclick="javascript:savePageSetting();"><?= get_lang("Save") ?></button>
        </div>
    </div>
</div>
<style>
#form-page-setting input.form-control { width:80px; }
</style>


<script type="text/javascript">
function savePageSetting()
{
    var URL = BASEURL + "settings/save_pagesetting";

    var promise = $.ajax({
        type: 'POST',
        url: URL,
        data: {
            npp_listing : $("#form-page-setting").find(`input[name=npp_listing]`).val(),
            npp_admin : $("#form-page-setting").find(`input[name=npp_admin]`).val()
        }
    });

    promise.done((response) => {
        console.log(response);
        alert('<?= get_lang("saved successfully") ?>');
    });
}
</script>