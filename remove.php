<?php
session_start();
    require_once ('action/classes/Database.php');
    require_once ('action/classes/Functions.php');
    $key = intval($_GET['key']);
   // _debug($_SESSION['cart'][$key]);

    if(empty($_SESSION['cart'][$key])){
        $_SESSION['error'] = '<script type="text/javascript">alert("No data");</script>';
        redirectHome('cart.php');
    }else{
        unset($_SESSION['cart'][$key]);
         $_SESSION['error'] = '<script type="text/javascript">alert("Remove product successful");</script>';
        redirectHome('cart.php');
    }

?>