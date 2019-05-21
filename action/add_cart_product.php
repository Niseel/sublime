<?php
session_start();
	require_once ('classes/Database.php');
	require_once ('classes/Functions.php');
	$db = new Database();

	$id = intval(postInput('key'));
	$qty = intval(postInput('qty'));

	$product = $db->getRowArray('product', $id);
	$number_product = intval($product['amount']);
	//_debug($number_product - $qty);

	if($number_product - $qty < 0){
		$qty = $number_product;
		echo $number_product;
	}else{
		echo 1;
	}
	if(!isset($_SESSION['cart'][$id])){
	  	$_SESSION['cart'][$id]['name'] = $product['name'];
	   	$_SESSION['cart'][$id]['image'] = $product['image'];
	   	$_SESSION['cart'][$id]['qty'] = $qty;
	   	$_SESSION['cart'][$id]['price'] = ((100 - $product['sale']) * $product['price']) / 100;
	}else{
		$_SESSION['cart'][$id]['qty'] += $qty;
	}
?>