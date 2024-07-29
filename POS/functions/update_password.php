<?php
include "../config/config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the new password and account ID from the POST request
    $newPassword = $_POST['npsw'] ?? '';
    $acc_id = $_POST['acc_id'] ?? 0;

    // Ensure $newPassword is not empty
    if (empty($newPassword)) {
        echo 'New password cannot be empty';
        exit;
    }

    // Hash the new password using SHA-256
    $hashedPassword = hash('sha256', $newPassword);

    // Query to update the password
    $query = "UPDATE account SET acc_password = ? WHERE acc_id = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("si", $hashedPassword, $acc_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo 'PasswordUpdated';
        } else {
            echo 'Failed to update password';
        }

        $stmt->close();
    } else {
        echo 'Failed to prepare SQL statement';
    }
}
?>
