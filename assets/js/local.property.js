var nsProperty = nsProperty || {};

/**
 * Get a list of properties loaded
 */
nsProperty.GetList = function() {
    var jsonString = $('#hdn-div-properties-div').text();
    var json = JSON.parse(jsonString);
    return json.data;
}

/**
 * Get an object of a property
 * @param {int} id - db.Property.Id
 */
nsProperty.Get = function(id) {
    var list = nsProperty.GetList();
    for (var i = 0; i < list.length; i++)
    {
        var property = list[i];
        if (property.id == id)
            return property;
    }
    return null;
}

nsProperty.Create = function(model) {

    var URL = BASEURL + "Property/Create";
    ConsoleLog(URL);

    var promise = $.ajax({
        url: URL,
        data: model, 
        type : "POST",
    });

    return promise;

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

