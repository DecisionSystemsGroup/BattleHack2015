<?php
	if(@$_GET['q']=='full'&&@$_GET['store-id']){
		$db = new mysqli("localhost","root","oreal","food");
		mysqli_set_charset($db, "utf8");
		$stmt = $db->prepare("SELECT `id`, `name`, `price`, `filename` FROM `meals` WHERE `store-id`=?");
		$stmt -> bind_param('i', $_GET['store-id']);
		$stmt -> execute();
		$stmt -> bind_result($id, $name, $price, $filename);//print_r($stmt);
		$i=0;
		while( $stmt -> fetch()){
			$response[$i]['id'] = $id;
			$response[$i]['name'] = $name; 
			$response[$i]['price'] = $price;
			$response[$i]['filename'] = $filename;
			$i++;
		}
		echo json_encode($response);
		$stmt -> close();	
		mysqli_close( $db );
	}
?>