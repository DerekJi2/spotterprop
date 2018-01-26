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


}

nsProperty.Update = function(model) {

    var URL = BASEURL + "Property/Update";
    // ConsoleLog(URL);
    // ConsoleLog(model);

    var promise = $.ajax({
        url: URL,
        data: model, 
        type : "POST",
    });

    return promise;
}


nsProperty.Delete = function(propertyId, userid, really) {
    var URL = BASEURL + "Property/Delete";
    console.log("Delete: really = " + really);

    var promise = $.ajax({
        url: URL,
        data: { 
            PropertyId: propertyId, 
            Really: really, 
            UserId: userid
        }, 
        type : "POST",
    });

    return promise;
}

nsProperty.UpdateStatus = function(propertyId, userid, statusid) {
    var URL = BASEURL + "Property/UpdateStatus";
    console.log("UpdateStatus: StatusId = " + statusid);

    var promise = $.ajax({
        url: URL,
        data: { 
            PropertyId: propertyId, 
            UserId: userid,
            StatusId: statusid, 
        }, 
        type : "POST",
    });

    return promise;
}

nsProperty.Draft = function(propertyId, userid) {
    var statusid = 1;
    return nsProperty.UpdateStatus(propertyId, userid, 1);
}

nsProperty.Submit = function(propertyId, userid) {
    var statusid = 2;
    return nsProperty.UpdateStatus(propertyId, userid, 2);
}

nsProperty.Publish = function(propertyId, userid) {
    var statusid = 3;
    return nsProperty.UpdateStatus(propertyId, userid, 3);
}

nsProperty.StatusText = function(statusId)
{
    var StatusArray = ["undefined",
                        "draft",
                        "submitted",
                        "published"];

    if (statusId >= 0 && statusId < StatusArray.length)
    {
        return StatusArray[statusId];
    }
    return "UNDEFINED";
}

nsProperty.StatusLabel = function(statusId)
{
    var StatusArray = ["undefined",
    "label-warning",
    "label-info",
    "label-success"];

    if (statusId >= 0 && statusId < StatusArray.length)
    {
        return StatusArray[statusId];
    }
    return "UNDEFINED";
}