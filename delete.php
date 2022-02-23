<?php
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit;
}
require_once './db_connection.php';
$id = trim(mysqli_real_escape_string($conn, $_GET['id']));
$delete_user = mysqli_query($conn, "DELETE FROM `studentsreport` WHERE studentid='$id'");
header('Location: index.php');
exit;