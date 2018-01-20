var nsGoogleMap = nsGoogleMap || {};

nsGoogleMap.Latitude = 0;
nsGoogleMap.Longitude = 0;

nsGoogleMap.SetLatitude = function(lat) 
{
    nsGoogleMap.Latitude = lat;
    $('.map-latitude').html(lat);
}


nsGoogleMap.SetLongitude = function(long) 
{
    nsGoogleMap.Longitude = long;
    $('.map-longitude').html(long);
}


nsGoogleMap.GetLatitude = function() 
{
    return nsGoogleMap.Latitude;
}


nsGoogleMap.GetLatitude = function() 
{
    return nsGoogleMap.Longitude;
}