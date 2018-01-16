var nsSearchPanel = nsSearchPanel || {};

/**
 * OnLoad()
 */
nsSearchPanel.OnLoad = function()
{
    nsSearchPanel.RegisterEvents();
}

/**
 * 
 * @param {array} addr_components - autocomplete.getPlace().address_components[]
 */
nsSearchPanel.OnGoogleLocationSelected = function(addr_components) 
{
    var addr_street_number = addr_components[0] && addr_components[0].short_name || '';
    var addr_street_long = addr_components[1] && addr_components[1].long_name || '';
    var addr_street_short = addr_components[1] && addr_components[1].short_name || '';
    var addr_town_long = addr_components[2] && addr_components[2].long_name || '';
    var addr_town_short = addr_components[2] && addr_components[2].short_name || '';
    var addr_city_long = addr_components[2] && addr_components[3].long_name || '';
    var addr_city_short = addr_components[2] && addr_components[3].short_name || '';

    $('#hdn-addr-street-number').val(addr_street_number);
    $('#hdn-addr-street-long').val(addr_street_long);
    $('#hdn-addr-street-short').val(addr_street_short);
    $('#hdn-addr-town-long').val(addr_town_long);
    $('#hdn-addr-town-short').val(addr_town_short);
    $('#hdn-addr-city-long').val(addr_city_long);
    $('#hdn-addr-city-short').val(addr_city_short);
}

/**
 * Register DOM events
 */
nsSearchPanel.RegisterEvents = function()
{
    /**
     * Add buttons for 'bedrooms'/'bathrooms'
     */
    $('.input-btn-plus').click(function()
    {
        $input = $(this).parents('.form-group').find('input');
        var count = $input.val();
        count = count || 0;
        count++;
        $input.val(count);

        nsSearchEngine.Search();
    });

    /**
     * Minus buttons for 'bedrooms'/'bathrooms'
     */
    $('.input-btn-minus').click(function()
    {
        $input = $(this).parents('.form-group').find('input');
        var count = $input.val();
        count = count || 0;
        count--;

        if (count <= 0)
            $input.val('');
        else
            $input.val(count);

        nsSearchEngine.Search();
    });

    /**
     * Prices
     */
    $('.noUi-base').click(function(){
        nsSearchEngine.Search();
    });

    /**
     * Property Types
     */
    $('select#type').change(function(){
        nsSearchEngine.Search();
    });

    /**
     * Features
     */
    $('.icheckbox, .label-feature-checkbox').click(function(){
        nsSearchEngine.Search();
    });

    /**
     * location: on textChanged
     */
    $('#location').on('input', function(){
        nsSearchEngine.Search();
    });
}