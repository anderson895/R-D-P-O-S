<?php

include("../.../../../../../connection.php");



// Check kung may error sa koneksyon
if ($connections->connect_error) {
    die("Connection failed: " . $connections->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kunin ang product_id at prod_status mula sa AJAX request
    $db_acc_id = $_POST['db_acc_id'];
    $spl_id = $_POST['spl_id'];
    $spl_status = $_POST['spl_status'];


    // Gumawa ng SQL query para sa pag-update ng prod_status
    $sql = "UPDATE supplier SET spl_status = ? WHERE spl_id = ?";
    
     // Start user log
     date_default_timezone_set('Asia/Manila');
     $currentDateTime = date('Y-m-d H:i:s');

         $get_record = mysqli_query ($connections,"SELECT * FROM supplier where spl_id ='$spl_id' ");
		$row = mysqli_fetch_assoc($get_record);
		 $db_spl_name = $row["spl_name"];

            mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
            VALUES('$db_acc_id', 'Remove `$db_spl_name` as supplier', '$currentDateTime','supplier','$spl_id')");
            // End user log

    // Gumamit ng prepared statement para maiwasan ang SQL injection
    if ($stmt = $connections->prepare($sql)) {
        $stmt->bind_param("ii", $spl_status, $spl_id);
        
        if ($stmt->execute()) {
            // Successful update
            echo "Supplier status updated successfully.";
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
