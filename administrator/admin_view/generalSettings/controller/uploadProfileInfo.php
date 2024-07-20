<?php

include("../../../../connection.php");


$acc_id=$_POST["account_id"];


print_r($_FILES);

date_default_timezone_set('Asia/Manila');
$currentDateTime = date('Y-m-d H:i:s');

$fname=$_POST["firstname"];
$lname=$_POST["lastname"];
$email=$_POST["email"];
$phone=$_POST["phone"];
$username=$_POST["username"];
$oldPasword=$_POST["oldPasword"];
$selectionAccountType=$_POST["selectionAccountType"];

$get_record = mysqli_query ($connections,"SELECT * FROM account where acc_id='$acc_id' ");
$row = mysqli_fetch_assoc($get_record);
$db_acc_username = $row["acc_username"];
$db_acc_fname = $row["acc_fname"];
$db_acc_lname = $row["acc_lname"];
$db_acc_email = $row["acc_email"];
$db_acc_contact = $row["acc_contact"];
$db_emp_image = $row["emp_image"];
$db_acc_type= $row["acc_type"];
$fullnim=ucfirst($fname)." ".ucfirst($lname);


if($_FILES){

    if ($_FILES['profileimage']['error'] === UPLOAD_ERR_OK) {
        $imagePath = '../../../../upload_img';
        $fileExtension = pathinfo($_FILES['profileimage']['name'], PATHINFO_EXTENSION);
        $uniqueFilename = uniqid() . '.' . $fileExtension;
    
        $targetFile = $imagePath . '/' . $uniqueFilename;
    
        if (is_uploaded_file($_FILES['profileimage']['tmp_name']) && move_uploaded_file($_FILES['profileimage']['tmp_name'], $targetFile)) {
            $profileimage = mysqli_real_escape_string($connections, $uniqueFilename);
    
    

// Hash the new password using SHA-256
$hashedPassword = hash('sha256', $oldPasword);

// Update the query with the hashed password
mysqli_query($connections, "UPDATE 
    account SET 
    acc_username='$username',
    acc_password='$hashedPassword',  -- Update the password with the hashed value
    acc_fname='$fname',
    acc_lname='$lname',
    acc_type='$selectionAccountType',
    acc_contact='$phone',
    emp_image='$profileimage',
    acc_lastEdit='$currentDateTime'
    WHERE acc_id='$acc_id'");

    
    
  //  mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
  //  VALUES('$acc_id', ' Update cover photo $uniqueFilename', '$currentDateTime','account','$acc_id')");
    // End user log

    if($profileimage!==$db_emp_image){
        mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
        VALUES('$acc_id', 'Update $fullnim`s Profile picture', '$currentDateTime','account','$acc_id')");
        // End user log
    }


    if($selectionAccountType!==$db_acc_type){
        mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
        VALUES('$acc_id', ' Update $fullnim`s account type from `$db_acc_type` changed to `$selectionAccountType`', '$currentDateTime','account','$acc_id')");
        // End user log
    }


  

    if($phone!==$db_acc_contact){
        mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
        VALUES('$acc_id', 'Update $fullnim`s Contact number from `$db_acc_contact` changed to `$phone`', '$currentDateTime','account','$acc_id')");
        // End user log
    }


 if($lname!==$db_acc_lname){
        mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
        VALUES('$acc_id', 'Update $fullnim`s Last name from `$db_acc_lname` changed to `$lname`', '$currentDateTime','account','$acc_id')");
        // End user log
    }


if($fname !==$db_acc_fname){
        mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
        VALUES('$acc_id', 'Update $fullnim`s First name from `$db_acc_fname` changed to `$fname`', '$currentDateTime','account','$acc_id')");
        // End user log
    }

if($username !==$db_acc_username){
    mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
    VALUES('$acc_id', 'Update $fullnim`s Username from `$db_acc_username` changed to `$username`', '$currentDateTime','account','$acc_id')");
    // End user log
}

            
        } else {
            $errorDetails = error_get_last();
            echo "Error: File upload failed - " . $errorDetails['message'];
            exit;
        }
    }



    
    
}else{

    $newPasswordHash = hash('sha256', $oldPasword);

mysqli_query($connections,"UPDATE 
    account SET 
    acc_username='$username',
    acc_password='$newPasswordHash',  -- Updated password hash
    acc_fname='$fname',
    acc_lname='$lname',
    acc_email='$email',
    acc_contact='$phone',
    acc_lastEdit='$currentDateTime'
    WHERE acc_id='$acc_id'");



      
if($selectionAccountType!==$db_acc_type){
    mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
    VALUES('$acc_id', ' Update $fullnim`s account type from $db_acc_type changed to $selectionAccountType ', '$currentDateTime','account','$acc_id')");
    // End user log
}




if($phone!==$db_acc_contact){
    mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
    VALUES('$acc_id', 'Update $fullnim`s Contact number from `$db_acc_contact` changed to `$phone`', '$currentDateTime','account','$acc_id')");
    // End user log
}


if($lname!==$db_acc_lname){
    mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
    VALUES('$acc_id', 'Update $fullnim`s Last name from $db_acc_lname changed to $lname', '$currentDateTime','account','$acc_id')");
    // End user log
}


if($fname !==$db_acc_fname){
    mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
    VALUES('$acc_id', 'Update $fullnim`s First name from $db_acc_fname changed to $fname', '$currentDateTime','account','$acc_id')");
    // End user log
}

if($username !==$db_acc_username){
mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
VALUES('$acc_id', 'Update $fullnim`s Username from $db_acc_username changed to $username', '$currentDateTime','account','$acc_id')");
// End user log
}
   
  

    

}

//header("Location: index.php");

?>