<?php
  session_start();
  require_once 'inc/configuration.php';
  require_once './braintree-php-3.0.0/lib/Braintree.php';
  require_once './inc/BTconf.php';
?>
<!DOCTYPE html>
  <head>
  <meta charset="utf-8">
    <?php require_once 'inc/head.php'; ?>
	<script src="https://maps.googleapis.com/maps/api/js?v=3.0&sensor=false"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script></script>
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
					$('.stores-container').append("<div class=\"text-center col-md-2 store-item\" id=\""+response[i]['id']+"\"><img src=\"./img/"+response[i]['filename']+"\" class=\"img-rounded img-responsive\"><span class=\"store-title\">"+response[i]['name']+"</span></div>");
					$('.stores-container').first('.store-item').addClass('col-xs-offset-1');
				}
				$('.store-item').click(function(){
					var clicked_id = $(this).attr('id');
					var primCont = $("#primary").is(":visible");	//toggle with the right order
					$(primCont?"#primary":"#secondary").fadeToggle(500, function(){
						$(primCont?"#secondary":"#primary").fadeToggle(400, function(){
							updateMeals(clicked_id);
						});
					});
				});
			});
		}
		/*<div class="col-md-4 text-center">
		  <img src="img/pat1.jpg" class="img-rounded img responsive" />
		  <h1>Big Burger 6$</h1>
		  <div class="row">
			  <div class="col-xs-4 col-xs-offset-4">
				<input type="number" min="0" max="10" step="1" value="0">
			  </div>
		  </div>
		</div>*/
		function updateMeals(store_id){
			var query = "./inc/getMeals.php?q=full&store-id="+store_id;
			$.get( query, function( returned_data ) {
				var response = JSON.parse(returned_data);
				// $('#checkout').html("<div class=\"col-sm-6 col-sm-offset-3\" id=\"payment-form\"></div>");
				$(".mealcont").remove();
				for( var i=0; i<response.length; i++){
					$( "<div class=\"col-md-4 text-center mealcont\"><img src=\"img/meals/"+response[i]['filename']+"\" class=\"img-rounded img-responsive mealimg\" /><h1>"+response[i]['name']+":"+response[i]['price']+"$</h1><div class=\"row\"><div class=\"col-xs-4 col-xs-offset-4\"><input name=\""+response[i]['id']+"\" type=\"number\" min=\"0\" max=\"10\" step=\"1\" value=\"0\"></div></div></div>" ).insertBefore( "#payment-form" );
				}
				$('<input type=\"text\" name="\store-id\" value=\"'+store_id+'" hidden>').insertBefore( "#payment-form" );
			});
		}

	</script>
    <style>
      html, body, #map-canvas {
        height: 400px;
        margin: 0px;
        padding: 0px
      }
	  .mealimg{
		height: 250px;
		width: 100%;
	  }
	  .site-title>a{
		text-decoration: none;
	  }
    </style>
  </head>

  <body>

    <div class="container">
      <!-- Content -->
      <div class="site-title">
		<a href="./">
			<h1>Food<span>4</span>Charity</h1>
			<h2><i>Pay the meal for the people that need it most.</i></h2>
		</a>
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
                    <th>Meal</th>
                    <th>Donated</th>
                  </tr>
                  <?php
					$db = new mysqli("localhost","root","oreal","food");
					$stmt = $db->prepare("SELECT `name`, `quantity` FROM `meals` order by `quantity` DESC limit 10");
					// $stmt -> bind_param('i', $_POST['store-id']);
					$stmt -> execute();
					$stmt -> bind_result($name, $quantity);//print_r($stmt);
					$i=1;
                    while( $stmt -> fetch()){
                  ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $name; ?></td>
                    <td><?php echo $quantity; $i++; ?></td>
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
		<form id="checkout" method="post" action="./inc/checkout.php">
			<!--div class="col-md-4 text-center">
			  <img src="img/pat1.jpg" class="img-rounded img responsive" />
			  <h1>Big Burger 6$</h1>
			  <div class="row">
				  <div class="col-xs-4 col-xs-offset-4">
					<input type="number" min="0" max="10" step="1" value="0">
				  </div>
			  </div>
			</div-->
			<div class="col-sm-6 col-sm-offset-3" id="payment-form"></div>
			<div class="col-sm-6 col-sm-offset-3">
				<input type="submit" value="Checkout" class="btn btn-primary btn-lg">
			</div>
		</form>
	  </div>
      <!-- Footer -->

        <?php include 'inc/footer.php' ?>
      </div><!-- /Footer -->
    </div><!-- /Container -->
    <?php require_once 'inc/scripts.php'; ?>
	
	<script src="https://js.braintreegateway.com/v2/braintree.js"></script>
	<script>
	
		var clientToken = "<?php echo($clientToken = Braintree_ClientToken::generate(array())); ?>";
		braintree.setup(clientToken, "dropin", {
		  container: "payment-form"
		});
	
	</script>
  </body>
</html>
