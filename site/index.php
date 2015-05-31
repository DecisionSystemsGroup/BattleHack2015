<?php
  session_start();
  require_once 'inc/configuration.php';
?>
<!DOCTYPE html>
  <head>
  <meta charset="utf-8">
    <?php require_once 'inc/head.php'; ?>
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
			var query = "./inc/mapInfo.php";
			$.get( query, function( returned_data ) {
				var response = JSON.parse(returned_data);
				for( var i=0; i<response.length; i++){
					var marker = new google.maps.Marker({
						position: new google.maps.LatLng(response[i]['lat'], response[i]['long']),
						map: map,
						title: response[i]['name']
					});
					/*<div class="text-center col-xs-2 col-xs-offset-1 ">
					  <a href="#" onclick="storeEntered()">
						<img src="img/MITSOS.png" class="img-rounded img-responsive"/>
						<span class="store-title">Γυράδικο "Ο Μήτσος"</span>
					  </a>
					</div>*/
					$('.stores-container').append("<div class=\"text-center col-xs-2 store-item\"><img src=\"./img/"+response[i]['filename']+"\" class=\"img-rounded img-responsive\"><span class=\"store-title\">"+response[i]['name']+"</span></div>");
					$('.stores-container').first('.store-item').addClass('col-xs-offset-1');
				}
				$('.store-item').click(function(){
					var primCont = $("#primary").is(":visible");	//toggle with the right order
					$(primCont?"#primary":"#secondary").fadeToggle(500, function(){
						$(primCont?"#secondary":"#primary").fadeToggle(400);
					});
				});
			});
		}

	</script>
    <style>
      html, body, #map-canvas {
        height: 400px;
        margin: 0px;
        padding: 0px
      }
    </style>
  </head>

  <body>
    
    <div class="container">
      <!-- Content -->
      <div class="site-title">
        <h1>Food<span>4</span>Charity</h1>
        <h2><i>Pay the meal for the people that need it most.</i></h2>
      </div>
      <div class="header-stores">
		  <div class="row stores-container">
			<h4 class="text-center">Choose from:</h4>
		  </div>
      </div>
      <div class="row" id="primary">
	  
        <!-- Top Donors -->
        <div class="col-md-3">
          <div class="top-donors">
            <h1 class="text-center">Popular Meals</h1>
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive">
                <table class="table-striped" width="100%">
                  <tr>
                    <th>#</th>
                    <th>Nickname</th>
                    <th>Donated</th>
                  </tr>
                  <?php
                    for ($i=0; $i<10; $i++){
                  ?>
                  <tr>
                    <td><?php echo $i+1;  ?></td>
                    <td>Pandorian</td>
                    <td>N/A</td>
                  </tr>
                  <?php
                    }
                  ?>
                </table>
              </div>
              </div>
            </div>
          </div>
        </div><!-- /Top Donors -->
        <!-- Main Form -->
        <div class="col-md-9 visible-md-9 hidden-xs hidden-sm">
          <!-- Store Map -->
          <div class="main-content">
            <h1>Participating Stores</h1>
            <h2>See all the stores that support the project.</h2>
            <div id="map-canvas"></div>
          </div><!-- /Store Map -->
        </div><!-- /Main Form -->
      </div><!-- /Content -->
	  <div class="row" id="secondary" style="display: none;">
		<h1 class="text-center">Pick a meal</h1>
	  </div>
      <!-- Footer -->

        <?php include 'inc/footer.php' ?>
      </div><!-- /Footer -->
    </div><!-- /Container -->
    <?php require_once 'inc/scripts.php'; ?>
  </body>
</html>
