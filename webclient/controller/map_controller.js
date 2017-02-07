/**
 * Created by dano on 07/02/17.
 */

var map;
var myLatLng =  {lat: 48.856577777778, lng:2.3518277777778};

function initMap() {

    map = new google.maps.Map(document.getElementById('map'), {
        center: myLatLng,
        zoom: 6
    });

    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
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
}

var flightPlanCoordinates = [
    myLatLng
];

function placeMarkerAndPanTo(latLng, map) {


    if(flightPlanCoordinates.length <= 4){
        console.log(flightPlanCoordinates);

        var marker = new google.maps.Marker({
            position: latLng,
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


