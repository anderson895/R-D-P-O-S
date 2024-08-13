<?php
include("../config/connection.php");

// Get and sanitize input
$username = htmlspecialchars($_POST['username'] ?? '', ENT_QUOTES, 'UTF-8');
$password = htmlspecialchars($_POST['password'] ?? '', ENT_QUOTES, 'UTF-8');

// Prepare the SQL query using prepared statements
$response = ['status' => 'error', 'message' => 'Query failed'];

try {
    // Assuming $conn is your MySQLi connection object
    $stmt = $conn->prepare('SELECT * FROM accounts WHERE acc_username = ? AND acc_password = ?');
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $results = $result->fetch_all(MYSQLI_ASSOC);

    // Check if any rows were returned
    if ($results) {
        $response = [
            'status' => 'success',
            'message' => 'Query successful',
            'data' => $results
        ];
    } else {
        $response = [
            'status' => 'error',
            'message' => 'No matching records found'
        ];
    }

    // Close the statement
    $stmt->close();
} catch (Exception $e) {
    // Handle any errors
    $response = [
        'status' => 'error',
        'message' => 'Database query error: ' . $e->getMessage()
    ];
}

// Set content type to JSON and output response
header('Content-Type: application/json');
echo json_encode($response);

// Close the connection
$conn->close();
?>
