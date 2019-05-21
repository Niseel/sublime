<?php
session_start();
    require_once ('../../../action/classes/Database.php');
    require_once ('../../../action/classes/Functions.php');
    $db = new Database();

    define("ROOT", $_SERVER['DOCUMENT_ROOT'] ."/sublime/public/uploads/");
?>