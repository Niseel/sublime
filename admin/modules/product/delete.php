<?php
    require_once('../../core_admin/init_admin.php');
    if(isset($_SESSION['error'])){
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    }

    include('../../includes_admin/permission.php');
    $id = intval(getInput('id'));
    $value = $db->getRowArray('product', $id);
    if(empty($value)){
        $_SESSION['error'] = "No data";
        redirectAdmin('product');
    }
    if($db->delete('product', $id)){
        $_SESSION['success'] = "Delete product successful";
        redirectAdmin('product');
    }else{
        $_SESSION['fail'] = "Delete product fail";
        redirectAdmin('product');
    }
?>