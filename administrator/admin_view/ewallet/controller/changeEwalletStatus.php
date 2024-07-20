<?php 
print_r($_POST)
?>

<?php

include("../.../../../../../connection.php");

// Check kung may error sa koneksyon
if ($connections->connect_error) {
    die("Connection failed: " . $connections->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kunin ang product_id at prod_status mula sa AJAX request
  
    $acc_id = $_POST['acc_id'];
    $payment_id = $_POST['payment_id'];
    $payment_status = $_POST['payment_status'];


    // Gumawa ng SQL query para sa pag-update ng prod_status
    $sql = "UPDATE mode_of_payment SET payment_status = ? WHERE payment_id = ?";
    
     // Start user log
     date_default_timezone_set('Asia/Manila');
     $currentDateTime = date('Y-m-d H:i:s');

         $get_record = mysqli_query ($connections,"SELECT * FROM mode_of_payment where payment_id ='$payment_id' ");
		$row = mysqli_fetch_assoc($get_record);
		 $db_payment_name = $row["payment_name"];
         
         


         if($payment_status==="1"){
            mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
            VALUES('$acc_id', 'Enabled: $db_payment_name', '$currentDateTime','ewallet','$payment_id')");
            // End user log
         }else if($payment_status==="0"){
            mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
            VALUES('$acc_id', 'Disabled: $db_payment_name', '$currentDateTime','ewallet','$payment_id')");
         }

          

    // Gumamit ng prepared statement para maiwasan ang SQL injection
    if ($stmt = $connections->prepare($sql)) {
        $stmt->bind_param("ii", $payment_status, $payment_id);
        
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
