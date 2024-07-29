<?php
include "../config/config.php";




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accId = $_POST['acc_id'];
    $password = $_POST['password'];

    // Query to get the stored hashed password for the given account ID
    $query = "SELECT acc_password FROM account WHERE acc_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $accId);
    $stmt->execute();
    $stmt->bind_result($storedHash);
    $stmt->fetch();
    $stmt->close();

    // Hash the provided password
    $hashedPassword = hash('sha256', $password);

    // Compare the hashed provided password with the stored hashed password
    if ($hashedPassword === $storedHash) {
        echo 'verified';
    } else {
        echo 'not verified';
    }
}
?>
