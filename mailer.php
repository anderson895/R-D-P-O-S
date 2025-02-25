<?php
require 'connection.php';
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Get the db_acc_id from the query string
if (!isset($_POST['db_acc_id'])) {
    echo json_encode(["error" => "db_acc_id parameter is missing"]);
    exit;
}
$db_acc_id = $_POST["db_acc_id"];

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

try {
    // Prepare statement to fetch account details
    $stmt = $connections->prepare("SELECT * FROM account WHERE acc_id = ?");
    $stmt->bind_param("s", $db_acc_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any account is found
    if ($result->num_rows == 0) {
        echo json_encode(["error" => "Account not found"]);
        exit;
    }

    // Fetch account details
    $account_row = $result->fetch_assoc();
    $db_acc_email = $account_row["acc_email"];
    $db_acc_fname = $account_row["acc_fname"];
    $db_acc_lname = $account_row["acc_lname"];
    
    $fullname = ucfirst($db_acc_fname) . " " . $db_acc_lname;
    
    $db_otp = $account_row["Otp"];

    // Fetch system maintenance records
    $get_record = mysqli_query($connections, "SELECT * FROM maintinance LIMIT 1");
    $row = mysqli_fetch_assoc($get_record);
    $db_system_name = $row["system_name"];
    $db_system_logo = $row["system_logo"];
    $db_system_banner = $row["system_banner"];
    $db_system_tax = $row["system_tax"];
    $db_system_address = $row["system_address"];

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
    $mail->addAddress($db_acc_email, $fullname);
    $mail->addReplyTo('ardeleonpoultrysupplies@gmail.com', 'Information');

    // Email content
    $mail->isHTML(true);
    $mail->Subject = 'Account Confirmation For Ardeleon Poultry Supplies';
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
                    <p>Please use the verification code below to confirm your account:</p>
                    <p>This OTP will expire in 5 minutes.</p><br><br>
                    <div style="background-color: maroon; text-align: center;">
                      <strong style="font-size: 200%; color: #fff;">'.$db_otp.'</strong>
                    </div>
                    <br>
                    Or just click here <a href="https://rdpos.store/Main/verification_code.php?accid='.$db_acc_id.'&otp='.$db_otp.'">Verify your account</a>
                    <p>Do not share this Passcode with anyone.<br><br>If you didn\'t request this, you can ignore this email.</p>
                  </div>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </body>
    </html>';

    $mail->AltBody = '';

    // Send the email
    $mail->send();
    echo json_encode(["success" => "OTPSentSuccessfully"]);
} catch (Exception $e) {
    echo json_encode(["error" => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"]);
}
?>
