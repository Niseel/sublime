<?php
    require_once('../../core_admin/init_admin.php');
    if(isset($_SESSION['error'])){
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    }

    include('../../includes_admin/permission.php');
    $id = intval(getInput('id'));
    $value = $db->getRowArray('brand', $id);
    if(empty($value)){
        $_SESSION['error'] = "No data";
        redirectAdmin('brand');
    }
    $row = $db->numRow_by_id('product', 'brand_id', $id);

    if($row == 0){
        if($db->delete('brand', $id)){
            $_SESSION['success'] = "Delete brand successful";
            redirectAdmin('brand');
        }else{
            $_SESSION['fail'] = "Delete brand fail";
            redirectAdmin('brand');
        }
    }else{
        $_SESSION['fail'] = "Delete brand fail because stil exist procducts of this brand";
        redirectAdmin('brand');
    }
?>