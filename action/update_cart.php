<?php
session_start();
	require_once ('classes/Database.php');
	require_once ('classes/Functions.php');
	$db = new Database();

	$id = intval(postInput('key'));
	$qty = intval(postInput('qty'));

	$sql = "SELECT amount FROM product WHERE id = '$id'";
	$product = $db->query($sql, true);
	$number_product = intval($product[0]['amount']);

	if($number_product - $qty < 0){
		$_SESSION['cart'][$id]['qty'] = $number_product;
		echo $number_product;
	}else{
		$_SESSION['cart'][$id]['qty'] = $qty;
		echo 1;
	}
	//$_SESSION['cart'][$id]['qty'] = $qty;
	//echo 1;
?>