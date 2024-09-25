<?php
include("../../../../connection.php");

date_default_timezone_set('Asia/Manila');
session_start();

if (!isset($_SESSION["acc_id"])) {
    echo json_encode(array("error" => "Session expired"));
    exit();
}

// $session_acc_id = $_SESSION["acc_id"];

if (!isset($_POST['searchText'])) {
    echo json_encode(array("error" => "Search text missing"));
    exit();
}

$searchText = $_POST['searchText'];
$likeSearchText = '%' . $searchText . '%';

$query = "SELECT m.*, a.emp_image, a.acc_username, 
    (SELECT COUNT(*) FROM messages AS c WHERE c.mess_sender = m.mess_sender AND c.mess_seen = 1) AS seen_count
    FROM messages AS m
    INNER JOIN account AS a ON m.mess_sender = a.acc_id
    WHERE a.acc_username LIKE ?";

if ($stmt = $connections->prepare($query)) {
    $stmt->bind_param("si", $likeSearchText);
    
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $messages = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $messages[] = $row;
            }
            error_log("Messages found: " . count($messages));
        } else {
            error_log("No messages found.");
        }

        echo json_encode($messages);
    } else {
        echo json_encode(array("error" => "Query execution failed", "details" => $stmt->error));
    }

    $stmt->close();
} else {
    echo json_encode(array("error" => "Failed to prepare statement", "details" => $connections->error));
}
?>
