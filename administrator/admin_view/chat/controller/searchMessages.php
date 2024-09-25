<?php
include("../../../../connection.php");

$searchText = $_POST['searchText'];
date_default_timezone_set('Asia/Manila');
session_start();

// Ensure the session variable is set
if (!isset($_SESSION["acc_id"])) {
    echo json_encode(array("error" => "Session expired"));
    exit();
}

$session_acc_id = $_SESSION["acc_id"];

// Prepare the SQL query to prevent SQL injection
$query = "SELECT m.*, a.emp_image, a.acc_username, 
    (SELECT COUNT(*) FROM messages AS c WHERE c.mess_sender = m.mess_sender AND c.mess_seen = 1) AS seen_count
    FROM messages AS m
    INNER JOIN account AS a ON m.mess_sender = a.acc_id
    WHERE a.acc_username LIKE ?
    AND m.mess_reciever = ?";

// Prepare and bind
$stmt = $connections->prepare($query);
$likeSearchText = '%' . $searchText . '%';
$stmt->bind_param("si", $likeSearchText, $session_acc_id);

// Execute the query
$stmt->execute();
$result = $stmt->get_result();

$messages = array();

// Fetch the results
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
}

// Return the messages as JSON
echo json_encode($messages);

// Close the statement
$stmt->close();
?>
