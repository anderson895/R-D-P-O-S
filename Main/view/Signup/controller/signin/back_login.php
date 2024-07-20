<?php

include ("connection.php");

session_start();

if(isset($_SESSION["acc_id"])){
    $acc_id = $_SESSION["acc_id"];
    
    $get_record = mysqli_query ($connections,"SELECT * FROM account where acc_id ='$acc_id' AND acc_status ='0' ");
    $row = mysqli_fetch_assoc($get_record);
    $acc_type = $row ["acc_type"];
    
    
    if($acc_type =="customer"){
                //redirect user
                echo "<script>window.location.href='../customer/home.php'</script>";	
            }
}

$view_maintinance_query = mysqli_query($connections, "SELECT * FROM maintinance ");
$main_row = mysqli_fetch_assoc($view_maintinance_query);
$system_fb	 = $main_row["system_fb"];


$email_or_username = $password = "";
$usernameErr = $passwordErr = "";

if (isset($_POST["btnLogin"])) {
    // Validate username

      $email_or_username = $_POST["email_or_username"];

    

    // Validate password
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required!";
    } else {
        $password = $_POST["password"];
    }

    if ($email_or_username && $password) {

      $check_username = mysqli_query($connections, "SELECT * FROM account WHERE (acc_username='$email_or_username' OR acc_email='$email_or_username') AND acc_type='customer'");

        $check_username_row = mysqli_num_rows($check_username);

        if ($check_username_row > 0) 
        {
            $row = mysqli_fetch_assoc($check_username);
            $acc_id = $row["acc_id"];
            $db_password = $row["acc_password"];
            $accountype = $row["acc_type"];
            $accountstatus = $row["acc_status"];


            if($accountstatus=='0'){
                if ($password == $db_password) 
                {
                            $_SESSION["acc_id"] = $acc_id;

                            if ($accountype == "administrator") {
                                // Redirect to administrator

                                 // Redirect to customer
                                 date_default_timezone_set('Asia/Manila');
                                 $currentDateTime = date('Y-m-d g:i A');
                                 mysqli_query($connections, "INSERT INTO system_log(sys_user_id ,sys_login) 
                                 VALUES('$acc_id','$currentDateTime')");
                                echo "<script>window.location.href='../administrator/adminpages/';</script>";
                            } else if ($accountype == "delivery person") {
                                // Redirect to delivery
                                 // Redirect to customer
                                 date_default_timezone_set('Asia/Manila');
                                 $currentDateTime = date('Y-m-d g:i A');
                                 mysqli_query($connections, "INSERT INTO system_log(sys_user_id ,sys_login) 
                                 VALUES('$acc_id','$currentDateTime')");
                                echo "<script>window.location.href='../delivery/deliver.php';</script>";
                            } else {
                                // Redirect to customer
                                date_default_timezone_set('Asia/Manila');
                                $currentDateTime = date('Y-m-d g:i A');
                                mysqli_query($connections, "INSERT INTO system_log(sys_user_id ,sys_login) 
                                VALUES('$acc_id','$currentDateTime')");
                                echo "<script>window.location.href='../customer/home.php';</script>";
                            }
                } else {
                   // $passwordErr = "Incorrect password!";

                   echo '
                   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
                   <script>
                   document.addEventListener("DOMContentLoaded", function() {
                     swal({
                       title: "Error!",
                       text: "Incorrect password!",
                       icon: "error",
                       content: true // Use the "content" option instead of "html"
                     }).then((value) => {
                       if (value) {
                         window.location.href = "signin.php";
                         // Display the print receipt code here
                       } else {
                         window.location.reload();
                       }
                     });
                   });
                   </script>';
                }
            }else if($accountstatus=='1'){
                $passwordErr="Your account is disabled. Please contact the <a href='$system_fb'>Administrator</a> to activate it or create a new one. ";
            }else if($accountstatus=='2'){
                $passwordErr="This account is temporary blocked. Message the <a href='$system_fb'>Administrator</a> to Activate.";
            }
        } else {
           // $usernameErr = "Username is not registered!";

            echo '
            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
            <script>
            document.addEventListener("DOMContentLoaded", function() {
              swal({
                title: "Error!",
                text: "Username is not registered!",
                icon: "error",
                content: true // Use the "content" option instead of "html"
              }).then((value) => {
                if (value) {
                  window.location.href = "signin.php";
                  // Display the print receipt code here
                } else {
                  window.location.reload();
                }
              });
            });
            </script>';
        }
    }
}
?>
