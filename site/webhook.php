<?php
    require_once 'inc/dbCon.php';
	$db = dbConnect();
	// $d = serialize($_POST);
	// $d = $_FILES['attachment1']['tmp_name'];
	/*$stmt = $db->prepare("INSERT INTO `mailinfo`(`data`) VALUES (?)");
	$stmt -> bind_param('s', serialize($_POST['from']));
	$stmt -> execute();*/
	$sender = explode( '>', explode('<', $_POST['from'])[1] )[0];
	
	$stmt = $db->prepare("SELECT `id` FROM `store` WHERE `mail`=?");
	$stmt -> bind_param('s', $sender);
	$stmt -> execute();
	$stmt -> bind_result($store_id);
	$stmt -> fetch();
	$stmt -> close();
	if( $store_id ){
		$d = explode(",", $_POST['text']);
		$mealName = $d[0];
		$mealPrice = $d[1]+0;
		$extension = end((explode(".", $_FILES["attachment1"]["name"])));
		$filename = uniqid().'.'.$extension;
		if( $_POST['subject']=='add' && $_POST['attachments']>0 && count($d)==2 && $_FILES['attachment1']['size']<8194304){
			
			$stmt = $db->prepare("INSERT INTO `meals`(`store-id`, `price`, `name`, `filename`) VALUES (?, ?, ? ,?)");
			$stmt -> bind_param('idss', $store_id, $mealPrice, $mealName, $filename);
			if( $stmt -> execute() )
				move_uploaded_file($_FILES['attachment1']['tmp_name'], './img/meals/'.$filename);
			$stmt -> close();
			mysqli_close( $db );
		}
	}
?>