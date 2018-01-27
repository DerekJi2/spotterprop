var nsRedefineSearch = nsRedefineSearch || {};

/**
 * 
 */
nsRedefineSearch.Search = function() {
    var filter = new nsRedefineSearch.EngineModel();

    var items = nsListing.GetItems();
    var filtered_items = [];
    for (var i = 0; i < items.length; i++)
    {
        var item = items[i];
        
        var obj = nsListing.GetItemObject(item);
        var key_matched = nsRedefineSearch.KeywordMatched(obj, filter);
        var loc_matched = nsRedefineSearch.LocationMatched(obj, filter);
        var type_matched = nsRedefineSearch.TypeMatched(obj, filter);

        console.log(`key_matched = ${key_matched} && loc_matched = ${loc_matched} && type_matched = ${type_matched}`);
        if (key_matched && loc_matched && type_matched)
        {
            SetRedefineVisible(item, true);
        }
        else
        {
            SetRedefineVisible(item, false);
        }
    }

	// Reset Pagination bar
    nsListingPages.ResetPageButtons();

	// Sort
    $('select.framed').change();
}

/**
 * 
 */
nsRedefineSearch.EngineModel = function() {
    this.Keyword = $('form.main-search input#keyword').val();
    this.Location = $('form.main-search input#location').val();
    this.Types = nsSearchEngine.getFilter_Types();
}

/**
 * 
 * @param {*} item_obj 
 * @param {*} filter 
 */
nsRedefineSearch.KeywordMatched = function (item_obj, filter)
{
    if (filter == null || filter.Keyword == null || filter.Keyword == "")
        return true;
    
    var keyword = filter.Keyword.toLowerCase();
    return (item_obj.title.toLowerCase().indexOf(keyword) >= 0);
}

/**
 * 
 * @param {*} item_obj 
 * @param {*} filter 
 */
nsRedefineSearch.LocationMatched = function (item_obj, filter)
{
    if (filter == null || filter.Location == null || filter.Location == "")
        return true;
    
    var location = filter.Location.toLowerCase();
    return (item_obj.location.toLowerCase().indexOf(location) >= 0);
}

/**
 * 
 * @param {*} item_obj 
 * @param {*} filter 
 */
nsRedefineSearch.TypeMatched = function (item_obj, filter)
{
    if (filter == null || filter.Types == null || filter.Types.length < 1)
        return true;

    var typeId = item_obj.TypeId;
    return (filter.Types.indexOf(typeId) >= 0);
}

/**
 * 
 * @param {*} query_string 
 */
nsRedefineSearch.SelectType = function(query_string) 
{
    var queries = query_string.split('&');
    for (var i = 0; i < queries.length; i++)
    {
        var query = queries[i];
        if (query.indexOf("type") >= 0)
        {
            var pair = query.split('=');
            var typeid = pair.length > 1 ? pair[1] : 0;
            typeid = typeid || 0;
            if (typeid > 0)
            {
                var rel = typeid - 1;
                var option = $('ul.dropdown-menu li[rel="' + rel + '"] a');
                option.click();
            }
        }
    }
}

/**
 * 
 * @param {*} queryString 
 */
nsRedefineSearch.RedefineOnQuery = function(queryString)
{
    if (queryString.indexOf("redefine-search-form") >= 0)
    {
        // Show 'Redefine Search' bar
        $('.redefine-search a.inner').click();

        // Set Property Type Dropdown List
        nsRedefineSearch.SelectType(queryString);
        
        // Execute Search
        $('.main-search button').click();
    }
}