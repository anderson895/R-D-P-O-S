<?php
include("../.../../../../../connection.php");

$searchText = $_POST['searchText'];
date_default_timezone_set('Asia/Manila');
session_start();
$session_acc_id = $_SESSION["acc_id"];

$query = "SELECT * FROM messages AS m
    INNER JOIN account AS a ON m.mess_sender = a.acc_id
    WHERE ( a.acc_username LIKE '%$searchText%')
    AND m.mess_reciever = '$session_acc_id'
    ";

$result = $connections->query($query);

$messages = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
}

echo json_encode($messages);
?>
