<?php

    $db = new mysqli("localhost","root","oreal","food");
	mysqli_set_charset($db, "utf8");
	$stmt = $db->prepare("SELECT `id`, `name`, `lat`, `long`, `filename` FROM `store` WHERE 1");
	// $stmt -> bind_param('s', $sender);
	$stmt -> execute();
	$stmt -> bind_result($id, $name, $lat, $long, $fn);//print_r($stmt);
	$i=0;
	while( $stmt -> fetch()){
		$response[$i]['name'] = $name;
		$response[$i]['lat'] = $lat; 
		$response[$i]['long'] = $long;
		$response[$i]['filename'] = $fn;
		$response[$i]['id'] = $id;
		$i++;
	}
	echo json_encode($response);
	$stmt -> close();	
	mysqli_close( $db );
?>