<?php
    include 'connection.php';
    session_start(); // Start session

    if(isset($_POST["submit"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Use prepared statements to prevent SQL injection
        $query = "SELECT acc_id, acc_type FROM account WHERE acc_email = ? AND acc_password = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $acc_id = $row['acc_id'];
            $acc_type = $row['acc_type'];

            if($acc_type == 'cashier'){
                // Use the correct header redirection function
                $_SESSION['acc_id'] = $acc_id;
                header("Location: POS/pos.php");
                exit();
            }
        } else {
            $failed = true;
            header("Location: index.php?failed=true");
            exit();
        }
    }
?>
