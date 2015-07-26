<?php
  session_start();
  if(!$_GET['partner'])return;
  require_once '../inc/configuration.php';
  $db = new mysqli("localhost","root","oreal","food");
	mysqli_set_charset($db, "utf8");
	$stmt = $db->prepare("SELECT `name`, `filename`,`quantity` FROM `meals` WHERE `store-id`=? and `quantity`>0 order by `quantity` DESC");
	$stmt -> bind_param('i', $_GET['partner']);
	$stmt -> execute();
	$stmt -> bind_result($name, $fn, $quantity);//print_r($stmt);
	
?>
<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Food4Charity</title>
  <meta name = "viewport" content= "width=device-width, initial-scale=1.0">
  <meta name = "author" content = "">
  <meta name = "description" content = "">

  <link href="../css/main.css" rel="stylesheet">
  <link href="../css/bootstrap.css" rel="stylesheet">

  <link href='http://fonts.googleapis.com/css?family=Indie+Flower' rel='stylesheet' type='text/css'>
  </head>
  <body>
    <div class="container">

      <div class="row">
        <div class="col-md-12">
          <div class="text-center">
            <p style="font-size:30px; font-weight:bold;">31/05/2015</p>
            <h1 style="font-size:80px;">Available Free Meals for today</h1>
          </div>
		  	<?php
	while( $stmt -> fetch()){
	?>
          <div class="row">
            <div class="col-md-2 col-md-offset-2">
              <img src="../img/meals/<?php echo $fn; ?>" class="img-rounded img-responsive" />
            </div>
            <div class="col-md-6">
              <h1 style="font-size:80px;"><?php echo $name ?></h1>
              <p style="font-size:40px;">Quantity: <?php echo $quantity ?> meals</p>
            </div>
          </div>
		  <?php } ?> 
        </div>
      </div>
	  
    </div>
  </body>
</html>