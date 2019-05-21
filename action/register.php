<?php
	require_once('../core/init.php');
	if(postInput('username') == '' || postInput('email') == '' || postInput('password') == ''){
		header("location: http://localhost/sublime/");
	}else{
		$data = [
			'name'   => postInput('username'),
	        'mail' => postInput('email'),
	        'password' => md5(postInput('password')),
	    ];
	    //_debug($data);
	    $row = $db->num_rows_condition('user', 'mail', $data['mail']);
	    if($row == 0){
	    	if($db->insert('user', $data)){
		    	$_SESSION['open_login'] = 'Success';
		    	header("location: http://localhost/sublime/");
		    }else{
		    	echo '<script type="text/javascript">alert("register account fail. Back to homesite");location.href="index.php";</script>';
		    }
	    }else{
	    	$_SESSION['error'] = '<script type="text/javascript">alert("Register account fail. Email already exists");</script>';
	    	header("location: http://localhost/sublime/");
	    }
	}


?>