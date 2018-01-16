var nsSearchEngine = nsSearchEngine || {};

nsSearchEngine.Search = function() {
    // _PROPERTIES_JSON
    var filter = new nsSearchEngine.EngineModel();

    var jsonString = $('#hdn-div-properties-div').text();
    var json = JSON.parse(jsonString);
    var results_count = 0;
    for (var i = 0; i < json.data.length; i++)
    {
        var prop = json.data[i];
        var visible = true;

        var specs = prop.item_specific;

        // category: buy/rent
        visible = (prop.category == filter.category);

        // bedrooms
        if (visible == true && 
            filter.bedrooms != undefined && filter.bedrooms != null && filter.bedrooms != "")
        {
            var bedrooms = specs["Bedrooms"];
            visible = filter.bedrooms == bedrooms;
        }

        // bathrooms
        if (visible == true && 
            filter.bathrooms != undefined && filter.bathrooms != null && filter.bathrooms != "")
        {
            var bathrooms = specs["Bathrooms"];
            visible = filter.bathrooms == bathrooms;
        }

        // prices
        if (visible == true && 
            filter.prices != undefined && filter.prices != null)
        {
            var price = prop.price;
            visible = filter.prices.min <= price && price <= filter.prices.max;
        }

        // features
        if (visible == true && filter.features != null && filter.features.length > 0)
        {
            for (var f = 0; f < filter.features.length; f++)
            {
                var fid = filter.features[f];
                if ($.inArray(fid, prop.FeaturesId) < 0)
                {
                    visible = false;
                }
            }
        }

        // types
        if (visible == true && filter.types != null && filter.types.length > 0)
        {
            visible = $.inArray(prop.TypeId, filter.types) >= 0;
        }

        // location
        if (visible == true && filter.location != null && filter.location != "")
        {
            var prop_title = prop.title.toLowerCase();
            var prop_location = prop.location.toLowerCase();
            var filter_location = filter.location.toLowerCase();

            visible = prop_title.indexOf(filter_location) >= 0 ||
                        prop_location.indexOf(filter_location) >= 0 ||
                            (prop_title + ' ' + prop_location).indexOf(filter_location) >= 0 ||
                            (prop_title + ', ' + prop_location).indexOf(filter_location) >= 0 ;
            
            if (visible == false)
            {
                var ggobj = new nsSearchEngine.getFilter_GoogleSelectedLocation();
                if (ggobj.street_number != "" && ggobj.street_shortname != "" && ggobj.town_shortname != "")
                {
                    var google_title_long = ggobj.street_number + ' ' + ggobj.street_longname;
                    var google_title_short = ggobj.street_number + ' ' + ggobj.street_shortname;
                    google_title_long = google_title_long.toLowerCase();
                    google_title_short = google_title_short.toLowerCase();

                    visible = prop_title.indexOf(google_title_long) >= 0 || prop_title.indexOf(google_title_short) >= 0;
                    visible = visible &&
                                (
                                    prop_location.indexOf(ggobj.town_longname.toLowerCase()) >= 0 || 
                                    prop_location.indexOf(ggobj.town_shortname.toLowerCase()) >= 0 ||
                                    prop_location.indexOf(ggobj.city_longname.toLowerCase()) >= 0 || 
                                    prop_location.indexOf(ggobj.city_shortname.toLowerCase() >= 0)
                                );
                }
            }
        }

        // Finally
        var elem = '.result-property-item-' + prop.id;
        SetVisible(elem, visible);   
        if (visible && $(elem).length>0)
        {
            results_count++;
        }
    }
    $('#span-search-results-count').html(results_count);
}

nsSearchEngine.PrintFilter = function(filter) {
    ConsoleDebug("Search (features): " + filter.features);
    ConsoleDebug("Search (types): " + filter.types);
    ConsoleDebug("Search (bedrooms): " + filter.bedrooms);
    ConsoleDebug("Search (bathrooms): " + filter.bathrooms);    
    ConsoleDebug("Search: PriceMin = " + filter.prices.min);
    ConsoleDebug("Search: PriceMax = " + filter.prices.max);
    ConsoleDebug("Search: (location) = " + filter.location);
    ConsoleDebug("Search: (category) = " + filter.category);
}

nsSearchEngine.EngineModel = function() {
    this.types = nsSearchEngine.getFilter_Types();
    this.features = nsSearchEngine.getFilter_Features();
    this.bedrooms = nsSearchEngine.getFilter_Bedrooms();
    this.bathrooms = nsSearchEngine.getFilter_Bathrooms();
    this.location = nsSearchEngine.getFilter_Location();
    this.prices = new nsSearchEngine.getFilter_Prices();
    this.category = nsSearchEngine.getFilter_Category();
}

nsSearchEngine.PropertySearchModel = function(json_data) {
    var specs = json_data.item_specific;
    this.bedrooms = specs["Bedrooms"];
}

nsSearchEngine.getFilter_Types = function() {
    var options = $('select#type option:selected');
    var types = [];
    options.each(function(index){
        types[index] = $(this).val();
    });
    return types;
}

nsSearchEngine.getFilter_Features = function() {
    var options = $('ul.list-unstyled input[type="checkbox"]');
    var features = [];
    var index = 0;
    options.each(function(idx){
        var isChecked = $(this).is(":checked");
        var featureId = $(this).val();
        if (isChecked)
        {
            features[index++] = featureId;
        }
    });
    return features;
}

nsSearchEngine.getFilter_Bedrooms = function() {
    var count = $('#bedrooms').val();
    return count;
}

nsSearchEngine.getFilter_Bathrooms = function() {
    var count = $('#bathrooms').val();
    return count;
}

nsSearchEngine.getFilter_Location = function() {
    var txt = $('#location').val();
    return txt;
}

nsSearchEngine.getFilter_GoogleSelectedLocation = function() {
    this.street_number =$('#hdn-addr-street-number').val();
    this.street_longname =$('#hdn-addr-street-long').val();
    this.street_shortname =$('#hdn-addr-street-short').val();
    this.town_longname =$('#hdn-addr-town-long').val();
    this.town_shortname =$('#hdn-addr-town-short').val();
    this.city_longname =$('#hdn-addr-city-long').val();
    this.city_shortname =$('#hdn-addr-city-short').val();
}

nsSearchEngine.getFilter_Prices = function() {
    this.max = parseInt($('#price-slider input.value-max').val().replace('$', '').replace(/,/g, ''));
    this.min = parseInt($('#price-slider input.value-min').val().replace('$', '').replace(/,/g, ''));
}

nsSearchEngine.getFilter_Category = function() {
    var catid = $('#hdn-search-filter-category').val();
    return catid;
}