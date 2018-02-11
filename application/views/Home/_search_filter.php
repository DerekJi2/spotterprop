<style>
.dv-buy-rent-row {
    margin-bottom:8px;
    text-align: center;
}
.dv-buy-rent-row a {
    display: inline-block;
    width:46%;
    background: #323232;
    margin-left:0.5%;
    margin-right:0.5%;
    font-weight:bold;
    font-size:14px;
    text-align: center;
    padding:5px;
    border-radius:3px;
}
.dv-buy-rent-row a:hover {
    background: #939393;
}
.dv-buy-rent-row a.selected {
    background: #990000;
}
.dv-buy-rent-row a {
    text-decoration:none;
    color: white;
}
</style>

<script type="text/javascript">
function selectCategory(me)
{
    // UI Highlights
    $('.dv-buy-rent-row a').removeClass('selected');
    $(me).addClass('selected');

    // Set selected value
    var catId = $(me).data('catid');
    $('#hdn-search-filter-category').val(catId);

    // Search
    nsSearchEngine.Search();
}
</script>

<div class="filter">
    <form class="main-search" role="form" method="post" action="?">
        <header class="clearfix">
            <div class='dv-buy-rent-row'>
                <a href='#' onclick="javascript:selectCategory(this);" data-catid="1" class="selected"><?=get_lang('buy'); ?></a>
                <a href='#' onclick="javascript:selectCategory(this);" data-catid="2"><?=get_lang('rent'); ?></a>
                <input type='hidden' value="1" id="hdn-search-filter-category" />
            </div>
            <h3 class="pull-left"><?=get_lang('search'); ?></h3>
            <a href="#advanced-search" class="show-more pull-right" data-toggle="collapse" aria-expanded="false" aria-controls="advanced-search"><?=get_lang('advanced_search'); ?></a>
        </header>
        <div class="advanced-search collapse" id="advanced-search">
            <h4><?=get_lang('feature'); ?></h4>
            <?php // Dynamically load 'Property Features' (checkbox)
                $this->view("Home/_property_features_checkboxes");                                                 
            ?>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="type"><?=get_lang('property_type'); ?></label>
                    <?php // Dynamically load 'Property Type' Dropdown List 
                        $this->view("Home/_property_types_dropdownlist");                                                 
                    ?>
                </div>
                <!-- /.form-group -->
            </div>
            <!--/.col-md-6-->
            <div class="col-md-3">
                <div class="form-group">
                    <label for="bedrooms"><?=get_lang('bedrooms'); ?></label>
                    <div class="input-group counter">
                    <span class="input-group-btn">
                        <button class="btn btn-default input-btn-minus" type="button"><i class="fa fa-minus"></i></button>
                    </span>
                        <input type="text" class="form-control" id="bedrooms" name="bedrooms" placeholder="<?= get_lang('Any') ?>">
                    <span class="input-group-btn">
                        <button class="btn btn-default input-btn-plus" type="button"><i class="fa fa-plus"></i></button>
                    </span>
                    </div><!-- /input-group -->
                </div>
                <!-- /.form-group -->
            </div>
            <!--/.col-md-3-->
            <div class="col-md-3">
                <div class="form-group">
                    <label for="bathrooms"><?=get_lang('bathrooms'); ?></label>
                    <div class="input-group counter">
                    <span class="input-group-btn">
                        <button class="btn btn-default input-btn-minus" type="button"><i class="fa fa-minus"></i></button>
                    </span>
                        <input type="text" class="form-control" id="bathrooms" name="bathrooms" placeholder="<?= get_lang('Any') ?>">
                    <span class="input-group-btn">
                        <button class="btn btn-default input-btn-plus" type="button"><i class="fa fa-plus"></i></button>
                    </span>
                    </div><!-- /input-group -->
                </div>
                <!-- /.form-group -->
            </div>
            <!--/.col-md-3-->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="location"><?=get_lang('location'); ?></label>
                    <div class="input-group location">
                        <input type="text" class="form-control" id="location" placeholder="Enter Location">
                        <span class="input-group-addon"><i class="fa fa-map-marker geolocation" data-toggle="tooltip" data-placement="bottom" title="Find my position"></i></span>
                        <input type="hidden" id="hdn-addr-street-number" />
                        <input type="hidden" id="hdn-addr-street-long" />
                        <input type="hidden" id="hdn-addr-street-short" />
                        <input type="hidden" id="hdn-addr-town-long" />
                        <input type="hidden" id="hdn-addr-town-short" />
                        <input type="hidden" id="hdn-addr-city-long" />
                        <input type="hidden" id="hdn-addr-city-short" />
                    </div>
                </div>
                <!-- /.form-group -->
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?=get_lang('price'); ?></label>
                    <div class="ui-slider" id="price-slider" data-value-min="100" data-value-max="600000" data-value-type="price" data-currency="<?= get_currency() ?>" data-currency-placement="before">
                        <div class="values clearfix">
                            <input class="value-min" name="value-min[]" readonly>
                            <input class="value-max" name="value-max[]" readonly>
                        </div>
                        <div class="element"></div>
                    </div>
                </div>
                <!-- /.form-group -->
            </div>
            <!--/.col-md-6-->
        </div>
        <!--/.row-->
    </form>
    <!-- /.main-search -->
</div>
<!--end Filter-->