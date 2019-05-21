<?php
session_start();
	require_once ('classes/Database.php');
	require_once ('classes/Functions.php');
	$db = new Database();

	$key = intval(postInput('key'));
	unset($_SESSION['cart'][$key]);
	echo 1;
?>