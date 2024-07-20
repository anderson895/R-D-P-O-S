<?php
include("../connection.php");
date_default_timezone_set('Asia/Manila'); // Set the timezone to Manila

// Sanitize input to prevent SQL injection
$accid = mysqli_real_escape_string($connections, $_POST['db_acc_id']);

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

// Check if the user is allowed to request a new OTP
$result = mysqli_query($connections, "SELECT otp_expiration FROM account WHERE acc_id='$accid'");

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $otpExpiration = strtotime($row['otp_expiration']);
    $currentTime = time();

    if ($otpExpiration > $currentTime) {
        $remainingTime = $otpExpiration - $currentTime;
        $remainingMinutes = ceil($remainingTime / 60);

        $response['remaining'] = $remainingMinutes; // Include remaining time in the response
        $response['result'] = "Please wait for $remainingMinutes minute(s) before requesting a new OTP.";
    } else {
        $response['result'] = "success";

        // Generate a new 4-digit OTP
        $otp = generateOTP(4);

        // Calculate the new expiration time (5 minutes from now)
        $expirationTime = date('Y-m-d H:i:s', strtotime('+5 minutes'));

        // Use prepared statements to prevent SQL injection
        $stmt = mysqli_prepare($connections, "UPDATE account SET Otp=?, otp_expiration=? WHERE acc_id=?");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sss", $otp, $expirationTime, $accid);
            $result = mysqli_stmt_execute($stmt);

            if (!$result) {
                $response['result'] = "error: Failed to update OTP";
            }

            mysqli_stmt_close($stmt);
        } else {
            $response['result'] = "error: Failed to prepare the SQL statement";
        }
    }
}

// Return the JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
