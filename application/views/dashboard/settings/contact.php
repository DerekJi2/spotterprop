<?php
    $this->load->helper("MY_Contact_helper");
    $this->load->helper("MY_Data_helper");
    $lang = get_lang_from_url();
    $contact = get_contact($lang);
?>

<div class="div-tab div-tab-2" style="display:none;">
<h3><?= get_lang("Contact") ?></h3>
    <div class="container-fluid" id="form-contact">
        <input type="hidden" name="lang" value="<?= $lang ?>">
        <div class="row form-group">
            <label for="title"><?= get_lang("Company Name") ?>:</label>
            <input type="text" class="form-control" name="CompanyName" id="CompanyName" value="<?= $contact->CompanyName ?>" />
        </div>
        <div class="row form-group">
            <label for="title"><?= get_lang("Address") ?> 1:</label>
            <input type="text" class="form-control" name="Address1" id="Address1" value="<?= $contact->Address1 ?>" />
        </div>
        <div class="row form-group">
            <label for="title"><?= get_lang("Address") ?> 2:</label>
            <input type="text" class="form-control" name="Address2" id="Address2" value="<?= $contact->Address2 ?>" />
        </div>
        <div class="row form-group">
            <label for="title"><?= get_lang("Phone") ?>:</label>
            <input type="text" class="form-control" name="Phone" id="Phone" value="<?= $contact->Phone ?>" />
        </div>
        <div class="row form-group">
            <label for="title"><?= get_lang("Mobile") ?>:</label>
            <input type="text" class="form-control" name="Mobile" id="Mobile" value="<?= $contact->Mobile ?>" />
        </div>
        <div class="row form-group">
            <label for="title"><?= get_lang("Email") ?>:</label>
            <input type="text" class="form-control" name="Email" id="Email" value="<?= $contact->Email ?>" />
        </div>
        <div class="row form-group">
            <label for="title"><?= get_lang("Website") ?>:</label>
            <input type="text" class="form-control" name="Website" id="Website" value="<?= $contact->Website ?>" />
        </div>
        <div class="row form-group">
            <label for="title"><?= get_lang("Twitter") ?>:</label>
            <input type="text" class="form-control" name="Twitter" id="Twitter" value="<?= $contact->Twitter ?>" />
        </div>
        <div class="row form-group">
            <label for="title"><?= get_lang("Facebook") ?>:</label>
            <input type="text" class="form-control" name="Facebook" id="Facebook" value="<?= $contact->Facebook ?>" />
        </div>
        <div class="row form-group">
            <label for="title"><?= get_lang("Pinterest") ?>:</label>
            <input type="text" class="form-control" name="Pinterest" id="Pinterest" value="<?= $contact->Pinterest ?>" />
        </div>
        
        <div class="row form-group">
            <button type="button" class="btn btn-primary pull-right" onclick="javascript:saveContact();"><?= get_lang("Save") ?></button>
        </div>
    </div>
</div>

<script type="text/javascript">
function saveContact()
{
    var URL = BASEURL + "settings/save_contact";

    var promise = $.ajax({
        type: 'POST',
        url: URL,
        data: {
            Lang: $("#form-contact").find(`input[name=lang]`).val(),
            CompanyName: $("#form-contact").find(`input[name=CompanyName]`).val(),
            Address1: $("#form-contact").find(`input[name=Address1]`).val(),
            Address2: $("#form-contact").find(`input[name=Address2]`).val(),
            Phone: $("#form-contact").find(`input[name=Phone]`).val(),
            Mobile: $("#form-contact").find(`input[name=Mobile]`).val(),
            Email: $("#form-contact").find(`input[name=Email]`).val(),
            Website: $("#form-contact").find(`input[name=Website]`).val(),
            Twitter: $("#form-contact").find(`input[name=Twitter]`).val(),
            Facebook: $("#form-contact").find(`input[name=Facebook]`).val(),
            Pinterest: $("#form-contact").find(`input[name=Pinterest]`).val(),
        }
    });

    promise.done((response) => {
        console.log(response);
        alert('<?= get_lang("saved successfully") ?>');
    });
}
</script>