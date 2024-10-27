<?php
include("../connection.php");

session_start();

if (isset($_SESSION["acc_id"])) {
    $acc_id = $_SESSION["acc_id"];

    $get_record = mysqli_query($connections, "SELECT * FROM account where acc_id ='$acc_id' AND acc_status ='0' ");
    $row = mysqli_fetch_assoc($get_record);
    $acc_type = $row["acc_type"];

    if ($acc_type == "customer") {
        //redirect user
            echo "<script>window.location.href='../new-customer-website/index.php'</script>";	
    }
}

$email_or_username = $password = "";
$usernameErr = $passwordErr = "";

if (isset($_POST["btnLogin"])) {
    // Validate username
    $email_or_username = $_POST["email_or_username"];

    // Validate password
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required!";
    } else {
        $password = $_POST["password"];
    }

    if ($email_or_username && $password) {
        $check_username = mysqli_query($connections, "SELECT * FROM account WHERE (acc_username='$email_or_username' OR acc_email='$email_or_username') AND acc_type='customer'");

        $check_username_row = mysqli_num_rows($check_username);

        if ($check_username_row > 0) {
            $row = mysqli_fetch_assoc($check_username);
            $acc_id = $row["acc_id"];
            $db_password = $row["acc_password"];
            $accountype = $row["acc_type"];
            $accountstatus = $row["acc_status"];

            if ($accountstatus == '0') {
                if (hash('sha256', $password) == $db_password) {
                    $_SESSION["acc_id"] = $acc_id;

                    if ($accountype == "administrator") {
                        // Redirect to administrator

                        header("Location: ../administrator/adminpages/");
                        exit();
                    } else if ($accountype == "delivery person") {
                        // Redirect to delivery

                        header("Location: ../delivery/deliver.php");
                        exit();
                    } else {
                        // Redirect to customer


                        header("Location: ../new-customer-website/index.php");
                        exit();
                    }
                } else {
                    // Incorrect password
                    displayError("Incorrect password!");
                }
            } elseif ($accountstatus == '1') {
                // displayError("Your account is disabled. Please contact the Administrator to activate it or create a new one.");
                header('Location: verification_code.php?accid='.$acc_id);
                exit();
            } elseif ($accountstatus == '2') {
                displayError("This account has been disabled by the administrator.");
            }
        } else {
            // Username not registered
            displayError("Username is not registered!");
        }
    }
}

// Helper function to display error using SweetAlert
function displayError($message)
{
    echo '
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        swal({
            title: "Error!",
            text: "' . $message . '",
            icon: "error",
            content: true // Use the "content" option instead of "html"
        }).then((value) => {
            if (value) {
                window.location.href = "login.php";
            } else {
                window.location.reload();
            }
        });
    });
    </script>';
}
