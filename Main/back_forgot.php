<?php
include "../connection.php";
session_start();

$response = array(); // Initialize the response array
date_default_timezone_set('Asia/Manila'); // Set the timezone to Manila

function generateOTP($length = 4) {
    $characters = '0123456789';
    $otp = '';
    $charLength = strlen($characters);

    for ($i = 0; $i < $length; $i++) {
        $otp .= $characters[rand(0, $charLength - 1)];
    }

    return $otp;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    if (empty($_POST["email"])) {
        $response['result'] = "Email is required!";
    } else {
        $email = $_POST["email"];

        // Query the database to check if the email exists
        $check_email = mysqli_query($connections, "SELECT * FROM account WHERE acc_email='$email' AND acc_type='customer'");
        $check_email_row = mysqli_num_rows($check_email);

        if ($check_email_row > 0) {
            // Retrieve the account details
            $account_details = mysqli_fetch_assoc($check_email);
            $lastOTPUpdateTime = strtotime($account_details['otp_expiration']);

            $currentTime = time();
            $timeDifference = $lastOTPUpdateTime - $currentTime;

            if ($timeDifference > 0) {
                // Calculate the remaining time before a new OTP can be generated
                $response['result'] = "waiting";
                $response['remaining'] = "Please wait for " . ceil($timeDifference / 60) . " minute(s) before requesting a new OTP.";
                $response['db_acc_id'] = "hindi mahanap";
            } else {
                $manilaTimezone = new DateTimeZone('Asia/Manila');
                $manilaTime = new DateTime('now', $manilaTimezone);

                // Generate a 6-digit OTP
                $otp = generateOTP(4);
                $expirationTime = date('Y-m-d H:i:s', strtotime('+5 minutes'));

                // Update the OTP in the database for the corresponding email
                $query = "UPDATE account SET Otp = '$otp', otp_expiration='$expirationTime' WHERE acc_email = '$email'";
                mysqli_query($connections, $query);

                // Retrieve the account ID associated with the OTP
                $get_recordAccount = mysqli_query($connections, "SELECT * FROM account WHERE Otp='$otp'");
                $row = mysqli_fetch_assoc($get_recordAccount);

                // Prepare the response
                $response['result'] = "success";
                $response['db_acc_id'] = $row["acc_id"];
            }
        } else {
            $response['result'] = "Email is not registered!";
            $response['db_acc_id'] = "hindi mahanap";
        }
    }

    // Output the response as JSON
    echo json_encode($response);

    // Terminate the script immediately after sending JSON
    exit();
}







$newpsw=$cunfirm_newpsw="";
$newpswErr=$cunfirm_newpswErr="";
if(isset($_POST["btnNewPassword"])){
    $accid=$_GET["accid"];
    if(empty($_POST["newpsw"])){

        $newpswErr="New Password is Required !";

    }else{
        $newpsw =$_POST["newpsw"];
    }
//cunfirm password
    if(empty($_POST["cunfirm_newpsw"])){

        $cunfirm_newpswErr="Cunfirm Password is Required !";

    }else{
        $cunfirm_newpsw =$_POST["cunfirm_newpsw"];
    }

    if($newpsw && $cunfirm_newpsw ){

       

        if (strlen($newpsw) > 4) {

        if ($newpsw == $cunfirm_newpsw) 
        {
        $_SESSION["acc_id"] = $accid;

       
                
                date_default_timezone_set('Asia/Manila');
                $currentDateTime = date('Y-m-d g:i A');

                mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date) 
                VALUES('$accid', 'RECOVER ACCOUNT', '$currentDateTime')");

                $get_recordAccount = mysqli_query ($connections,"SELECT * FROM account where acc_id='$accid' ");
                $row = mysqli_fetch_assoc($get_recordAccount);
                $db_Otp = $row["Otp"];

                $hashedPassword = hash('sha256', $newpsw);
                $stmt = mysqli_prepare($connections, "UPDATE account SET acc_password = ? WHERE acc_id = ?");
                mysqli_stmt_bind_param($stmt, 'si', $hashedPassword, $accid);
                
                if(mysqli_stmt_execute($stmt)) {
                    
                      echo "<script>  alert('success');  </script>";

                } else {
                    echo "Error updating password: " . mysqli_error($connections);
                }
        

                mysqli_query($connections, "UPDATE account SET Otp='' WHERE acc_id='$accid'");
                
                $_SESSION["acc_id"] = $accid;
              
                echo "<script>  window.location.href = '../new-customer-website/index.php';   </script>";

                }else{
                $cunfirm_newpswErr="Password doesn't match"; 
                echo "
                <script>
                alertify.error('Email is not registered!');
                </script>
                ";  
                }
            
        }else{
            $cunfirm_newpswErr="Password is too short";   
        }
    }
}

?>
