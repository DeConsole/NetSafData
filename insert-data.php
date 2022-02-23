<?php
function insertData($conn, $s_firstname, $s_surname, $s_email, $s_phonenumber, $sending_status,
                    $sending_date, $receipt_status)
{

    $s_firstname = trim(mysqli_real_escape_string($conn, htmlspecialchars($s_firstname)));
    $s_surname = trim(mysqli_real_escape_string($conn, htmlspecialchars($s_surname)));
    $s_email = trim(mysqli_real_escape_string($conn, htmlspecialchars($s_email)));
    $s_phonenumber = trim(mysqli_real_escape_string($conn, htmlspecialchars($s_phonenumber)));
    $sending_status = trim(mysqli_real_escape_string($conn, htmlspecialchars($sending_status)));
    $receipt_status = trim(mysqli_real_escape_string($conn, htmlspecialchars($receipt_status)));
    $sending_date = trim(mysqli_real_escape_string($conn, $sending_date));


    if (empty($s_firstname) || empty($s_surname) || empty($s_email) || empty($s_phonenumber) || empty($sending_status)) {
        return 'Please fill required fields.';
    } //IF EMAIL IS NOT VALID
    elseif (!filter_var($s_email, FILTER_VALIDATE_EMAIL)) {
        return 'Invalid email address';
    } else {

        $check_email = mysqli_query($conn, "SELECT `s_email` FROM `studentsreport` WHERE `s_email` = '$s_email'");
        // IF THE EMAIL IS ALREADY IN USE
        if (mysqli_num_rows($check_email) > 0) {
            return 'This email is already registered. Please try another.';
        }
        $query = mysqli_query($conn, "INSERT INTO `studentsreport`(`s_firstname`,`s_surname`,`s_email`,`s_phonenumber`,`sending_status`,`sending_date`,`receipt_status`) VALUES('$s_firstname','$s_surname','$s_email','$s_phonenumber','$sending_status','$sending_date','$receipt_status')");
        // IF USER INSERTED
        if ($query) {
            return true;
        }
        return 'Ngori juu ya ngori!';
    }
}
