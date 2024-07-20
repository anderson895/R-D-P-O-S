<?php

include("../.../../../../../connection.php");



// Check kung may error sa koneksyon
if ($connections->connect_error) {
    die("Connection failed: " . $connections->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kunin ang product_id at prod_status mula sa AJAX request
    $unit_id = $_POST['unit_id'];
    $acc_id = $_POST['acc_id'];
    $unit_status = $_POST['unit_status'];


    // Gumawa ng SQL query para sa pag-update ng prod_status
    $sql = "UPDATE unit SET unit_status = ? WHERE unit_id = ?";
    
     // Start user log
     date_default_timezone_set('Asia/Manila');
     $currentDateTime = date('Y-m-d H:i:s');

         $get_record = mysqli_query ($connections,"SELECT * FROM unit where unit_id ='$unit_id' ");
		$row = mysqli_fetch_assoc($get_record);
		 $db_unit_name = $row["unit_name"];

            mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
            VALUES('$acc_id', 'Remove unit: $db_unit_name', '$currentDateTime','unit','$unit_id')");
            // End user log

    // Gumamit ng prepared statement para maiwasan ang SQL injection
    if ($stmt = $connections->prepare($sql)) {
        $stmt->bind_param("ii", $unit_status, $unit_id);
        
        if ($stmt->execute()) {
            // Successful update
            echo "unit status updated successfully.";
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
