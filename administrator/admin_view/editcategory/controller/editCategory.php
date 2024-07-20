<?php
include("../../../../connection.php");

date_default_timezone_set('Asia/Manila');
$currentDateTime = date('Y-m-d H:i:s');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $catname = mysqli_real_escape_string($connections, preg_replace('/[^0-9.,a-zA-Z\s]/', '', $_POST['catname']));
    $catdescript = mysqli_real_escape_string($connections, preg_replace('/[^0-9.,a-zA-Z\s]/', '',$_POST['catdescript']));
    $category_id = $_POST["category_id"]; 
    $acc_id = $_POST["acc_id"];

    // Retrieve existing category details
    $get_record = mysqli_query($connections, "SELECT * FROM category WHERE category_id = '$category_id'");
    $row = mysqli_fetch_assoc($get_record);
    $db_category_name = $row["category_name"];
    $db_category_description = $row["category_description"];

    // Prepare the SQL statement
    $sql = "UPDATE category SET category_name = ?, category_description = ?, category_date_edited = ? WHERE category_id = ?";

    

    
    // Use a prepared statement to update the category
    if ($stmt = $connections->prepare($sql)) {
        $stmt->bind_param("sssi", $catname, $catdescript, $currentDateTime, $category_id);


       
        

      

        //end Log the update in the user activity log 

        if ($stmt->execute()) {
            // Successful update
            echo "Category updated successfully.";


             //start Log the update in the user activity log
                $get_record = mysqli_query ($connections,"SELECT * FROM category where category_id='$category_id' ");
                $row = mysqli_fetch_assoc($get_record);
                $updated_db_category_name = $row["category_name"];
                $updated_db_category_description = $row["category_description"];


            if ($catname!=$db_category_name) {
                // Insert the activity log if there's any change
                mysqli_query($connections, "INSERT INTO users_log (act_account_id, act_activity, act_date,act_table,act_collumn_id) 
                VALUES ('$acc_id', 'category `$db_category_name` changed to `$updated_db_category_name`', '$currentDateTime','category',$category_id  )");
            }
            if ($catdescript!=$db_category_description) {
                // Insert the activity log if there's any change
                mysqli_query($connections, "INSERT INTO users_log (act_account_id, act_activity, act_date,act_table,act_collumn_id) 
                VALUES ('$acc_id', '$updated_db_category_name changed description to $updated_db_category_description', '$currentDateTime','category',$category_id  )");
            }

        } else {
            // Error handling for the prepared statement
            echo "Error updating category: " . $stmt->error;
        }

        $stmt->close();
    } else {
        // Error handling for the prepared statement
        echo "Error preparing statement: " . $connections->error;
    }
}

// Close the database connection
$connections->close();
?>
