<?php

    $db = new mysqli("localhost","root","oreal","food");
	$stmt = $db->prepare("SELECT `name`, `lat`, `long` FROM `store` WHERE 1");
	// $stmt -> bind_param('s', $sender);
	$stmt -> execute();
	$stmt -> bind_result($name, $lat, $long);//print_r($stmt);
	$i=0;
	while( $stmt -> fetch()){
		$response[$i]['name'] = $name;
		$response[$i]['lat'] = $lat; 
		$response[$i]['long'] = $long;
		$i++;
	}
	echo json_encode($response);
	$stmt -> close();	
	mysqli_close( $db );
?>