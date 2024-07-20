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
    $discount_id  = $_POST['discount_id'];
    $discount_status = $_POST['discount_status'];


    // Gumawa ng SQL query para sa pag-update ng prod_status
    $sql = "UPDATE discount SET discount_status = ? WHERE discount_id = ?";
    
     // Start user log
     date_default_timezone_set('Asia/Manila');
     $currentDateTime = date('Y-m-d H:i:s');

         $get_record = mysqli_query ($connections,"SELECT * FROM discount where discount_id ='$discount_id' ");
		$row = mysqli_fetch_assoc($get_record);
		 $db_discount_name = $row["discount_name"];
         


         if($discount_status==="1"){
            mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
            VALUES('$acc_id', 'Enabled unit: $db_discount_name', '$currentDateTime','unit','$discount_id')");
            // End user log
         }else if($discount_status==="0"){
            mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
            VALUES('$acc_id', 'Disabled unit: $db_discount_name', '$currentDateTime','unit','$discount_id')");
         }

          

    // Gumamit ng prepared statement para maiwasan ang SQL injection
    if ($stmt = $connections->prepare($sql)) {
        $stmt->bind_param("ii", $discount_status, $discount_id);
        
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
