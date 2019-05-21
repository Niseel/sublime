<?php
session_start();
	require_once ('classes/Database.php');
	require_once ('classes/Functions.php');
	$db = new Database();

	if(!isset($_SESSION['login'])){
	$_SESSION['error'] = '<script type="text/javascript">alert("You need to login to perform this function");</script>';
		header("location: http://localhost/sublime/");
	}else{
		$id = intval(getInput('id'));
	    $product = $db->getRowArray('product', $id);

	    if(empty($product)){
	        $_SESSION['error'] = "No data";
	        redirectHome('');
	    }

	    if(!isset($_SESSION['cart'][$id])){
	    	$_SESSION['cart'][$id]['name'] = $product['name'];
	    	$_SESSION['cart'][$id]['image'] = $product['image'];
	    	$_SESSION['cart'][$id]['qty'] = 1;
	    	$_SESSION['cart'][$id]['price'] = ((100 - $product['sale']) * $product['price']) / 100;
	    }else{
	    	$_SESSION['cart'][$id]['qty'] += 1;
	    }

	    $_SESSION['error'] = '<script type="text/javascript">alert("Add success");</script>';
		redirectHome('cart.php');
	}

?>