<?php
session_start(); // Start the session

header('Content-Type: application/json');
include 'connection.php';

// Retrieve input data (e.g., from POST request)
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($username) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Username and password are required.']);
    exit;
}

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error]));
}

// Hash the input password with SHA-256
$hashed_input_password = hash('sha256', $password);
$acc_type = 'customer';

// Prepare and execute the SQL statement
$stmt = $conn->prepare("SELECT acc_id, acc_password FROM account WHERE acc_username = ? AND acc_type = ?");
$stmt->bind_param("ss", $username, $acc_type);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $stored_hashed_password = $row['acc_password'];
    
    if ($hashed_input_password === $stored_hashed_password) {
        $_SESSION['user_id'] = $row['acc_id']; // Save user ID in session
        echo json_encode(['success' => true, 'message' => 'Login successful!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid username or password.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid username or password.']);
}

$stmt->close();
$conn->close();
?>
