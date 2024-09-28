<?php
$accid = $_GET['accid'];
$EnterOtp = '';
$EnterOtpErr = '';
$incorrectAttempts = 0; // Bilang ng maling pagtatangka ng OTP
$countdown=0;
// Limitasyon ng bilang ng maling pagtatangka
$limit1 = 4; // 4 times - 30 seconds
$limit2 = 8; // 8 times - 1 hour
$limit3 = 16; // 16 times - 2 hours

$view_product_query = mysqli_query($connections, "SELECT * FROM account WHERE acc_id = '$accid'");
$product_row = mysqli_fetch_assoc($view_product_query);

if ($product_row) {
    $db_acc_id = $product_row["acc_id"];
    $db_acc_email = $product_row["acc_email"];
    $db_acc_otp = $product_row["Otp"];
    $incorrectAttempts = $product_row["incorrect_attempts"]; // Mga maling pagtatangka ng OTP

    $otp_expiration = $product_row["otp_expiration"];
    
}
if (isset($_POST['btnSendOtp'])) {
    $code1 = $_POST['code1'];
    $code2 = $_POST['code2'];
    $code3 = $_POST['code3'];
    $code4 = $_POST['code4'];
    $EnterOtp  = $code1 . $code2 . $code3 . $code4;

    if (strtotime($otp_expiration) >= time()) {
        // Check if the OTP is not expired
        if ($EnterOtp == $db_acc_otp) {
            // Tama ang OTP, reset ng mga maling pagtatangka
         //   mysqli_query($connections, "UPDATE account SET acc_status='0', Otp='0', incorrect_attempts='0' WHERE acc_id='$db_acc_id'");
            mysqli_query($connections, "UPDATE account SET Otp='0', incorrect_attempts='0' WHERE acc_id='$db_acc_id'");
            echo '<script> document.location.href = "terms-and-condition.php?accid=' . $accid . '"; </script>';

                
             // Log the activity
             date_default_timezone_set('Asia/Manila');
             $currentDateTime = date('Y-m-d H:i:s');

             $logQuery = "INSERT INTO users_log(act_account_id, act_activity, act_date, act_table, act_collumn_id) 
             VALUES('$db_acc_id', 'Successfully verified their account', '$currentDateTime', 'account', '$db_acc_id')";
               mysqli_query($connections, $logQuery);

        } else {
            $incorrectAttempts++; // Dagdag ng maling pagtatangka ng OTP

            // Pag-update ng bilang ng maling pagtatangka sa database
            mysqli_query($connections, "UPDATE account SET incorrect_attempts='$incorrectAttempts' WHERE acc_id='$db_acc_id'");

            if ($incorrectAttempts >= $limit1 && $incorrectAttempts < $limit2) {
                // Maling pagtatangka ng OTP nasa limit 1, i-hide ang button send at resend
                echo "<script>document.getElementById('btnSendOtp').style.display = 'none'; document.getElementById('resendLink').style.display = 'none';</script>";
                
                     echo "<script>alert('Incorrect Otp');</script>";
                $countdown = 30; // Bilang ng segundo para sa susunod na pagtatangka
                $EnterOtpErr = 'Incorrect otp Please wait for <span id="countdown">' . $countdown . '</span> seconds before trying again.';
            } elseif ($incorrectAttempts >= $limit2 && $incorrectAttempts < $limit3) {
                // Maling pagtatangka ng OTP nasa limit 2, i-hide ang button send at resend
                echo "<script>alert('Incorrect Otp');</script>";
                echo "<script>document.getElementById('btnSendOtp').style.display = 'none'; document.getElementById('resendLink').style.display = 'none';</script>";
                $countdown = 60; // Bilang ng segundo para sa susunod na pagtatangka
                $EnterOtpErr = 'Incorrect otp Please wait for <span id="countdown">' . gmdate("H:i:s", $countdown) . '</span> before trying again.';
            } elseif ($incorrectAttempts >= $limit3) {
                echo "<script>alert('Incorrect Otp');</script>";
                // Maling pagtatangka ng OTP nasa limit 3, i-hide ang button send at resend
                echo "<script>document.getElementById('btnSendOtp').style.display = 'none'; document.getElementById('resendLink').style.display = 'none';</script>";
                $countdown = 7200; // 2 hours Bilang ng segundo para sa susunod na pagtatangka
                $EnterOtpErr = 'Incorrect otp Please wait for <span id="countdown">' . gmdate("H:i:s", $countdown) . '</span> before trying again.';
                mysqli_query($connections, "UPDATE account SET acc_status='2' WHERE acc_id='$db_acc_id'");
                 // Log the activity
                 date_default_timezone_set('Asia/Manila');
                 $currentDateTime = date('Y-m-d H:i:s');
                 $logQuery = "INSERT INTO users_log(act_account_id, act_activity, act_date, act_table, act_collumn_id) 
                 VALUES('$db_acc_id', 'Too many incorrect otp attempt in their account causing temporary blocked', '$currentDateTime', 'account', '$db_acc_id')";
                   mysqli_query($connections, $logQuery);
            } else {
                 echo "<script>alert('Incorrect Otp');</script>";
                // Ipinapakita ang button send at resend
                $countdown = 0; // Walang countdown
                $EnterOtpErr = 'Incorrect otp';
            }

            echo "<script>startCountdown($countdown);</script>";
            echo "<script>document.getElementById('btnSendOtp').style.display = 'none'; document.getElementById('resendLink').style.display = 'none';</script>";
        }
    } else {
        // OTP is expired, you can handle this case here
        // For example, display an error message or redirect the user
          $EnterOtpErr ="Otp has expired. Please request a new one.";
    }
}

?>



<!-- Display countdown -->
