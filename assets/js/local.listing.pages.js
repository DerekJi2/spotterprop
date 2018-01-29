var nsListingPages = nsListingPages || {};

/**
 * 
 */
nsListingPages.NumbersPerPage = 10;

/**
 * 
 */
nsListingPages.Total = function()
{
    return $('.redefine-visible').length;
}

/**
 * 
 */
nsListingPages.OnLoad = function() {
    nsListingPages.ResetPageButtons();
    nsListingPages.Goto(1);
}

/**
 * 
 */
nsListingPages.ResetPageButtons = function()
{
    var total = nsListingPages.Total();
    var number = nsListingPages.NumbersPerPage;
    var max_page_number = Math.ceil(total/number);

    $('ul.pagination').html('');
    var first = $('<li class="li-page-1 active"><a href="javascript:nsListingPages.Goto(1);">1</a></li>');
    first.appendTo($('ul.pagination'));

    for (var i = 2; i <= max_page_number; i++)
    {
        var page = $('<li class="li-page-' + i + '"><a href="javascript:nsListingPages.Goto(' + i + ');">' + i + '</a></li>');
        var pre_page = $('.li-page-' + parseInt(i-1));
    
        page.appendTo($('ul.pagination'));
    }
    
    var prev = $('<li class="li-page-prev"><a href="javascript:nsListingPages.GotoNext(-1);" class="previous" ><i class="fa fa-angle-left"></i></a></li>');
    var next = $('<li class="li-page-next"><a href="javascript:nsListingPages.GotoNext(1);" class="next"><i class="fa fa-angle-right"></i></a></li>');
    prev.appendTo($('ul.pagination'));
    next.appendTo($('ul.pagination')); 

    nsListingPages.Cleanup(1, number, total);
}

/**
 * 
 * @param {*} page 
 * @param {*} number 
 * @param {*} total 
 */
nsListingPages.Cleanup = function(page, number, total)
{
    if (page == 1)
        $('.li-page-prev').hide();
    else
        $('.li-page-prev').show();

    var max_page_number = Math.ceil(total/number);
    if (page == max_page_number)
        $('.li-page-next').hide();
    else
        $('.li-page-next').show();
    
    $('#hdn-list-page-number').val(page);
    $('.pagination li').removeClass('active');
    $('.pagination .li-page-' + page).addClass('active');
}

/**
 * 
 * @param {*} page 
 * @param {*} number 
 */
nsListingPages.Goto = function(page, number)
{
    number = number || nsListingPages.NumbersPerPage;
    var total = nsListingPages.Total();

    $('.div-property-item').hide();

    var box = nsListing.GetContainer();
    var idx = 0;
    box.find('div.redefine-visible').each(function(x) {
        var propId = $(this).data("propid");
        idx++;
        var div_num = Math.ceil(idx/number);
        if (div_num == page)
        {
            $('#div-item-' + propId).show();  
        }
    });
    
    nsListingPages.Cleanup(page, number, total);
}

/**
 * 
 * @param {*} skip 
 */
nsListingPages.GotoNext = function(skip)
{
    var cur_page = parseInt($('#hdn-list-page-number').val());
    var page = cur_page + skip;

    nsListingPages.Goto(page);     
    // $('.pagination li .li-page-' + page).click();
}