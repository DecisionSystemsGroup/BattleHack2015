<!--iframe
  src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d12579.075981496286!2d23.729811126253562!3d37.98252000048911!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2s!4v1432987195384"
  width="100%"
  height="100%"
  frameborder="0"
  style="border:0">
</iframe>-->


<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Simple markers</title>
    <style>
      html, body, #map-canvas {
        height: 400px;
        margin: 0px;
        padding: 0px
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.0&sensor=false"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script>
	var map;
	var markers = [];
	function initialize() {
		var mapOptions = {
		  center: new google.maps.LatLng(37.9704897, 23.7255971),
		  zoom: 11
		};
		map = new google.maps.Map(document.getElementById("map-canvas"),
			mapOptions);
		loadMarkers();
	};
	google.maps.event.addDomListener(window, 'load', initialize);
	function loadMarkers(){
		var query = "./mapInfo.php";
		$.get( query, function( returned_data ) {
			var response = JSON.parse(returned_data);console.log(response);
			for( var i=0; i<response.length; i++){
				var marker = new google.maps.Marker({
					position: new google.maps.LatLng(response[i]['lat'], response[i]['long']),
					map: map,
					title: response[i]['name']
				});
			}
		});
	}
</script>

    
  </head>
  <body>
    <div id="map-canvas"></div>
  </body>
</html>
