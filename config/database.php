<?php

$conn = mysqli_connect("localhost", "root", "", "bug_tracker_system");

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

?>