<?php
include("../connection.php");

// Ensure accid is provided in the request
if (!isset($_GET['accid'])) {
    exit("Account ID is missing.");
}

$accid = $_GET['accid'];
$EnterOtp = '';
$EnterOtpErr = '';
$incorrectAttempts = 0; 
$countdown = 0;

$limit1 = 4; // 4 attempts - 30 seconds lock
$limit2 = 8; // 8 attempts - 1 hour lock
$limit3 = 16; // 16 attempts - 2 hours lock

// Fetch account data
$view_product_query = mysqli_query($connections, "SELECT * FROM account WHERE acc_id = '$accid'");
$product_row = mysqli_fetch_assoc($view_product_query);

if ($product_row) {
    $db_acc_id = $product_row["acc_id"];
    $db_acc_email = $product_row["acc_email"];
    $db_acc_otp = $product_row["Otp"];
    $incorrectAttempts = $product_row["incorrect_attempts"]; 
    $otp_expiration = $product_row["otp_expiration"];
}

if (isset($_POST['btnSendOtp'])) {
    $code1 = $_POST['code1'];
    $code2 = $_POST['code2'];
    $code3 = $_POST['code3'];
    $code4 = $_POST['code4'];
    $EnterOtp = $code1 . $code2 . $code3 . $code4;

    if (strtotime($otp_expiration) >= time()) {
        if ($EnterOtp == $db_acc_otp) {
            mysqli_query($connections, "UPDATE account SET Otp='0', incorrect_attempts='0' WHERE acc_id='$db_acc_id'");
            echo '<script> document.location.href = "terms-and-condition.php?accid=' . $accid . '"; </script>';
            
            date_default_timezone_set('Asia/Manila');
            $currentDateTime = date('Y-m-d H:i:s');

            $logQuery = "INSERT INTO users_log(act_account_id, act_activity, act_date, act_table, act_collumn_id) 
            VALUES('$db_acc_id', 'Successfully verified their account', '$currentDateTime', 'account', '$db_acc_id')";
            mysqli_query($connections, $logQuery);
        } else {
            $incorrectAttempts++;
            mysqli_query($connections, "UPDATE account SET incorrect_attempts='$incorrectAttempts' WHERE acc_id='$db_acc_id'");

            if ($incorrectAttempts >= $limit1 && $incorrectAttempts < $limit2) {
                $countdown = 30; 
                $EnterOtpErr = 'Incorrect OTP. Please wait for <span id="countdown">' . $countdown . '</span> seconds before trying again.';
            } elseif ($incorrectAttempts >= $limit2 && $incorrectAttempts < $limit3) {
                $countdown = 60; 
                $EnterOtpErr = 'Incorrect OTP. Please wait for <span id="countdown">' . gmdate("H:i:s", $countdown) . '</span> before trying again.';
            } elseif ($incorrectAttempts >= $limit3) {
                $countdown = 7200; 
                $EnterOtpErr = 'Incorrect OTP. Please wait for <span id="countdown">' . gmdate("H:i:s", $countdown) . '</span> before trying again.';
                mysqli_query($connections, "UPDATE account SET acc_status='2' WHERE acc_id='$db_acc_id'");

                $logQuery = "INSERT INTO users_log(act_account_id, act_activity, act_date, act_table, act_collumn_id) 
                VALUES('$db_acc_id', 'Too many incorrect OTP attempts causing temporary block', '$currentDateTime', 'account', '$db_acc_id')";
                mysqli_query($connections, $logQuery);
            } else {
                $countdown = 0; 
                $EnterOtpErr = 'Incorrect OTP';
            }

            echo "<script>startCountdown($countdown);</script>";
            echo "<script>alertify.error('$EnterOtpErr');</script>";
        }
    } else {
        $EnterOtpErr = "OTP has expired. Please request a new one.";
        echo "<script>alertify.error('$EnterOtpErr');</script>";
    }
}
?>

<script>
// JavaScript countdown function
function startCountdown(seconds) {
    let countdownElement = document.getElementById('countdown');
    let remainingTime = seconds;

    let interval = setInterval(() => {
        if (remainingTime <= 0) {
            clearInterval(interval);
            countdownElement.innerHTML = "0"; // Reset countdown display
            document.getElementById('btnSendOtp').style.display = 'block'; // Show button again
            document.getElementById('resendLink').style.display = 'block'; // Show resend link
        } else {
            countdownElement.innerHTML = remainingTime;
            remainingTime--;
        }
    }, 1000);
}
</script>
