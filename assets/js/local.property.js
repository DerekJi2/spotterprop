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