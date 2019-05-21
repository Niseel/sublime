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
    if($db->reset_pass('user', $id)){
        $_SESSION['success'] = "Reset password user to '123456' successful";
        redirectAdmin('user');
    }else{
        $_SESSION['fail'] = "Reset password user fail";
        redirectAdmin('user');
    }
?>