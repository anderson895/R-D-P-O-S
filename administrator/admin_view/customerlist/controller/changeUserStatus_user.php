<?php 
print_r($_POST)
?>

<?php
date_default_timezone_set('Asia/Manila');
$currentDateTime = date('Y-m-d H:i:s');

include("../.../../../../../connection.php");

// Check kung may error sa koneksyon
if ($connections->connect_error) {
    die("Connection failed: " . $connections->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kunin ang product_id at prod_status mula sa AJAX request
  
    $acc_id = $_POST['acc_id'];
    $session_id = $_POST['session_id'];
    $acc_status = $_POST['acc_status'];


    // Gumawa ng SQL query para sa pag-update ng prod_status
    $sql = "UPDATE account SET acc_status = ? WHERE acc_id = ?";
    
     // Start user log
  

         $get_record = mysqli_query ($connections,"SELECT * FROM account where acc_id ='$acc_id' ");
		$row = mysqli_fetch_assoc($get_record);
		 $db_acc_fname = $row["acc_fname"];
         $db_acc_lname = $row["acc_lname"];
         $fullname=$db_acc_fname." ".$db_acc_lname;
         


         if($acc_status==="0"){
            mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
            VALUES('$session_id', 'Enabled: $fullname account', '$currentDateTime','account','$acc_id')");
            // End user log
         }else if($acc_status==="2"){
            mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
            VALUES('$session_id', 'Disabled: $fullname account', '$currentDateTime','account','$acc_id')");
         }

          

    // Gumamit ng prepared statement para maiwasan ang SQL injection
    if ($stmt = $connections->prepare($sql)) {
        $stmt->bind_param("ii", $acc_status, $acc_id);
        
        if ($stmt->execute()) {
            // Successful update
            echo "Product status updated successfully.";
        } else {
            // Error sa pag-update
            echo "Error updating product status: " . $stmt->error;
        }

        $stmt->close();
    } else {
        // Error sa prepared statement
        echo "Error preparing statement: " . $connections->error;
    }
}

// Isara ang koneksyon sa database
$connections->close();
?>
