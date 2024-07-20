<?php
session_start(); // Start the session


$get_record = mysqli_query ($connections,"SELECT * FROM maintinance");
$row = mysqli_fetch_assoc($get_record);
$db_system_name = $row ["system_name"];
$db_system_logo = $row ["system_logo"];
$db_system_banner = $row ["system_banner"];
$db_system_tax = $row ["system_tax"];
$db_system_contact = $row ["system_contact"];
$db_system_address = $row ["system_address"];


if (isset($_SESSION["acc_id"])) {
    include("../../connection.php");
    $acc_id = $_SESSION["acc_id"];
    $fullname = "";
    
  
     $stmt = $connections->prepare("SELECT * FROM account 
   LEFT JOIN user_address ON account.acc_code = user_address.user_acc_code 
   WHERE account.acc_id = ?");


    
    // Bind the parameter value
    $stmt->bind_param("s", $acc_id);
    
    // Execute the prepared statement
    $stmt->execute();
    
    // Get the result
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $db_acc_id = $row["acc_id"];
        $db_acc_fname = $row["acc_fname"];
        $db_acc_lname = $row["acc_lname"];
        $db_emp_image = $row["emp_image"];
        $db_acc_code = $row["acc_code"];
        
        $fullname = ucfirst($db_acc_fname) . " " . $db_acc_lname;
        $db_acc_contact = $row["acc_contact"];
    
        $db_acc_username = $row["acc_username"];
        $db_acc_password = $row["acc_password"];
        $db_acc_username = $row["acc_username"];
        $db_acc_type = $row["acc_type"];
        $db_acc_email = $row["acc_email"];


        $user_acc_code = $row["user_acc_code"];
        
        $user_complete_address = $row["user_complete_address"];


        if ($db_acc_type !== "administrator" && $db_acc_type !== "cashier") {
          echo "<script>window.location.href='../../new-customer-website/index.php'</script>";
        } else {
            // Ang user ay awtorisado, maaari mong ituloy ang natitirang bahagi ng iyong code dito
        }
        
        

    } 
    
    // Close the prepared statement
    $stmt->close();
} else {
    echo "<script>window.location.href='index.php';</script>";
}
?>