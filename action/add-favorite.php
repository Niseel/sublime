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
	        $_SESSION['error'] = '<script type="text/javascript">alert("No data");</script>';
	        redirectHome('');
	    }

	    $user_id = $_SESSION['login']['name_id'];

        $data= [
            'user_id'    => $user_id,
            'product_id' => $id
        ];
        $row = $db->num_rows_condition2('favorite', 'user_id', $user_id, 'product_id', $id);
        //_debug($row);
        if($row == 0){
			$value = $db->insert('favorite', $data);
	        if($value){
	            $_SESSION['error'] = '<script type="text/javascript">alert("Add favorite product success");</script>';
	            redirectHome('');
	        }else{
	            echo '<script type="text/javascript">alert("Add favorite product fail");</script>';
	            echo "Lỗi: " .$db->error();
	        }
       	}else{
       		$_SESSION['error'] = '<script type="text/javascript">alert("You already liked this product");</script>';
			redirectHome('');
       	}

	}
?>