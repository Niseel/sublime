<?php
	require_once('../../core_admin/init_admin.php');
    if(isset($_SESSION['error'])){
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    }

    include('../../includes_admin/permission.php');

	$id = intval(getInput('id'));
    $value = $db->getRowArray('user', $id);

    if(empty($value)){
        $_SESSION['error'] = "No data";
        redirectAdmin('user');
    }

    $status = $value['status'] == 1 ? 0 : 1;
    if($db->update_crm('user', 'status', $status, $id)){
    	if($status == 1){
    		$_SESSION['success'] = "Active user successful";
        	redirectAdmin('user');
    	}else{
    		$_SESSION['success'] = "Inactive user successful";
        	redirectAdmin('user');
    	}
    }else{
		$_SESSION['fail'] = "Update user fail";
		echo "Lỗi: " .$db->error();
    }


?>