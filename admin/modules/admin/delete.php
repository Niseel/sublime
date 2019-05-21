<?php
    require_once('../../core_admin/init_admin.php');
    $id = intval(getInput('id'));
    $value = $db->getRowArray('admin', $id);
    if(empty($value)){
        $_SESSION['error'] = "No data";
        redirectAdmin('admin');
    }
    if($db->delete('admin', $id)){
        $_SESSION['success'] = "Delete admin successful";
        redirectAdmin('admin');
    }else{
        $_SESSION['fail'] = "Delete admin fail";
        redirectAdmin('admin');
    }
?>