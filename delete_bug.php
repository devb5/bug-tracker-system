<?php

session_start();
include 'config/database.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
}

$id = $_GET['id'];

$query = "DELETE FROM bugs WHERE id='$id'";

mysqli_query($conn, $query);

header("Location: bugs.php");

?>