<?php
include ("../../../connection.php");
date_default_timezone_set('Asia/Manila');

$response = array();

function generateOTP($length = 4) {
    $characters = '0123456789';
    $otp = '';
    $charLength = strlen($characters);

    for ($i = 0; $i < $length; $i++) {
        $otp .= $characters[rand(0, $charLength - 1)];
    }

    return $otp;
}

$currentDateTime = date('Y-m-d H:i:s');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Gather input data
    $fname = $_POST["fname"] ?? "";
    $lname = $_POST["lname"] ?? "";
    $bday = $_POST["bday"] ?? "";
    $email = $_POST["email"] ?? "";
    $contact = $_POST["contact"] ?? "";
    $uname = $_POST["username"] ?? "";
    $password = $_POST["cpass"] ?? "";

    if ($fname && $lname && $email && $contact && $uname && $password) {
        // Check if email is already taken
        $check_email = mysqli_query($connections, "SELECT * FROM account WHERE acc_email='$email'");
        if (mysqli_num_rows($check_email) > 0) {
            $response['response'] = 'Email is already taken';
        } else {
            // Check if username is already taken
            $check_username = mysqli_query($connections, "SELECT * FROM account WHERE acc_username='$uname'");
            if (mysqli_num_rows($check_username) > 0) {
                $response['response'] = 'Username is already taken';
            } else {
                // Prepare account creation
                $otp = generateOTP(4);
                $expirationTime = date('Y-m-d H:i:s', strtotime("+5 minutes"));

                $hashed_password = hash('sha256', $password);
                $query_account = "INSERT INTO account (acc_created, acc_username, acc_password, acc_fname, acc_lname, acc_birthday, acc_type, acc_status, acc_email, acc_contact, otp, otp_expiration) 
                                  VALUES (NOW(), '$uname', '$hashed_password', '$fname', '$lname', '$bday', 'customer', '1', '$email', '$contact', '$otp', '$expirationTime')";

                if (mysqli_query($connections, $query_account)) {
                    $last_id = mysqli_insert_id($connections);
                    // Log account creation
                    $logQuery = "INSERT INTO users_log(act_account_id, act_activity, act_date, act_table, act_collumn_id) 
                                 VALUES ('$last_id', 'Created their account: $fname $lname', '$currentDateTime', 'account', '$last_id')";
                    mysqli_query($connections, $logQuery);

                    // Send OTP email (make sure to call your mailer here)
                    // e.g., include('../mailer.php'); or call a function to send OTP

                    $response['last_id'] = $last_id;
                    $response['response'] = "success";
                } else {
                    $response['response'] = "Error: Failed to insert the user record.";
                }
            }
        }
    }

    // Return the JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
