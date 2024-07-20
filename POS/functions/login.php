<?php
include '../config/config.php';
session_start(); // Start session

if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $password = $_POST["pass"];

    // Hash the password using SHA-256
    $hashed_password = hash('sha256', $password);

    // Use prepared statements to prevent SQL injection
    $query = "SELECT acc_id, acc_type, acc_status FROM account WHERE (acc_email = ? OR acc_username = ?) AND acc_password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $email, $email, $hashed_password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $acc_id = $row['acc_id'];
        $acc_type = $row['acc_type'];
        $acc_status = $row['acc_status'];
        
        if($acc_status === 0) {
            if ($acc_type == 'cashier') {
                // Use the correct header redirection function
                $_SESSION['acc_id'] = $acc_id;
                header("Location: ../pages/pos");
                exit();
            } else if ($acc_type == 'administrator') {
                $_SESSION['acc_id'] = $acc_id;
                header("Location: ../../administrator/admin_view/index.php");
                exit();
            } else if ($acc_type == 'deliveryStaff') {
                $_SESSION['acc_id'] = $acc_id;
                header("Location: ../../rider?page=Ready For Delivery");
                exit();
            } else {
                echo "<script>alert('login failed')</script>";
                header("Location: ../pages/?failed=true");
                exit();
            }
        } else {
            $failed = true;
            header("Location: ../pages/?failed=true&id=".$acc_status);
            exit();
        }


        //list_order.php
    } else {
        $failed = true;
        header("Location: ../pages/?failed=true");
        exit();
    }
}
