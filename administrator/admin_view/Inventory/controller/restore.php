<?php

include("../.../../../../../connection.php");



// Check kung may error sa koneksyon
if ($connections->connect_error) {
    die("Connection failed: " . $connections->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kunin ang product_id at prod_status mula sa AJAX request
    $prod_id = $_POST['prod_id'];
    $prod_code = $_POST['prod_code'];
    $prod_status = $_POST['prod_status'];
    $acc_id=$_POST["acc_id"];

    // Gumawa ng SQL query para sa pag-update ng prod_status
    $sql = "UPDATE product SET prod_status = ? WHERE prod_id = ?";
    
     // Start user log
     date_default_timezone_set('Asia/Manila');
     $currentDateTime = date('Y-m-d H:i:s');

         $get_record = mysqli_query ($connections,"SELECT * FROM product where prod_id='$prod_id' ");
		$row = mysqli_fetch_assoc($get_record);
		 $db_prod_name = $row["prod_name"];

            mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
            VALUES('$acc_id', 'Restore product: $db_prod_name', '$currentDateTime','product','$prod_code')");
            // End user log

    // Gumamit ng prepared statement para maiwasan ang SQL injection
    if ($stmt = $connections->prepare($sql)) {
        $stmt->bind_param("ii", $prod_status, $prod_id);
        
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
