<?php
$host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "netsafdata";

// Create connection
$conn = mysqli_connect($host, $db_user, $db_password, $db_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}