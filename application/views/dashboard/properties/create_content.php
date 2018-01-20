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
                <label for="country">Purpose: </label>
                <input name="category" type="radio" class="custom-control-input" value="1" checked>
                <label class="custom-control-label" for="credit">For Sale</label>

                <input name="category" type="radio" class="custom-control-input" value="2">
                <label class="custom-control-label" for="debit">For Rent</label>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-8 mb-3">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" placeholder="Detailed Address" value="123" required>
            <div class="invalid-feedback"></div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="location">City</label>
            <input type="text" class="form-control" id="location" placeholder="Enter the City" value="Lebanon" required>
            <div class="invalid-feedback"></div>
        </div>
    </div>

    <div class="row form-group form-row">
        <div class="col-md-12 mb-3">
            <div><label for="country">Property Type: </label></div>
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
                <label class="custom-control-label" for="credit"><?= get_lang($type->Name) ?></label>
                </span>
            <?php 
            } ?>
            <div class="invalid-feedback"></div>
        </div>
    </div>

    <div class="row form-group form-row">
        <div class="col-md-4">
            <label for="price">Price: </label>
            <div class="input-group">
                <input type="text" class="form-control" id="price" placeholder="Price" required>
            </div>
        </div> 
        <div class="col-md-4">
            <label for="builtyear">Built Year: </label>
            <div class="input-group">
                <input type="text" class="form-control" id="builtyear" placeholder="Built Year" required>
            </div>
        </div>    
        <div class="col-md-4">
            <label for="featured">Featured: </label>
            <div class="input-group featured-group" style="margin-top:5px;">
                <span class="span-feature-item">
                    <input id="featured-yes" name="featured" type="radio" 
                        class="custom-control-input" value="1" >
                    <label class="custom-control-label" for="credit">Yes</label>
                </span>
                <span class="span-feature-item">
                    <input id="featured-yes" name="featured" type="radio" 
                        class="custom-control-input" value="0" checked>
                    <label class="custom-control-label" for="credit">No</label>
                </span>
            </div>
        </div>   
    </div>

    <div class="row">
        
    </div>

    <div class="row form-group form-row">
        <div class="col-md-12 mb-3">
            <div><label>Features</label></div>
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
            <div><label>Description</label></div>
            <textarea style="width:100%;height:60px;"></textarea>
        </div>
    </div>

    <div class="row form-group form-row">
        <div class="col-md-12 mb-3">
            <label for="latitude">Latitude & Longitued</label>
            <table class="table map-latlng-table">
                <tr class="row map-latlng-tr">
                    <td class="map-latlng-td">Latitude: <span class="map-latitude">0</span></td>
                    <td class="map-latlng-td">Longitude: <span class="map-longitude">0</span></td>
                </tr>
            </table>
            <?php $this->load->view("dashboard/properties/google_map"); ?>
        </div>
    </div>

    <!-- <div class="row form-group form-row">
        <div class="col-md-5 mb-3">
            <label for="username">Gallery</label>
            <div class="input-group">
                <input type="text" class="form-control" id="username" placeholder="Username" required>
                <div class="invalid-feedback" style="width: 100%;"></div>
            </div>
        </div>
    </div> -->

    <div class="hidden">
        <input type="hidden" id="personid" value="0" />
        <input type="hidden" id="propertyid" value="0" />
    </div>
    <hr class="mb-12">
    
    <div class="row form-group form-row">
        <div class="col-md-12 col-lg-12 col-sm-12 alert-box" style="display:block;">
            <div class="col-md-6 col-lg-8 col-sm-12 alert alert-warning" role="alert" > 
                Are you going to create this property? 
            </div>
            <button href="javascript:void(0);" onclick="javascript: onPropCreateCancelClick();" class="btn btn-secondary" style="margin:10px;">Cancel</button>
            <button href="javascript:void(0);" onclick="javascript: onPropCreateSaveConfirm();" class="btn btn-danger" style="margin:10px;">Yes, continue to save</button>
        </div>
        <div class="col-md-3 mb-3" >
            <!-- <button class="btn btn-default btn-prop-create-cancel" type="button">Cancel</button> -->
            <button class="btn btn-primary btn-prop-create-save" type="button" onclick="javascript: onPropCreateSaveClick(this);">Save</button>
        </div>        
    </div>
    <hr class="mb-12">
</form>
</div>

<script type="text/javascript" src="assets/js/local.property.js"></script>

<script type="text/javascript">
    /**
     * 
     */
    function onPropCreateSaveConfirm() {
        var model = new propertyCreateModel();
        console.log(model);

        nsProperty.Create(model);

        promise.fail((xhr, status, error) =>{
            ConsoleLog("nsProperty.Create().fail() " + error);
        });

        promise.done((response) =>{
            ConsoleLog("nsProperty.Create().done() ");
            ConsoleLog(response);
        });
        
        promise.always(() => {
            ConsoleLog("nsProperty.Create().always()");
        });
    }

    /**
     * 
     */
    function propertyCreateModel() {
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
    }

    /**
     * 
     */
    function onPropCreateSaveClick(btn) {
        $('.alert-box').show();
        $(btn).hide();
    }

    /**
     * 
     */
    function onPropCreateCancelClick() {
        $('.alert-box').hide();
        $(".btn-prop-create-save").show();
    }

</script>