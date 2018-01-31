<link rel="stylesheet" type="text/css" href="assets/css/user.form.validation.css" />

<style>
.mb-3 { font-size:16px; }
.row { margin-top:4px; }
.custom-control-label { font-weight:normal; font-size:13px; font-family:arial; }
.spn-feature-item { display:inline-block; width:180px; }
.span-type-item { display:inline-block; width:120px; }
.map-latlng-td span { display:inline-block; width:180px;}
.featured-group span { display:inline-block; margin:2px 8px;}
</style>

<div class="col-md-8 order-md-1">

<form>
    
    <div class="row">
        <div class="col-md-5 mb-3">
            <div class="custom-control custom-radio">
                <label for="country"><?= get_lang("Purpose") ?>: </label>
                <input name="category" id="category-1" type="radio" class="custom-control-input" value="1" checked>
                <label class="custom-control-label" for="category-1"><?= get_lang("For Sale") ?></label>

                <input name="category" id="category-2" type="radio" class="custom-control-input" value="2">
                <label class="custom-control-label" for="category-2"><?= get_lang("For Rent") ?></label>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 mb-3">
            <label for="address"><?= get_lang("Address") ?></label>
            <input type="text" class="form-control" id="address" placeholder="<?= get_lang("Detailed Address") ?>" value="123" required>
            <div class="invalid-feedback"></div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="location"><?= get_lang("City") ?></label>
            <input type="text" class="form-control" id="location" placeholder="<?= get_lang("Enter the City") ?>" value="Lebanon" required>
            <div class="invalid-feedback"></div>
        </div>
    </div>

    <div class="row form-group form-row">
        <div class="col-md-12 mb-3">
            <div><label for="country"><?= get_lang("Property Type") ?>: </label></div>
            <?php 
            $types = get_defined_types();
            $count = 0;
            foreach ($types as $type)
            { 
                $count++;
                $checked = ($count == 1) ? "checked" : ""; ?>
                <span class="span-type-item">
                <input id="typeid-<?= $type->Id ?>" name="typeid" type="radio" 
                    class="custom-control-input"
                    value="<?= $type->Id ?>" <?=$checked ?> >
                <label class="custom-control-label" for="typeid-<?= $type->Id ?>"><?= get_lang($type->Name) ?></label>
                </span>
            <?php 
            } ?>
            <div class="invalid-feedback"></div>
        </div>
    </div>

    <div class="row form-group form-row">
        <div class="col-md-4">
            <label for="price"><?= get_lang("Price") ?>: </label>
            <div class="input-group">
                <input type="text" class="form-control" id="price" placeholder="Price" value="100000" required>
            </div>
        </div> 
        <div class="col-md-4">
            <label for="builtyear"><?= get_lang("Built Year") ?>: </label>
            <div class="input-group">
                <input type="text" class="form-control" id="builtyear" placeholder="Built Year" value="1980" required>
            </div>
        </div>    
        <div class="col-md-4">
            <label for="Bedrooms"><?= get_lang("Bedrooms") ?>: </label>
            <div class="input-group">
                <input type="text" class="form-control" id="Bedrooms" placeholder="Bedrooms" value="2" required>
            </div>
        </div> 
        <div class="col-md-4">
            <label for="Bathrooms"><?= get_lang("Bathrooms") ?>: </label>
            <div class="input-group">
                <input type="text" class="form-control" id="Bathrooms" placeholder="Bathrooms" value="1" required>
            </div>
        </div> 
        <div class="col-md-4">
            <label for="Garages"><?= get_lang("Garages") ?>: </label>
            <div class="input-group">
                <input type="text" class="form-control" id="Garages" placeholder="Garages" value="0" required>
            </div>
        </div> 
        <div class="col-md-4">
            <label for="Area"><?= get_lang("Area") ?>: </label>
            <div class="input-group">
                <input type="text" class="form-control" id="Area" placeholder="Area" value="80" required>
            </div>
        </div> 
        <div class="col-md-4">
            <label for="featured"><?= get_lang("Featured") ?>: </label>
            <div class="input-group featured-group" style="margin-top:5px;">
                <span class="span-feature-item">
                    <input id="featured-yes" name="featured" type="radio" 
                        class="custom-control-input" value="1" >
                    <label class="custom-control-label" for="credit"><?= get_lang("Yes") ?></label>
                </span>
                <span class="span-feature-item">
                    <input id="featured-yes" name="featured" type="radio" 
                        class="custom-control-input" value="0" checked>
                    <label class="custom-control-label" for="credit"><?= get_lang("No") ?></label>
                </span>
            </div>
        </div>   
    </div>

    <div class="row">
        
    </div>

    <div class="row form-group form-row">
        <div class="col-md-12 mb-3">
            <div><label><?= get_lang("Features") ?></label></div>
            <div class="custom-control custom-checkbox">
                <div class="form-group">
            <?php 
            $features = get_defined_features();
            $count = 0;
            foreach ($features as $feature)
            { 
                $count++;
            ?>
                <span class="spn-feature-item">
                    <input type="checkbox" class="custom-control-input feature-item" id="feature-<?= $feature->Id ?>" value="<?= $feature->Id ?>">
                    <label class="custom-control-label" for="feature-<?= $feature->Id ?>"><?= get_lang($feature->Name) ?></label>
                </span>
            <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row form-group form-row">
        <div class="col-md-12 mb-3">
            <div><label><?= get_lang("Description") ?></label></div>
            <textarea id="description" class="custom-control-label" style="width:100%;height:60px;"></textarea>
        </div>
    </div>

    <div class="row form-group form-row">
        <div class="col-md-12 mb-3">
            <label for="latitude"><?= get_lang("Latitude & Longitude") ?></label>
            <table class="table map-latlng-table">
                <tr class="row map-latlng-tr">
                    <td class="map-latlng-td"><?= get_lang("Latitude") ?>: <span class="map-latitude">0</span></td>
                    <td class="map-latlng-td"><?= get_lang("Longitude") ?>: <span class="map-longitude">0</span></td>
                </tr>
            </table>
            <?php $this->load->view("dashboard/properties/google_map"); ?>
        </div>
    </div>

    <?php $this->load->view("dashboard/properties/_create_user_select"); ?>

    <?php $this->load->view("dashboard/properties/_gallery_upload"); ?>

    <div class="hidden">
    <?php
        $this->load->helper("MY_user_helper");
        $loginUser = get_login_user();
        $personId = $loginUser == null ? 0 : $loginUser->id;
    ?>
        <input type="hidden" id="personid" value="<?= $personId ?>" />
        <input type="hidden" id="propertyid" value="0" />
        <input type="hidden" id="guid" value=<?= GUID(); ?> />
    </div>
    <hr class="mb-12">
    
    <div class="row form-group form-row">
        <div class="col-md-12 col-lg-12 col-sm-12 confirm-box" style="display:none;">
            <div class="col-md-6 col-lg-8 col-sm-12 alert alert-warning" role="alert" > 
                <?= get_lang("Are you going to create this property") ?>? 
            </div>
            <button href="javascript:void(0);" onclick="javascript: onPropCreateCancelClick();" class="btn btn-secondary" style="margin:10px;"><?= get_lang("Cancel") ?></button>
            <button href="javascript:void(0);" onclick="javascript: onPropCreateSaveConfirm();" class="btn btn-danger" style="margin:10px;"><?= get_lang("Yes, continue to save") ?></button>
        </div>

        <div class="col-md-12 col-lg-12 col-sm-12 progress-box" style="display:none;">
            <div class="col-md-6 col-lg-8 col-sm-12 alert alert-info" role="alert" > 
                
            </div>
        </div>

        <div class="col-md-3 mb-3" >
            <!-- <button class="btn btn-default btn-prop-create-cancel" type="button">Cancel</button> -->
            <button class="btn btn-primary btn-prop-create-save" type="button" onclick="javascript: onPropCreateSaveClick(this);"><?= get_lang("Save") ?></button>
        </div>        
    </div>
    <hr class="mb-12">
</form>
</div>

<script type="text/javascript" src="assets/js/local.property.js"></script>

<script>
var gallery_json = null;

$(document).ready(function(){
    initMap();                  
});
</script>

<script type="text/javascript">
    /**
     * 
     */
    function onPropCreateSaveConfirm() {
        var model = new propertyCreateModel();
        console.log(model);

        $('.confirm-box').hide();
        show_progress_msg("Saving your property ...");

        var promise = nsProperty.Create(model);

        promise.fail((xhr, status, error) =>{
            ConsoleLog("nsProperty.Create().fail() " + error);
            ConsoleLog(xhr.responseText);
        });

        promise.done((response) =>{
            ConsoleLog("nsProperty.Create().done() ");
            ConsoleLog(response);
            var propertyId = response;
            add_progress_msg('Property has been saved successfully! Id = ' + propertyId);

            uploadImages(propertyId);
        });
        
        promise.always(() => {
            ConsoleLog("nsProperty.Create().always()");
        });
    }

    /**
     * 
     */
    function propertyCreateModel() {
        this.CreateUserId = <?= $this->users->current->id ?>;
        this.UserId = $("#personid").val(); //
        
        this.Category = $('input[name=category]:checked').val();

        this.Address = $('#address').val();
        if (isInvalid(this.Address, '#address'))
            return;            

        this.Location = $('#location').val();
        if (isInvalid(this.Location, '#location'))
            return;            

        this.Price = $('#price').val() || 0;        
        this.BuiltYear = $('#builtyear').val() || 0;
        this.Featured = $('input[name=featured]:checked').val() || 0;

        this.TypeId = $('input[name=typeid]:checked').val() || 0;

        features = [];
        $('.feature-item').each(function(x) {
            if ($(this).is(':checked'))
            {
                features.push($(this).val());
            }
        });
        this.Features = features;

        this.Latitude = $('.map-latitude').html() || 0;
        this.Longitude = $('.map-longitude').html() || 0;

        this.PersonId = $('#personid').val() || 0;
        this.PropertyId = $("#propertyid").val() || 0;

        this.Specs = [ 0,               // NOTHING - NOT IN USE
                $('#Bedrooms').val(),   // Bedrooms
                $('#Bathrooms').val(),  // Bathrooms
                0,                      // Rooms - NOT IN USE
                $('#Garages').val(),    // Garages
                $('#Area').val(),       // Area
                0,                      // LandArea - NOT IN USE
                0                       // BuildingArea - NOT IN USE
        ]

        this.guid = $("#guid").val() || "";
        this.Description = $("#description").val() || "";
    }

    /**
     * 
     */
    function onPropCreateSaveClick(btn) {
        $('.confirm-box').show();
        $(btn).hide();
    }

    /**
     * 
     */
    function onPropCreateCancelClick() {
        $('.confirm-box').hide();
        $(".btn-prop-create-save").show();
    }

    function add_progress_msg(msg)
    {
        var alertbox = $('.progress-box .alert');
        var html = alertbox.html();
        html += "<p>" + msg + "</p>";
        alertbox.html(html);
        $('.progress-box').show();
    }

    function close_progress_msg()
    {
        var alertbox = $('.progress-box .alert');

        alertbox.hide();
        alertbox.html('');
    }

    function show_progress_msg(msg)
    {
        var alertbox = $('.progress-box .alert');

        alertbox.html('');
        add_progress_msg(msg);
    }
</script>