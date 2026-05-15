<?php

include 'includes/admin_check.php';
include 'config/database.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
}

$id = $_GET['id'];

$query = "DELETE FROM projects WHERE id='$id'";

mysqli_query($conn, $query);

header("Location: projects.php");

?>