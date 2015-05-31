<?php
	require_once '../braintree-php-3.0.0/lib/Braintree.php';
	include_once 'inc/head.php';
	Braintree_Configuration::environment('sandbox');
	Braintree_Configuration::merchantId('3qc35974vkn6xfx6');
	Braintree_Configuration::publicKey('n4gwbmfwv9qhxnc6');
	Braintree_Configuration::privateKey('6391cd594debb98b91fb362b49627089');

	if($_POST['store-id']){
		$db = new mysqli("localhost","root","oreal","food");
		$db2 = new mysqli("localhost","root","oreal","food");
		mysqli_set_charset($db, "utf8");
		$stmt = $db->prepare("SELECT `id`, `name`, `price`, `filename` FROM `meals` WHERE `store-id`=?");
		$stmt -> bind_param('i', $_POST['store-id']);
		$stmt -> execute();
		$stmt -> bind_result($id, $name, $price, $filename);//print_r($stmt);
		$sum=0;
		while( $stmt -> fetch()){
			// $sum += $price*$_POST[$id];
			if($_POST[$id]>0){
				$sum += $price*$_POST[$id];
				/*$stmt2 = $db->prepare("SELECT `quantity` FROM `meals` WHERE `id`=?");
				printf("Error: %s.\n", $stmt2->error);
				$stmt2 -> bind_param('i', $id);
				$stmt2 -> execute();
				$stmt2 -> bind_result($n);
				$stmt2 -> fetch();
				$stmt2 -> close();
				$stmt2 = $db->prepare("INSERT INTO `meals (`quantity`) WHERE `id` = ?");
				$stmt2 -> bind_param('i', $n+$_POST[$id]);
				$stmt2 -> execute();*/
				$sql = "UPDATE `meals` SET `quantity`=`quantity`+$_POST[$id] where `id`=$id";
				$db2->query($sql);
				$db2->close();
			}
		}
		$stmt -> close();
		mysqli_close( $db );
	}

	$nonce = $_POST["payment_method_nonce"];
	$result = Braintree_Transaction::sale(array(
	  'amount' => $sum,
	  'paymentMethodNonce' => $nonce
	));
	// print_r( $result );
	echo $result->success?('<h1 class="text-center">Payment Successful, you were charged '.$sum.'$.</h1>'):'nop';
	//print_r($_POST);
?>
