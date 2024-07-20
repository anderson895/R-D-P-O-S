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
  
    $prod_id = $_POST['prod_id'];
    $acc_id = $_POST['acc_id'];
    $prod_status = $_POST['prod_status'];


    // Gumawa ng SQL query para sa pag-update ng prod_status
    $sql = "UPDATE product SET prod_status = ? WHERE prod_id = ?";
    
     // Start user log
     date_default_timezone_set('Asia/Manila');
     $currentDateTime = date('Y-m-d H:i:s');

         $get_record = mysqli_query ($connections,"SELECT * FROM product where prod_id ='$prod_id' ");
		$row = mysqli_fetch_assoc($get_record);
		 $db_prod_id = $row["prod_id"];
         $db_prod_code = $row["prod_code"];
         $db_prod_name = $row["prod_name"];
      
         


         if($prod_status==="0"){
            mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
            VALUES('$acc_id', 'Enabled product: `$db_prod_name`', '$currentDateTime','product','$db_prod_code')");
            // End user log
         }else if($prod_status==="1"){
            mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
            VALUES('$acc_id', 'Disabled product: `$db_prod_name`', '$currentDateTime','product','$db_prod_code')");
         }

          

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
