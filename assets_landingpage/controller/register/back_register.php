<?php 
include ("../connection.php");

function generateOTP($length = 4) {
    $characters = '0123456789';
    $otp = '';
    $charLength = strlen($characters);

    for ($i = 0; $i < $length; $i++) {
        $otp .= $characters[rand(0, $charLength - 1)];
    }

    return $otp;
}


$fname="";
$lname="";
$email="";
$contact="";
$uname="";
$streetDescription="";
$region = "";
$province = "";
$city = "";
$barangay = "";

// Fetch the JSON data from the API endpoints
$regionData = file_get_contents('../ph-json/region.json');
$provinceData = file_get_contents('../ph-json/province.json');
$cityData = file_get_contents('../ph-json/city.json');
$barangayData = file_get_contents('../ph-json/barangay.json');

// Decode the JSON data
$regionData = json_decode($regionData, true);
$provinceData = json_decode($provinceData, true);
$cityData = json_decode($cityData, true);
$barangayData = json_decode($barangayData, true);

$completeAddress="";
$regionId="";
if (isset($_POST["btn_register"])) {
    $fname=$_POST["fname"];
    $lname=$_POST["lname"];
    $bday=$_POST["bday"];
    $email=$_POST["email"];
    $contact=$_POST["contact"];
    $streetDescription=$_POST["streetDescription"];
    $uname=$_POST["username"];
    $password=$_POST["password"];
 

    $regionId = $_POST["region"];
    $provinceId = $_POST["province"];
    $cityId = $_POST["city"];
    $barangayId = $_POST["barangay"];

    // Find the names based on the selected IDs
    foreach ($regionData['data'] as $item) {
        if ($item['region_code'] === $regionId) {
            $region = $item['region_name'];
        }
    }
    foreach ($provinceData['data'] as $item) {
        if ($item['province_code'] === $provinceId) {
            $province = $item['province_name'];
        }
    }
    foreach ($cityData['data'] as $item) {
        if ($item['city_code'] === $cityId) {
            $city = $item['city_name'];
        }
    }
    foreach ($barangayData['data'] as $item) {
        if ($item['brgy_code'] === $barangayId) {
            $barangay = $item['brgy_name'];
        }
    }
    $completeAddress= $region." ".$province." ".$city." ".$barangay." ".$streetDescription;
   
   if( $fname && $lname && $email && $contact && $uname && $password && $completeAddress){

  

  
                        if ($email) {
                            $check_email = mysqli_query($connections, "SELECT * FROM account WHERE acc_email='$email'");
                            $check_email_row = mysqli_num_rows($check_email);
                
                            if ($check_email_row > 0) {
                                echo "<script>alert('Email is already taken!')</script>";
                            } else {
                                if ($uname) {
                                    $check_username = mysqli_query($connections, "SELECT * FROM account WHERE acc_username='$uname'");
                                    $check_username_row = mysqli_num_rows($check_username);
                
                                    if ($check_username_row > 0) {
                                        echo "<script>alert('Username is already taken!')</script>";
                                    } else {


                                        
                                        $manilaTimezone = new DateTimeZone('Asia/Manila');
                                        $manilaTime = new DateTime('now', $manilaTimezone);
                                        $manilaTimeStr = $manilaTime->format('Y-m-d H:i:s');


                                        
                                        $otp = generateOTP(4);

                                       
                                        // Calculate the expiration time (3 minutes from now)
                                        $expirationTime = date('Y-m-d H:i:s'); // Kunin ang kasalukuyang petsa at oras
                                        $expirationTime = date('Y-m-d H:i:s', strtotime($expirationTime) + 180); // Magdagdag ng 180 segundo (3 minuto)
                                        

                                        // Insert the OTP and expiration time into the database
                                        $query_account = "INSERT INTO account (acc_created, acc_username, acc_password, acc_fname, acc_lname, acc_birthday, acc_type, acc_status, acc_email, acc_contact, otp, otp_expiration) 
                                                VALUES ('$manilaTimeStr', '$uname', '$password', '$fname', '$lname', '$bday', 'customer', '1', '$email', '$contact', '$otp', '$expirationTime')";
                                        

                                            mysqli_query($connections, $query_account);
                                  

                                          $last_id=mysqli_insert_id($connections);
                                          if($last_id){
                                              $code=rand(1,99999);
                                              $acc_code="".$code."".$last_id;
                                              $query="UPDATE account SET acc_code='".$acc_code."' WHERE acc_id ='".$last_id."' ";
                                              $res=mysqli_query($connections,$query);
  

                                              $query_address = "INSERT INTO user_address (user_acc_code, user_region_code,user_region_name, user_complete_address,user_active_status,user_add_display_status,user_add_Default_status) 
                                              VALUES ('$acc_code','$regionId', '$region', '$completeAddress','1','1','1')";
                                              mysqli_query($connections, $query_address);
  
                                          }

                                            $get_recordAccount = mysqli_query ($connections,"SELECT * FROM account where acc_email='$email' ");
                                            $row = mysqli_fetch_assoc($get_recordAccount);
                                            $db_acc_id = $row["acc_id"];

                                            // start user log
                                            date_default_timezone_set('Asia/Manila');
                                            $currentDateTime = date('Y-m-d g:i A');
                                            mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date) 
                                            VALUES('$db_acc_id', 'CREATE ACCOUNT', '$currentDateTime')");
                                            //end user log
                                            
                                       echo "<script>  window.location.href = '../mailer.php?db_acc_id=".$db_acc_id."'; </script>";
                                   exit();
                                    }
                                }
                                
                            }
                        }
                    }
               
                
             }




?>
