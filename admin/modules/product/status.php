<?php
	require_once('../../core_admin/init_admin.php');
    if(isset($_SESSION['error'])){
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    }

    include('../../includes_admin/permission.php');
	$id = intval(getInput('id'));
    $value = $db->getRowArray('product', $id);
    //var_dump($value);
    if(empty($value)){
        $_SESSION['error'] = "No data";
        redirectAdmin('product');
    }

    $status = $value['status'] == 1 ? 0 : 1;
    if($db->update_crm('product', 'status', $status, $id)){
    	if($status == 1){
    		$_SESSION['success'] = "Active product successful";
        	redirectAdmin('product');
    	}else{
    		$_SESSION['success'] = "Inactive product successful";
        	redirectAdmin('product');
    	}
    }else{
		$_SESSION['fail'] = "Update product fail";
		echo "Lỗi: " .$db->error();
    }

?>