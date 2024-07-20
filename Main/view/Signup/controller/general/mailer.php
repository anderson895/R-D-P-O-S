<?php

require '../../connection.php';
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Get the db_acc_id from the query string
if (!isset($_GET['db_acc_id'])) {
    echo "db_acc_id parameter is missing";
    exit;
}
$db_acc_id = $_GET["db_acc_id"];

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
    $product_row = mysqli_fetch_assoc($view_product_query);
    $db_acc_email = $product_row["acc_email"];
    $db_acc_fname = $product_row["acc_fname"];
    
    $db_otp = $product_row["Otp"];



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
    $mail->addAddress($db_acc_email, 'User nalang');
    $mail->addReplyTo('info@example.com', 'Information');

    // Email content
    $mail->isHTML(true);
    $mail->Subject = '
    

    Account Confirmation For Ardeleon Poultry Supplies
    
    ';
    $mail->Body = '
    <div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
    <div style="margin:50px auto;width:70%;padding:20px 0">
      <div style="border-bottom:1px solid #eee">
        <a href="" style="font-size:1.4em;color: #00466a;text-decoration:none;font-weight:600">

        </a>
        </di>
    
    
    <p style="font-size:1.1em">Dear ' . $db_acc_fname . '</p>
        
        This is your OTP from R DE LEON POULTRY SUPPLY
        It can only be used one time to confirm your account.
        
        <h2 style="background: #00466a;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;">
        ' . $db_otp . '
        </h2>
        <p style="font-size:0.9em;">
        <br>
        Thank you,
        </p>

        <hr style="border:none;border-top:1px solid #eee" />
        <div style="float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300">
          <p>'. $db_system_address.'</p>
         
        </div>
      </div>
    </div>
    ';
    $mail->AltBody = '';

    // Send the email
    $mail->send();
   
    echo "<script>    alert('OTP Sent Successfully!'); window.location.href = 'Main/verification_code.php?accid=$db_acc_id';  </script>";


} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
