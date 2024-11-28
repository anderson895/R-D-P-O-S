<?php
include '../config/config.php'; // Include the database configuration file
session_start(); // Start the session

if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $password = $_POST["pass"];

    // Hash the password using SHA-256
    $hashed_password = hash('sha256', $password);

    // Use prepared statements to prevent SQL injection
    $query = "SELECT acc_id, acc_type, acc_status FROM account WHERE (acc_email = ? OR acc_username = ?) AND acc_password = ?";
    $stmt = $conn->prepare($query);

    // Check if the prepared statement was successfully created
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("sss", $email, $email, $hashed_password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $acc_id = $row['acc_id'];
        $acc_type = $row['acc_type'];
        $acc_status = $row['acc_status'];

        if ($acc_status === 0) {
            // User is active, proceed with login
            $_SESSION['acc_id'] = $acc_id;

            // Redirect based on account type
            if ($acc_type == 'cashier') {
                header("Location: ../pages/pos");
            } elseif ($acc_type == 'administrator') {
                header("Location: ../../administrator/admin_view/index.php");
            } elseif ($acc_type == 'deliveryStaff') {
                header("Location: ../../rider?page=Ready For Delivery");
            } else {
                // Invalid account type
                echo "<script>alert('Login failed. Account type not recognized.')</script>";
                header("Location: ../pages/?failed=true");
            }
            exit();
        } else {
            // Account is not active
            header("Location: ../pages/?failed=true&id=" . $acc_status);
            exit();
        }

    } else {
        // Invalid credentials
        header("Location: ../pages/?failed=true");
        exit();
    }

    // Close the prepared statement
    $stmt->close();
    
    // Close the database connection
    $conn->close();
}
?>
