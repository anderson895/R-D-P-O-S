<?php
include("../../../../connection.php");

date_default_timezone_set('Asia/Manila');
session_start();

// Check if session variable is set
if (!isset($_SESSION["acc_id"])) {
    echo json_encode(array("error" => "Session expired"));
    exit();
}

// $session_acc_id = $_SESSION["acc_id"];

// Check if searchText is set and sanitize input
if (!isset($_POST['searchText'])) {
    echo json_encode(array("error" => "Search text missing"));
    exit();
}

$searchText = $_POST['searchText'];

// Prepare the SQL query to prevent SQL injection
$query = "SELECT m.*, a.emp_image, a.acc_username, 
    (SELECT COUNT(*) FROM messages AS c WHERE c.mess_sender = m.mess_sender AND c.mess_seen = 1) AS seen_count
    FROM messages AS m
    INNER JOIN account AS a ON m.mess_sender = a.acc_id
    WHERE a.acc_username LIKE ?";

// Check connection and prepare the statement
if ($stmt = $connections->prepare($query)) {
    
    // Bind parameters (searchText as string, session_acc_id as integer)
    $likeSearchText = '%' . $searchText . '%';
    $stmt->bind_param("si", $likeSearchText, $session_acc_id);

    // Execute the query
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $messages = array();

        // Fetch results
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $messages[] = $row;
            }
        }

        // Return results as JSON
        echo json_encode($messages);
    } else {
        // Query execution failed
        echo json_encode(array("error" => "Query execution failed", "details" => $stmt->error));
    }

    // Close the statement
    $stmt->close();

} else {
    // Statement preparation failed
    echo json_encode(array("error" => "Failed to prepare statement", "details" => $connections->error));
}
?>
