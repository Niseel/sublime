<?php
	require_once ('classes/Database.php');
	require_once ('classes/Functions.php');
	$db = new Database();
	//username email password password_confirmation
	if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_confirmation'])){
		$user = $_POST['username'];
		$mail = $_POST['email'];
		$pass = $_POST['password'];
		$repass = $_POST['password_confirmation'];

		$sql_check_tk = "SELECT * FROM accounts WHERE email = '$mail';";
		$row = $db->num_rows($sql_check_tk);
		if($row != 0){
			echo 'Tài khoản đã tồn tại';
		}else{
			$sql_add_tk = "INSERT INTO taikhoan (tk_name, tk_pass, tk_level) VALUES ('$user', '$pass', '1');"; 
			//$rs = $db->query($sql_add_tk, false);
			if ($db->query($sql_add_tk, false)){
				echo 'Thêm tài khoàn thành công';
			} else {
				echo 'Câu truy vấn bị sai';
			}
		}

	}
?>