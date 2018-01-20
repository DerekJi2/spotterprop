<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCVbV919dtZDR5eKhk1LuRpuS26tdeyHBc"></script>

<div id="map" style="height:340px;"></div>

<script>
function initMap() {
    var lebanon = {lat: 33.854721, lng: 35.862285};
    var map = new google.maps.Map(document.getElementById('map'), { zoom: 8, center: lebanon});
    var marker = new google.maps.Marker({ position: lebanon, map: map });

    nsGoogleMap.SetLatitude(lebanon.lat);
    nsGoogleMap.SetLongitude(lebanon.lng);

    google.maps.event.addListener(map, "click", function (e) { 
        //lat and lng is available in e object
        var latLng = e.latLng;
        //console.log(latLng);
        nsGoogleMap.SetLatitude(latLng.lat());
        nsGoogleMap.SetLongitude(latLng.lng());
    });
}

$(document).ready(function(){
    initMap();                    
});
</script>