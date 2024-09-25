<?php
include("../../../../connection.php");

date_default_timezone_set('Asia/Manila');
session_start();

if (!isset($_SESSION["acc_id"])) {
    echo json_encode(array("error" => "Session expired"));
    exit();
}

if (!isset($_POST['searchText'])) {
    echo json_encode(array("error" => "Search text missing"));
    exit();
}

$session_acc_id=$_SESSION["acc_id"];

$searchText = $_POST['searchText'];
$likeSearchText = '%' . $searchText . '%';

// Directly embedding the variable in the query can be risky if not sanitized.
$query = "SELECT m.*, a.emp_image, a.acc_fname, a.acc_lname,
    (SELECT COUNT(*) FROM messages AS c WHERE c.mess_sender = m.mess_sender AND c.mess_seen != 2) AS seen_count
    FROM messages AS m
    INNER JOIN (
        SELECT mess_sender, MAX(mess_date) AS latest_date
        FROM messages
        GROUP BY mess_sender
    ) AS latest_msg
    ON m.mess_sender = latest_msg.mess_sender AND m.mess_date = latest_msg.latest_date
    LEFT JOIN account AS a ON m.mess_sender = a.acc_id
    WHERE a.acc_fname LIKE '$likeSearchText' AND m.mess_sender != '$session_acc_id' AND mess_reciever ='Admin'
    GROUP BY mess_sender";

$result = $connections->query($query);

$messages = array();

if ($result) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $messages[] = $row;
        }
        error_log("Messages found: " . count($messages));
    } else {
        error_log("No messages found.");
    }
} else {
    echo json_encode(array("error" => "Query execution failed", "details" => $connections->error));
    exit();
}

echo json_encode($messages);
?>
