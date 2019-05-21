<?php
    require_once ('../../core_admin/init_admin.php');
    if(isset($_SESSION['error'])){
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    }

    include('../../includes_admin/permission.php');
    $id = intval(getInput('id'));
    $value = $db->getRowArray('category', $id);

    if(empty($value)){
        $_SESSION['error'] = "No data";
        redirectAdmin('category');
    }
    $row = $db->numRow_by_id('product', 'category_id', $id);

    if($row == 0){
        if($db->delete('category', $id)){
            $_SESSION['success'] = "Delete category successful";
            redirectAdmin('category');
        }else{
            $_SESSION['fail'] = "Delete category fail";
            redirectAdmin('category');
        }
    }else{
        $_SESSION['fail'] = "Delete category fail because stil exist procducts of this category";
        redirectAdmin('category');
    }
?>