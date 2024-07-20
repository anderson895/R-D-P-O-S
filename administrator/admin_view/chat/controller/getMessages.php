<?php
include("../.../../../../../connection.php");
// Assume na $dbConn ay ang iyong database connection
date_default_timezone_set('Asia/Manila');
session_start();

$session_acc_id=$_SESSION["acc_id"];

$query = "SELECT m.*, a.emp_image, a.acc_fname, a.acc_lname,
    (SELECT COUNT(*) FROM messages AS c WHERE c.mess_sender_id = m.mess_sender_id AND c.mess_seen != 2) AS seen_count
    FROM messages AS m
    INNER JOIN (
        SELECT mess_sender_id, MAX(mess_date) AS latest_date
        FROM messages
        GROUP BY mess_sender_id
    ) AS latest_msg
    ON m.mess_sender_id = latest_msg.mess_sender_id AND m.mess_date = latest_msg.latest_date
    LEFT JOIN account AS a ON m.mess_sender_id = a.acc_id
    WHERE m.mess_sender_id != '$session_acc_id' AND mess_reciever_id IS NULL
    GROUP BY mess_sender_id
    
    
    ";
    


$result = $connections->query($query);

$messages = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
}

// Ibalik ang resulta sa JSON format
echo json_encode($messages);

?>
