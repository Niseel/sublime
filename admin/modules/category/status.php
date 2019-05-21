<?php
	require_once('../../core_admin/init_admin.php');

    if(isset($_SESSION['error'])){
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    }

    include('../../includes_admin/permission.php');
	$id = intval(getInput('id'));
    $value = $db->getRowArray('category', $id);
    //var_dump($value);
    if(empty($value)){
        $_SESSION['error'] = "No data";
        redirectAdmin('category');
    }

    $status = $value['status'] == 1 ? 0 : 1;
    if($db->update_crm('category', 'status', $status, $id)){
    	if($status == 1){
    		$_SESSION['success'] = "Active category successful";
        	redirectAdmin('category');
    	}else{
    		$_SESSION['success'] = "Inactive category successful";
        	redirectAdmin('category');
    	}
    }else{
		$_SESSION['fail'] = "Update category fail";
		echo "Lỗi: " .$db->error();
    }


?>