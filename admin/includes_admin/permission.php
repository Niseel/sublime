<?php

    if(!isset($_SESSION['login'])){
    $_SESSION['error'] = '<script type="text/javascript">alert("You need to login to perform this function");</script>';
        header("location: http://localhost/sublime/");
    }
    if(intval($_SESSION['login']['level']) == 1){
    $_SESSION['error'] = '<script type="text/javascript">alert("You dont have enough permissions to access admin page");</script>';
        header("location: http://localhost/sublime/");
    }
    if(intval($_SESSION['login']['level']) == 2){
    $_SESSION['error'] = '<script type="text/javascript">alert("You dont have enough permissions to access admin page");</script>';
        header("location: http://localhost/sublime/admin/");
    }
?>