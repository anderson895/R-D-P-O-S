<?php
echo "<pre>";
print_r($_POST);
echo "</pre>";

require 'connection.php';
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

date_default_timezone_set('Asia/Manila');
$currentDateTime = date('Y-m-d H:i:s');

$mail = new PHPMailer(true);

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $requestData = $_POST['requestData'];
        $data = json_decode($requestData, true);
        $selectedSupplier = $data['selectedSupplier'];
        $selectedEmail = $data['selectedEmail'];
        $message = $data['message'];
        $acc_id = $data['acc_id'];
        $products = $data['products'];
        $preparedDeliveryDate = $data['preparedDeliveryDate'];
        $acc_type = $data['acc_type'];
        $fullname = $data['fullname'];
        $system_contact = $data['system_contact'];
        $system_name = $data['system_name'];

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ardeleonpoultrysupplies@gmail.com';
        $mail->Password = 'tnsavbpnkjjwomzo';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        $mail->setFrom('ardeleonpoultrysupplies@gmail.com', 'Ardeleon Poultry Supply');
        $mail->addAddress($selectedEmail, 'User');
        $mail->addReplyTo('info@example.com', 'Information');

        $mail->isHTML(true);
        $mail->Subject = 'Order Request For Ardeleon Poultry Supplies';

        $emailBody = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <!-- Styles -->
            <style>
                body {
                    font-family: Arial, sans-serif;
                }
        
                .container {
                    background-color: #fff;
                    border-radius: 10px;
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                    width: 50%;
                    padding: 20px;
                }
        
                th, td {
                    padding: 10px;
                }
        
                th {
                    background-color: maroon;
                    color: #fff;
                }
        
                tr:nth-child(even) {
                    background-color: #f2f2f2;
                }
            </style>
        </head>
        <body>
            <div class="container">
              <div id="Request-header" style="background-color: maroon;">
                    <center><img src="https://ucarecdn.com/48afb9df-9145-434f-8512-057a498ed892/6534e356c9783.png" alt="rdpos" style="width: 75px; height: 75px;"></center>
                </div>
                <h1>Product Request</h1>
                <p>Dear '.$selectedSupplier.',</p>
                <p>We are interested in ordering the following product from your company:</p>
                <table>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Preferred Delivery Date</th>
                    </tr>';
        
        foreach ($products as $product) {
            $productName = $product['product'];
            $quantity = $product['quantity'];
        
            $emailBody .= '
                <tr>
                    <td>'.$productName.'</td>
                    <td>'.$quantity.'</td>
                    <td>'.$preparedDeliveryDate.'</td>
                </tr>';
        }
        
        $emailBody .= '
                    </table>
                    <p>'.$message.'</p>
                    <p>Thank you for your assistance.</p>
                    <p>Sincerely,<br>'.$fullname.'<br>'.$system_name.'</p>
                    <p>Position: '.ucfirst($acc_type).' | '.$system_contact.'</p>
                    <div class="footer">
                        <p>&copy; 2023 R. De Leon Poultry Supplies | All Rights Reserved</p>
                    </div>
                </div>
            </body>
        </html>';
        

        $mail->Body = $emailBody;

        $mail->AltBody = 'Plain text email';

        $mail->send();

        // Log the activity
        $logQuery = "INSERT INTO users_log(act_account_id, act_activity, act_date, act_table, act_collumn_id) 
                     VALUES('$acc_id', 'Request stocks from: $selectedSupplier', '$currentDateTime', 'requestSupplies', '$acc_id')";
        mysqli_query($connections, $logQuery);
    }
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
