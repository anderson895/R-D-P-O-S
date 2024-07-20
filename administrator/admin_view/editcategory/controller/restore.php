<?php

include("../.../../../../../connection.php");



// Check kung may error sa koneksyon
if ($connections->connect_error) {
    die("Connection failed: " . $connections->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kunin ang product_id at prod_status mula sa AJAX request
    $cat_id = $_POST['cat_id'];
    $acc_id = $_POST['acc_id'];
    $category_status = $_POST['category_status'];


    // Gumawa ng SQL query para sa pag-update ng prod_status
    $sql = "UPDATE category SET category_status = ? WHERE category_id = ?";
    
     // Start user log
     date_default_timezone_set('Asia/Manila');
     $currentDateTime = date('Y-m-d H:i:s');

         $get_record = mysqli_query ($connections,"SELECT * FROM category where category_id ='$cat_id' ");
		$row = mysqli_fetch_assoc($get_record);
		 $db_category_name = $row["category_name"];

            mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
            VALUES('$acc_id', 'Restore category: $db_category_name', '$currentDateTime','category','$cat_id')");
            // End user log

    // Gumamit ng prepared statement para maiwasan ang SQL injection
    if ($stmt = $connections->prepare($sql)) {
        $stmt->bind_param("ii", $category_status, $cat_id);
        
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
