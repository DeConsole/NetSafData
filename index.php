<?php
require_once './db_connection.php';
require_once './fetch-data.php';
require_once './insert-data.php';
$all_user = array_reverse(fetchUsers($conn));

if (isset($_POST['s_firstname']) && isset($_POST['s_surname']) && isset($_POST['s_email']) &&
    isset($_POST['s_phonenumber']) && isset($_POST['sending_status']) && isset($_POST['sending_date']) && isset
    ($_POST['receipt_status']))
{
    $insert_data = insertData($conn, $_POST['s_firstname'], $_POST['s_surname'], $_POST['s_email'], $_POST['s_phonenumber'], $_POST['sending_status'], $_POST['sending_date'], $_POST['receipt_status']);
    if ($insert_data === true) {
        header('Location: index.php');
        exit;
    }
}

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

<div class="container">
    <header class="header">
        <h1 class="title">Netscape class <span style="color: lawngreen">Safaricom</span> Data Report</h1>
    </header>
    <div class="wrapper">
        <div class="form">
            <form method="POST">
                <label for="FirstName">First Name</label>
                <input type="text" name="s_firstname" id="FirstName" placeholder="First Name"
                       autocomplete="off" required>

                <label for="Surname">Surname</label>
                <input type="text" name="s_surname" id="Surname" placeholder="Surname"
                       autocomplete="off" required>

                <label for="Email">Email</label>
                <input type="email" name="s_email" id="Email" placeholder="Email"
                       autocomplete="off" required>

                <label for="PhoneNumber">Phone Number</label>
                <input type="text" name="s_phonenumber" id="PhoneNumber" placeholder="Phone Number"
                        autocomplete="off" required>

                <label for="SendingStatus">Sending Status</label>
                <select id="SendingStatus" name="sending_status" required>
                    <option>...</option>
                    <option>Sent</option>
                    <option>Not sent</option>
                </select>

                <label for="SendingDate">Sending Date </label>
                <input type="datetime-local" id="Sending_Date" name="sending_date" autocomplete="off">

                <label for="ReceiptStatus">Receipt Status</label>
                <select id="ReceiptStatus" name="receipt_status" required>
                    <option>...</option>
                    <option>Received</option>
                    <option>Not Received</option>
                </select>

                <?php if (isset($insert_data) && $insert_data !== true) {
                    echo '<p class="msg err-msg">' . $insert_data . '</p>';
                }
                ?>
                <button type="submit" class="btn shadow" value="Submit">Add Record</button>
            </form>
        </div>

        <div class="user-list">
            <?php if (count($all_user) > 0) : ?>
                <table>
                    <tbody>
                    <tr>
                        <th>First Name</th>
                        <th>Surname</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Sending Status</th>
                        <th>Sending Date</th>
                        <th>Receipt Status</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach ($all_user as $user) :
                        $studentid = $user['studentid'];
                        $s_firstname = $user['s_firstname'];
                        $s_surname = $user['s_surname'];
                        $s_email = $user['s_email'];
                        $s_phonenumber = $user['s_phonenumber'];
                        $sending_status = $user['sending_status'];
                        $sending_date = $user['sending_date'];
                        $receipt_status = $user['receipt_status'];

                        ?>
                        <tr>

                            <td><?php echo $s_firstname; ?></td>
                            <td><?php echo $s_surname; ?></td>
                            <td><?php echo $s_email; ?></td>
                            <td><?php echo $s_phonenumber; ?></td>
                            <td><?php echo $sending_status; ?></td>
                            <td><?php echo $sending_date; ?></td>
                            <td><?php echo $receipt_status; ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $studentid; ?>" class="edit">Edit</a>&nbsp;|
                                <a href="delete.php?id=<?php echo $studentid; ?>" class="delete delete-action">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <h2>No records found. Please insert some records.</h2>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    var delteAction = document.querySelectorAll('.delete-action');
    delteAction.forEach((el) => {
        el.onclick = function(e) {
            e.preventDefault();
            if (confirm('Are you sure?')) {
                window.location.href = e.target.href;
            }
        }
    });
</script>

</body>

</html>