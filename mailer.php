<?php
print_r($_POST);
require 'connection.php';
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Get the db_acc_id from the query string
if (!isset($_POST['db_acc_id'])) {
    echo "db_acc_id parameter is missing";
    exit;
}
$db_acc_id = $_POST["db_acc_id"];

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

try {
    // Database query to fetch account details
    $view_product_query = mysqli_query($connections, "SELECT * FROM account WHERE acc_id = '$db_acc_id'");

    // Check if any account is found
    if (mysqli_num_rows($view_product_query) == 0) {
        echo "Account not found";
        exit;
    }

    // Fetch account details
    $account_row = mysqli_fetch_assoc($view_product_query);
    $db_acc_email = $account_row["acc_email"];
    $db_acc_fname = $account_row["acc_fname"];
    $db_acc_lname = $account_row["acc_lname"];
  
    $fullname = ucfirst($db_acc_fname) . " " . $db_acc_lname;
    
    $db_otp = $account_row["Otp"];


    // Slice the OTP into individual digits
    $otp_digits = str_split($db_otp);

    // Create an associative array to hold the digits
    $otp_array = [];
    foreach ($otp_digits as $index => $digit) {
        $otp_array["digit{$index}"] = $digit;
    }

    // Build the query string
    $query_string = http_build_query($otp_array);

    // Construct the URL
    $base_url = "https://rdpos.store/Main/verification_code.php?accid=295?";
    $url = $base_url . "?" . $query_string;


    $get_record = mysqli_query ($connections,"SELECT * FROM maintinance");
    $row = mysqli_fetch_assoc($get_record);
    $db_system_name = $row ["system_name"];
    $db_system_logo = $row ["system_logo"];
    $db_system_banner = $row ["system_banner"];
    $db_system_tax = $row ["system_tax"];
    $db_system_address = $row ["system_address"];
  


    // SMTP configuration
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'ardeleonpoultrysupplies@gmail.com';
    $mail->Password = 'tnsavbpnkjjwomzo';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    // Sender and recipient details
    $mail->setFrom('ardeleonpoultrysupplies@gmail.com', 'Ardeleon Poultry Supply');
    $mail->addAddress($db_acc_email, 'User');
    $mail->addReplyTo('info@example.com', 'Information');

    // Email content
    $mail->isHTML(true);
    $mail->Subject = '
    

    Account Confirmation For Ardeleon Poultry Supplies
    
    ';
    $mail->Body = '
    <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body style="font-family: Helvetica, Arial, sans-serif; margin: 0; padding: 0; background-color: #fff;">
  <table style="width: 100%; font-family: Arial, Helvetica, sans-serif; background-color: #efefef;" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center" style="padding: 1rem 0; width: 100%;">
        <table style="max-width: 600px; margin: 0 auto; text-align: left;" cellpadding="0" cellspacing="0">
          <tr>
            <td style="padding: 40px 0 0;">
              <div style="background-color: maroon; height: 70px; text-align: center;">
                <img src="https://ucarecdn.com/48afb9df-9145-434f-8512-057a498ed892/6534e356c9783.png" alt="rdpos" style="height: 75px; width: 75px;">
              </div>
              <div style="padding: 20px; background-color: #fff;">
                <h1 style="margin: 1rem 0;">Verification code</h1>
                <hr>
                <p>Please use the verification code below to confirm account:</p>
                <p>This OTP will expire in 5mins.</p><br><br>
                <div style="background-color: maroon; text-align: center;">
                  <strong style="font-size: 200%; color: #fff;">'.$db_otp.'</strong>
                </div>
                or just click here '.$url.'
                <p>Do not share this Passcode with anyone.<br><br>If you didnt request this, you can ignore this email.</p>
              </div>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>

    ';
    $mail->AltBody = '';

    // Send the email
    $mail->send();
   
  //  echo "<script>    alert('OTP Sent Successfully!'); window.location.href = 'Main/verification_code.php?accid=$db_acc_id';  </script>";


} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>
