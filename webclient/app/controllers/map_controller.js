/**
 * Created by dano on 07/02/17.
 */

var map;
var myLatLng =  {lat: 48.856577777778, lng:2.3518277777778};
var flightPlanCoordinates = [];

function initMap() {

    map = new google.maps.Map(document.getElementById('map'), {
        center: myLatLng,
        zoom: 6
    });

    var Init = new google.maps.LatLng(myLatLng.lat,myLatLng.lng);
    flightPlanCoordinates.push(Init);

    var marker = new google.maps.Marker({
        position: Init,
        map: map,
        draggable: true,
        title: 'Hello World!'
    });

    var infowindow = new google.maps.InfoWindow({
        content: '<img src="img/Tour_Eiffel.jpg" alt="Tour_Eiffel" width="100" height="180"/>'
    });

    marker.addListener('click', function() {
        infowindow.open(map, marker);
    });

    map.addListener('click', function(e) {
        placeMarkerAndPanTo(e.latLng, map);
    });

    //metodo para medir las distancias
   // console.log('obteniendo con Google :' + google.maps.geometry.spherical.computeDistanceBetween () + ' metros');
}

function placeMarkerAndPanTo(latLng, map) {

    cont_lieu=0;
    var distance = google.maps.geometry.spherical.computeDistanceBetween(flightPlanCoordinates[cont_lieu],latLng);
    console.log(distance);

    if(flightPlanCoordinates.length <= 4 && distance < 50000){
        console.log(flightPlanCoordinates);

        var marker = new google.maps.Marker({
            position: latLng,
            animation: google.maps.Animation.DROP,
            icon : 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png',
            map: map
        });

        var infowindow = new google.maps.InfoWindow({
            content: '<img src="img/Tour_Eiffel.jpg" alt="Tour_Eiffel" width="100" height="180"/>'
        });

        marker.addListener('click', function() {
            infowindow.open(map, marker);
        });

        flightPlanCoordinates.push(latLng);
    }


    var flightPath = new google.maps.Polyline({
        path: flightPlanCoordinates,
        geodesic: true,
        strokeColor: '#FF0000',
        strokeOpacity: 1.0,
        strokeWeight: 2
    });
    flightPath.setMap(map);
    map.panTo(latLng);
}


