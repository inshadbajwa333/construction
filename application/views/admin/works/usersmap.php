<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>S2R Restaurants on Map</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
	<link rel="shortcut icon" href="https://s2rapp.com/demo/wp-content/uploads/2020/06/s2r-app-1.png" type="image/x-icon">
	<style>
	.container{
	  padding: 2%;
	  text-align: center;

	 }
	 #map_wrapper_div {
	  height: 400px;
	}

	#map_tuts {
		width: 100%;
		height: 100%;
	}
	</style>
</head>
<body>
   <div id="map_wrapper_div" style="height:900px;">
    <div id="map_tuts"></div>
   </div>
</body>
<script>
var script = document.createElement('script');
script.src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCAYQDBXle5dHwGcr28oNQaByi7M0Ufm3s&libraries=places&callback=initialize";

document.body.appendChild(script);


function initialize() {
var map;
var bounds = new google.maps.LatLngBounds();
var mapOptions = {
     mapTypeId: 'roadmap'
};

// Display a map on the pagese
map = new google.maps.Map(document.getElementById("map_tuts"), mapOptions);
map.setTilt(45);

// Multiple Markers
var markers = JSON.parse(`<?php echo ($markers); ?>`);
console.log(markers);

 var infoWindowContent = JSON.parse(`<?php echo ($infowindow); ?>`);

// Display multiple markers on a map
var infoWindow = new google.maps.InfoWindow(), marker, i;
    const image = {
    url: "https://admin.s2rapp.com/assets/usermarkericon@4x.png", // url
    scaledSize: new google.maps.Size(20, 30), // scaled size
    origin: new google.maps.Point(0,0), // origin
    anchor: new google.maps.Point(0,0) // anchor
};
// Loop through our array of markers &amp; place each one on the map
for( i = 0; i < markers.length; i++ ) {
    var position = new google.maps.LatLng(markers[i][0], markers[i][1]);
    
    bounds.extend(position);
    marker = new google.maps.Marker({
        position: position,
        map: map,
        animation: google.maps.Animation.DROP,
        icon: image,
        title: markers[i][0]
    });
    

    // Each marker to have an info window
    google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
            infoWindow.setContent(infoWindowContent[i][0]);
            infoWindow.open(map, marker);
        }
    })(marker, i));

    // Automatically center the map fitting all markers on the screen
    map.fitBounds(bounds);
}

// Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
    this.setZoom(15);
    google.maps.event.removeListener(boundsListener);
});


                                  infoWindow = new google.maps.InfoWindow;
var LatLng = new google.maps.LatLng(25.2628711, 55.2988287);
            // Try HTML5 geolocation.
            if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                  lat: position.coords.latitude,
                  lng: position.coords.longitude
                };
                  var marker = new google.maps.Marker({
    position: pos,
    map: map,
    title: "<div style = 'height:60px;width:200px'><b>Your location:</b><br />Latitude: " + LatLng.lat() + "<br />Longitude: " + LatLng.lng(),
    animation: google.maps.Animation.DROP,
    icon: {
            path: google.maps.SymbolPath.CIRCLE,
            fillColor: "blue",
            fillOpacity: 0.7,
            strokeColor: "blue",
            strokeOpacity: 0.7,
            strokeWeight: 0,
            scale: 5
          },
  }); 

                infoWindow.setPosition(pos);
                infoWindow.setContent('You are here now');
                 map.setZoom(15);
                infoWindow.open(map);
                map.setCenter(pos);
              }, function() {
                handleLocationError(true, infoWindow, map.getCenter());
              });
            
            } else {
              // Browser doesn't support Geolocation
              handleLocationError(false, infoWindow, map.getCenter());
            }

}
</script>
</html>
