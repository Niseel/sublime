<?php
    require_once('../../core_admin/init_admin.php');
    $id = intval(getInput('id'));
    $value = $db->getRowArray('admin', $id);
    if(empty($value)){
        $_SESSION['error'] = "No data";
        redirectAdmin('admin');
    }
    if($db->reset_pass('admin', $id)){
        $_SESSION['success'] = "Reset password admin to '123456' successful";
        redirectAdmin('admin');
    }else{
        $_SESSION['fail'] = "Reset password admin fail";
        redirectAdmin('admin');
    }
?>