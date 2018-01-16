var nsListing = nsListing || {};

/**
 * 
 */
nsListing.OnLoad = function() 
{
    nsListing.EventRegister();

    $('select.framed').change();
}

/**
 * 
 */
nsListing.EventRegister = function() 
{
    $('select.framed').change(function(){
        var value = $(this).val() || 0;
        var by = (value > 1) ? "price" : "createdon";
        var ascending = (value % 2 != 0);
        nsListing.Sort(by, ascending);

		// Go to first page after sorting
        nsListingPages.Goto(1);
    });
}

/**
 * 
 */
nsListing.GetContainer = function() {
    var container = $('.div-properties-container');
    return container;
}

/**
 * 
 */
nsListing.GetItems = function(filter_selector) {
    filter_selector = filter_selector || "";
    var items = $('.div-property-item' + filter_selector);
    return items;
}

/**
 * 
 */
nsListing.GetFilteredItems = function() {
    return nsListing.GetItems(".redefine-visible");
}


/**
 * 
 * @param {*} item 
 */
nsListing.GetItemObject = function(item) {
    var json = $(item).find('.hdn-property-json').html();
    var obj = JSON.parse(json);

    return obj;
}

/**
 * 
 * @param {*} items 
 */
nsListing.ReloadItems = function(items) {
    var container = nsListing.GetContainer();
    container.html('');

    var html = '';
    for (var i = 0; i < items.length; i++)
    {
        var item = items[i];
        var wrapper = $("<div></div>");
        $(item).appendTo(wrapper);
        var item_html = wrapper.html();
        html += item_html;
    }
    
    container.html(html);
}

/**
 * 
 */
nsListing.Sort = function(by, ascending)
{
    var container = nsListing.GetContainer();
    var items = nsListing.GetItems();

    items.sort(function(a, b){
        var a_createdon = new Date($(a).data(by));
        var b_createdon = new Date($(b).data(by));
        if (ascending)
            return a_createdon - b_createdon;
        else
            return b_createdon - a_createdon;

    });

    nsListing.ReloadItems(items);
}