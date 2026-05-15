<?php

session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
}

if($_SESSION['user_role'] != 'tester'){
    die("Access Denied");
}

?>