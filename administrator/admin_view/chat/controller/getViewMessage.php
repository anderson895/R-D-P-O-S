<?php
include("../.../../../../../connection.php");
date_default_timezone_set('Asia/Manila');

session_start();

$session_acc_id = $_SESSION["acc_id"];
$account_id = $_GET['account_id'];

if($account_id!='view_all'){

// Query messages
$query = "SELECT m.*, a.emp_image, a.acc_fname, a.acc_lname, a.acc_type
    FROM messages AS m
    INNER JOIN account AS a ON m.mess_sender = a.acc_id
    WHERE (m.mess_reciever = $account_id) OR (m.mess_sender = $account_id)
    order by mess_date ASC
    ";

$result = mysqli_query($connections, $query);

$messages = array();

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $get_sender_information = mysqli_query($connections, "SELECT * FROM account WHERE acc_id = '$account_id'");
        $sender_row = mysqli_fetch_assoc($get_sender_information);

        $row['Reciever_id'] = $row['mess_sender'];
        $row['Reciever_image'] = $sender_row["emp_image"];
        
        $row['acc_type'] = ucfirst($row["acc_type"]);
        $row['Reciever_fullname'] = $sender_row["acc_fname"] . ' ' . $sender_row["acc_lname"];
        $messages[] = $row;
    }
}


$sql = "UPDATE messages SET mess_seen = 2 WHERE mess_sender = '$account_id'";
if ($connections->query($sql) === TRUE) {
    // echo "Notification updated successfully."; // Commented this line to ensure no other text or HTML is included in the response.
} else {
    // echo "Error updating notification: " . $connections->error; // Commented this line to ensure no other text or HTML is included in the response.
}

}

header('Content-Type: application/json');
echo json_encode($messages);
?>
