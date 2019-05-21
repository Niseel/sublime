<?php
	require_once('../../core_admin/init_admin.php');

	$id = intval(getInput('id'));
    $value = $db->getRowArray('orders', $id);
    //var_dump($value);
    if(empty($value)){
        $_SESSION['error'] = "No data";
        redirectAdmin('order');
    }
    if($value['status'] == 1){
        $_SESSION['success'] = "Had process";
        redirectAdmin('order');
    }
    $status = 1;
    if($db->update_crm('orders', 'status', $status, $id)){
        $db->update_crm('orders', 'admin_id', $_SESSION['login']['name_id'], $id);
        $sql = "SELECT * FROM detailorder WHERE order_id = '$id'";
        $detailorder = $db->query($sql);
        foreach ($detailorder as $item) {
            $product_id = intval($item['product_id']);
            $product = $db->getRowArray('product', $product_id);
            $qty_after = $product['amount'] - $item['qty'];
            $pay_after = $product['pay'] + $item['qty'];
            $change_qty = $db->update('product', array('amount'=>$qty_after, 'pay'=>$pay_after), $product_id);
        }
    	if($status == 1){
    		$_SESSION['success'] = "Process orders successful";
        	redirectAdmin('order');
    	}else{
    		$_SESSION['success'] = "Unprocess orders successful";
        	redirectAdmin('order');
    	}
    }else{
		$_SESSION['fail'] = "Unprocess orders fail";
		echo "Lỗi: " .$db->error();
    }


?>