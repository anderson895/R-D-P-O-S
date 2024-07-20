<?php 
include("../../connection.php");

$fname = $lname = $email = $contactNo = $uname = $password = $confirmPass = $emp_image = $utype = "";
$fnameErr = $lnameErr = $emailErr = $contactNoErr = $unameErr = $passwordErr = $cunfirmPassErr = $emp_imageErr = $utypeErr = "";

if(isset($_POST["btnAddUser"])) {
    if(empty($_POST["fname"])){
        $fnameErr = "First Name is required!";
    } else {
        $fname = $_POST["fname"];
        if (preg_match('/[^\p{L}\s]/u', $fname)) {
            $fnameErr = "First Name should not include numbers or special characters!";
        }
    }

    if(empty($_POST["lname"])) {
        $lnameErr = "Last Name is required!";
    } else {
        $lname = $_POST["lname"];
        if (preg_match('/[^\p{L}\s]/u', $lname)) {
            $lnameErr = "Last Name should not include numbers or special characters!";
        }
    }

    if(empty($_POST["email"])) {
        $emailErr = "Email is required!";
    } else {
        $email = $_POST["email"];
    }

    if(empty($_POST["contactNo"])) {
        $contactNoErr = "Contact number is required!";
    } else {
        $contactNo = $_POST["contactNo"];
        if (!preg_match('/^0[0-9]{10}$/', $contactNo)) {
            $contactNoErr = "Invalid contact number!";
        }
    }

    if(empty($_POST["uname"])) {
        $unameErr = "Username is required!";
    } else {
        $uname = $_POST["uname"];
    }

    if(empty($_POST["password"])) {
        $passwordErr = "Password is required!";
    } else {
        $password = $_POST["password"];
        if (strlen($password) < 5) {
            $passwordErr = "Password should be at least 5 characters long!";
        }
    }

  

 
    if(empty($_POST["utype"])){
        
        $utypeErr="Select User Type ";

    }else{
    $utype=$_POST["utype"];
    }


    if($fname && $lname && $email && $contactNo && $uname && $password&&$utype) {
        // Check if email is already taken
        $check_email = mysqli_query($connections, "SELECT * FROM account WHERE acc_email='$email' ");
        $check_email_row = mysqli_num_rows($check_email);

        $rows = mysqli_fetch_assoc($check_email);
  

        if ($check_email_row > 0 ) {    
            
            $emailErr = "Email is already taken!";
        } else {
            // Check if username is already taken
            $check_username = mysqli_query($connections, "SELECT * FROM account WHERE acc_username='$uname'");
            $check_username_row = mysqli_num_rows($check_username);
            if ($check_username_row > 0) {
                $unameErr = "Username is already taken!";
            } else {
                // File upload handling
                if(isset($_FILES["emp_image"]) && $_FILES["emp_image"]["error"] == UPLOAD_ERR_OK) {
                    $targetDirectory = "../../upload_img/"; // Specify the directory where you want to save the uploaded image
                    $filename = basename($_FILES["emp_image"]["name"]);
                    $targetFile = $targetDirectory . $filename;

                    // Move the uploaded file to the desired location
                    if (move_uploaded_file($_FILES["emp_image"]["tmp_name"], $targetFile)) {
                        $emp_image = $filename;
                    } else {
                        $emp_imageErr = "Failed to upload the image!";
                    }
                }

                $manilaTimezone = new DateTimeZone('Asia/Manila');
                $manilaTime = new DateTime('now', $manilaTimezone);
                $currentDateTime = date('Y-m-d g:i:s A');


                mysqli_query($connections, "INSERT INTO account (acc_created, acc_username, acc_password, acc_fname, acc_lname, acc_type, acc_status, acc_email, acc_contact, emp_image) 
                    VALUES ('$currentDateTime', '$uname', '$password', '$fname', '$lname', '$utype', 'Active', '$email', '$contactNo', '$emp_image')");


////log
                $acc_id=$_POST["acc_id"];
                    date_default_timezone_set('Asia/Manila');
                    $currentDateTime = date('Y-m-d g:i A');

                mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date) 
                    VALUES('$acc_id' , 'Add $fname $lname as $utype  ', '$currentDateTime')");

            echo '
         
            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
            <script>
            document.addEventListener("DOMContentLoaded", function() {
                swal({
                    title: "Success!",
                    text: "Add User Successful",
                    icon: "success",
                    html: true
                }).then((value) => {
                    if (value) {
                        window.location.href = "manageaccount.php";
                    } else {
                        window.location.reload();
                    }
                });
            });
            </script>
            ';
        //log
                // Redirect to a success page or perform other actions
            //  echo "<script> window.location.href = 'manageaccount.php'; </script>";
            }
        }
    }
}














//another function 

$local_accid="";
if(isset($_POST["btnUpdateUser"])) {
     $local_accid=$_POST["accid"];

    if(empty($_POST["fname"])){
        $fnameErr = "First Name is required!";
    } else {
        $fname = $_POST["fname"];
        if (preg_match('/[^\p{L}\s]/u', $fname)) {
            $fnameErr = "First Name should not include numbers or special characters!";
        }
    }

    if(empty($_POST["lname"])) {
        $lnameErr = "Last Name is required!";
    } else {
        $lname = $_POST["lname"];
        if (preg_match('/[^\p{L}\s]/u', $lname)) {
            $lnameErr = "Last Name should not include numbers or special characters!";
        }
    }

    if(empty($_POST["email"])) {
        $emailErr = "Email is required!";
    } else {
        $email = $_POST["email"];
    }

    if(empty($_POST["contactNo"])) {
        $contactNoErr = "Contact number is required!";
    } else {
        $contactNo = $_POST["contactNo"];
        if (!preg_match('/^0[0-9]{10}$/', $contactNo)) {
            $contactNoErr = "Invalid contact number!";
        }
    }

    if(empty($_POST["uname"])) {
        $unameErr = "Username is required!";
    } else {
        $uname = $_POST["uname"];
    }

    if(empty($_POST["password"])) {
        $passwordErr = "Password is required!";
    } else {
        $password = $_POST["password"];
        if (strlen($password) < 5) {
            $passwordErr = "Password should be at least 5 characters long!";
        }
    }



    if(empty($_POST["utype"])) {
        $utypeErr = "Select User Type ";
    } else {
        $utype = $_POST["utype"];
    }

    if($fname && $lname && $email && $contactNo && $uname && $password && $utype) {
        $user_id = $_GET["user_id"];

        // Check if email is already taken by another user
        $check_email = mysqli_query($connections, "SELECT * FROM account WHERE acc_email='$email' AND acc_id != '$user_id'");
        $check_email_row = mysqli_num_rows($check_email);
        if ($check_email_row > 0) {
            $emailErr = "Email is already taken!";
        } else {
            // Check if username is already taken by another user
            $check_username = mysqli_query($connections, "SELECT * FROM account WHERE acc_username='$uname' AND acc_id != '$user_id'");
            $check_username_row = mysqli_num_rows($check_username);
            if ($check_username_row > 0) {
                $unameErr = "Username is already taken!";
            } else {
                // File upload handling
                if(isset($_FILES["emp_image"]) && $_FILES["emp_image"]["error"] == UPLOAD_ERR_OK) {
                    $targetDirectory = "../../upload_img/"; // Specify the directory where you want to save the uploaded image
                    $filename = basename($_FILES["emp_image"]["name"]);
                    $targetFile = $targetDirectory . $filename;

                    // Move the uploaded file to the desired location
                    if (move_uploaded_file($_FILES["emp_image"]["tmp_name"], $targetFile)) {
                        $emp_image = $filename;
                    } else {
                        $emp_imageErr = "Failed to upload the image!";
                    }
                }
                $manilaTimezone = new DateTimeZone('Asia/Manila');
                $manilaTime = new DateTime('now', $manilaTimezone);
                $currentDateTime = date('Y-m-d g:i:s A');

              // Check if the emp_image is set and not empty before updating
if (isset($emp_image) && !empty($emp_image)) {
    mysqli_query($connections, "UPDATE account SET acc_lastEdit='$currentDateTime', acc_username = '$uname', acc_password = '$password', acc_fname = '$fname', acc_lname = '$lname', acc_type = '$utype', acc_email = '$email', acc_contact = '$contactNo', emp_image = '$emp_image' WHERE acc_id = '$user_id'");
} else {
    mysqli_query($connections, "UPDATE account SET acc_lastEdit='$currentDateTime', acc_username = '$uname', acc_password = '$password', acc_fname = '$fname', acc_lname = '$lname', acc_type = '$utype', acc_email = '$email', acc_contact = '$contactNo' WHERE acc_id = '$user_id'");
}

 ////log
 date_default_timezone_set('Asia/Manila');
 $currentDateTime = date('Y-m-d g:i A');


 mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date) 
 VALUES('$local_accid', 'UPDATE USER NO $user_id:', '$currentDateTime')");
 ///end log
                // Redirect to a success page or perform other actions
                echo '
         
                <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
                <script>
                document.addEventListener("DOMContentLoaded", function() {
                    swal({
                        title: "Success!",
                        text: "Update User Successful",
                        icon: "success",
                        html: true
                    }).then((value) => {
                        if (value) {
                            window.location.href = "manageaccount.php";
                        } else {
                            window.location.reload();
                        }
                    });
                });
                </script>
                ';
            }
        }
    }
}









if(isset($_POST["btn_enable"])) {
  // Retrieve the form data
  $acc_id = $_POST['accid'];
  

  // Perform the database update
  $query = "UPDATE `account` SET `acc_status` = '0' 
            WHERE `acc_id` = '$acc_id '";

  // Prepare the update statement
  if (mysqli_query($connections, $query)) {
  
   
  } else {
    echo "Error updating record: " . mysqli_error($connections);
  }
}
?>


