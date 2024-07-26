<?php
// Connect to your database
include("../../../../connection.php");

if (!$connections) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Validate and sanitize input
$account_id = isset($_POST["account_id"]) ? intval($_POST["account_id"]) : 0;
$newPassword = isset($_POST['newPassword']) ? $_POST['newPassword'] : '';

if ($account_id === 0 || empty($newPassword)) {
    die('Invalid input');
}

// Hash the new password using SHA-256
$hashedNewPassword = hash('sha256', $newPassword);

$query = "UPDATE account SET acc_password = ? WHERE acc_id = ?";
$stmt = mysqli_prepare($connections, $query);
mysqli_stmt_bind_param($stmt, 'si', $hashedNewPassword, $account_id);
if (mysqli_stmt_execute($stmt)) {
    echo 'Password updated successfully';
} else {
    echo 'Failed to update password';
}

mysqli_stmt_close($stmt);
mysqli_close($connections);
?>
