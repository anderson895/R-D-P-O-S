<?php

require 'connection.php';
require 'vendor/autoload.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$db_acc_id = $_POST["db_acc_id"];
//print_r($_POST);

$mail = new PHPMailer(true);


$get_record = mysqli_query ($connections,"SELECT * FROM maintinance");
$row = mysqli_fetch_assoc($get_record);
$db_system_name = $row ["system_name"];
$db_system_logo = $row ["system_logo"];
$db_system_banner = $row ["system_banner"];
$db_system_tax = $row ["system_tax"];
$db_system_address = $row ["system_address"];

$view_product_query = mysqli_query($connections, "SELECT * FROM account WHERE acc_id = '$db_acc_id'");

while ($product_row = mysqli_fetch_assoc($view_product_query)) {

    $db_acc_email = $product_row["acc_email"];
    $db_acc_fname = $product_row["acc_fname"];
    $db_otp= $product_row["Otp"];

    try {
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'smtp.gmail.com';                             //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                     //Enable SMTP authentication
        $mail->Username = 'ardeleonpoultrysupplies@gmail.com';       //SMTP username
        $mail->Password = 'tnsavbpnkjjwomzo';                        //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;             //Enable implicit TLS encryption
        $mail->Port = 465;                                          //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        $mail->setFrom('ardeleonpoultrysupplies@gmail.com', 'Ardeleon Poultry Supply');
        $mail->addAddress(''.$db_acc_email.'', 'User');     //Add a recipient
        $mail->addReplyTo('info@example.com', 'Information');

        $mail->isHTML(true);                                        //Set email format to HTML
        $mail->Subject = '
        
        Account Recovery OTP For Ardeleon Poultry Supplies
        
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
                        <p>Please use the verification code below to recovery of your account:</p>
                        <p>This OTP will expire in 5mins.</p><br><br>
                        <div style="background-color: maroon; text-align: center;">
                          <strong style="font-size: 200%; color: #fff;">'.$db_otp.'</strong>
                        </div>
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

        $mail->send();

      // echo "<script>  alert('OTP Sent Successful!'); window.location.href = 'Main/cunfirmforgot.php?accid=" . $db_acc_id . "';</script>";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

?>
