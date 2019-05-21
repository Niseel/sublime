<?php
session_start();

	if(isset($_SESSION['login'])){

		unset($_SESSION['login']);
		unset($_SESSION['cart']);
		/*unset($_SESSION['name_user']);
		unset($_SESSION['name_id']);
		unset($_SESSION['mail']);
		unset($_SESSION['status']);
		unset($_SESSION['level']);*/

		$_SESSION['error'] = '<script type="text/javascript">alert("Log out successful");</script>';
		header("location: http://localhost/sublime/");
	}else{
		header("location: http://localhost/sublime/");
	}

?>
