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


$fname="";
$lname="";
$email="";
$contact="";
$uname="";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname=$_POST["fname"];
    $lname=$_POST["lname"];
    $bday=$_POST["bday"];
    $email=$_POST["email"];
    $contact=$_POST["contact"];
    $uname=$_POST["username"];
    $password=$_POST["cpass"];
 

   
   if( $fname && $lname && $email && $contact && $uname && $password ){

  

  
                        if ($email) {
                            $check_email = mysqli_query($connections, "SELECT * FROM account WHERE acc_email='$email'");
                            $check_email_row = mysqli_num_rows($check_email);
                
                            if ($check_email_row > 0) {
                                $response['response'] = 'Email is already taken';
                            } else {
                                if ($uname) {
                                    $check_username = mysqli_query($connections, "SELECT * FROM account WHERE acc_username='$uname'");
                                    $check_username_row = mysqli_num_rows($check_username);
                
                                    if ($check_username_row > 0) {
                                        $response['response'] = 'Username is already taken';
                                    } else {


                                        
                                        $manilaTimezone = new DateTimeZone('Asia/Manila');
                                        $manilaTime = new DateTime('now', $manilaTimezone);
                                        $manilaTimeStr = $manilaTime->format('Y-m-d H:i:s');


                                        
                                        $otp = generateOTP(4);

                                       
                                        $expirationTime = date('Y-m-d H:i:s'); 
                                        $expirationTime = date('Y-m-d H:i:s', strtotime($expirationTime) + 300); 
                                        
                                        

$hashed_password = hash('sha256', $password);

// Now you can use $hashed_password in your SQL query
$query_account = "INSERT INTO account (acc_created, acc_username, acc_password, acc_fname, acc_lname, acc_birthday, acc_type, acc_status, acc_email, acc_contact, otp, otp_expiration) 
                  VALUES ('$manilaTimeStr', '$uname', '$hashed_password', '$fname', '$lname', '$bday', 'customer', '1', '$email', '$contact', '$otp', '$expirationTime')";

                                        

                                        //    mysqli_query($connections, $query_account);
                                  

                                            if (mysqli_query($connections, $query_account)) {
                                                $last_id = mysqli_insert_id($connections);
                                                if ($last_id) {
                                                    $code = str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT);
                                                    $acc_code = sprintf("ACC%05d%02d", $code, $last_id);
                                                    $updateQuery = "UPDATE account SET acc_code = '$acc_code' WHERE acc_id = '$last_id'";
                                                    $res = mysqli_query($connections, $updateQuery);
                                

                                                    $response['last_id'] =$last_id;
                                                    $response['response'] ="success";
                                
                                            
                                                }
                                
                                                // Log the activity
                                                $logQuery = "INSERT INTO users_log(act_account_id, act_activity, act_date, act_table, act_collumn_id) 
                                                             VALUES('$last_id', 'Created their account: $fname $lname', '$currentDateTime', 'account', '$last_id')";
                                                mysqli_query($connections, $logQuery);

                                                



                                            } else {
                                                echo "Error: Failed to insert the user record.";
                                            }

                                    
                                    }
                                }
                                
                            }
                        }
                    }
               
                
             }

          // Return the JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
