<?php
// FETCH ALL USERS
function fetchUsers($conn){
    $query = mysqli_query($conn,"SELECT * FROM `studentsreport`");
    return mysqli_fetch_all($query,MYSQLI_ASSOC);
};

// FETCH SINGLE USER BY ID
function fetchUser($conn, $studentid){
    $id = mysqli_real_escape_string($conn,$studentid);
    $query = mysqli_query($conn,"SELECT * FROM `studentsreport` WHERE `studentid`='$studentid'");
    $data = mysqli_fetch_assoc($query);
    if(!count($data)){
        header('Location: index.php');
        exit;
    }
    return $data;
}