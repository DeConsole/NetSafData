<?php
require_once './db_connection.php';
require_once './fetch-data.php';
require_once './update.php';
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit;
}

if (isset($_POST['s_firstname']) && isset($_POST['s_surname']) && isset($_POST['s_email']) && isset($_POST['s_phonenumber']) && isset($_POST['sending_status']) && isset($_POST['sending_date']) && isset($_POST['receipt_status'])) {

    $update_data = updateUser($conn, $_GET['id'], $_POST['s_firstname'], $_POST['s_surname'],
        $_POST['s_email'], $_POST['s_phonenumber'], $_POST['sending_status'], $_POST['sending_date'], $_POST['receipt_status']);

    if ($update_data === true) {
        header('Location: index.php');
        exit;
    }
}

$theUser = fetchUser($conn, $_GET['id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NETSCAPE SAFARICOM DATA REPORT</title>
    <link rel="stylesheet" href="./style.css">
</head>


<body>

<div class="container">
    <header class="header">
        <h1 class="title">Netscape class <span style="color: green">Safaricom</span> Data Report</h1>
        <h3 class="title">Record<span style="color: orangered">update</span></h3>
    </header>
    <div class="wrapper edit-wrapper">
        <div class="form">
            <form method="POST">

            <label for="FirstName">First Name</label>
            <input type="text" name="s_firstname" value="<?php echo htmlspecialchars($theUser['s_firstname']); ?>" id="FirstName" placeholder="First
                        Name" autocomplete="off" required>
            <label for="Surname">Surname</label>
            <input type="text" name="s_surname" value="<?php echo htmlspecialchars($theUser['s_surname']); ?>" id="Surname" placeholder="Surname"
                   autocomplete="off" required>
            <label for="Email">Email</label>
            <input type="email" name="s_email" value="<?php echo htmlspecialchars($theUser['s_email']); ?>" id="Email" placeholder="Email"
                   autocomplete="off" required>
            <label for="PhoneNumber">Phone Number</label>
            <input type="text" name="s_phonenumber" value="<?php echo htmlspecialchars($theUser['s_phonenumber']); ?>" id="PhoneNumber" placeholder="Phone Number" autocomplete="off"
                   required>
            <label for="SendingStatus">Sending Status</label>
            <select id="SendingStatus" name="sending_status" required
            <option selected>"<?php echo htmlspecialchars($theUser['sending_status']); ?>"</option>
            <option>Sent</option>
            <option>Not sent</option>
            </select>
            <label for="SendingDate">Sending Date</label>
            <input type="datetime-local" id="SendingDate" name="sending_date"
                   value="<?php echo htmlspecialchars($theUser['sending_date']); ?>" autocomplete="off">

            <label for="ReceiptStatus">Receipt Status</label>
            <select id="ReceiptStatus" name="receipt_status" required
            <option selected>"<?php echo htmlspecialchars($theUser['receipt_status']); ?>"</option>
            <option>Received</option>
            <option>Not Received</option>
            </select>
            <?php if (isset($update_data) && $update_data !== true) {
                echo '<p class="msg err-msg">' . $update_data . '</p>';
            }
            ?>
            <button type="submit" class="btn shadow" value="Update">Update</button>
        </form>
    </div>
</div>
</body>
</html>