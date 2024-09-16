<?php
include("../../../../connection.php");
date_default_timezone_set('Asia/Manila');
$currentDateTime = date('Y-m-d H:i:s');

session_start();
$session_acc_id = $_SESSION["acc_id"];
$account_id = $_POST['account_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    $message = $_POST['message'] ?? '';

    // Escape variables to prevent SQL injection
    $sender_id = mysqli_real_escape_string($connections, $session_acc_id);
    $receiver_id = mysqli_real_escape_string($connections, $account_id);
    $message = mysqli_real_escape_string($connections, $message);
    $currentDateTime = mysqli_real_escape_string($connections, $currentDateTime);
    $seen = 0;

    // Simple SQL query
    $sql = "INSERT INTO messages (mess_sender, mess_content, mess_reciever, mess_date, mess_seen) 
            VALUES ('$sender_id', '$message', '$receiver_id', '$currentDateTime', '$seen')";

    // Execute the query
    if (mysqli_query($connections, $sql)) {
        echo 'Data inserted successfully';
    } else {
        echo 'Error: ' . mysqli_error($connections);
    }
}
?>
