<?php 
include "../../connection.php";


// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the form data
  $discount_id = $_POST['discount_id'];
  

  // Perform the database update
  $query = "UPDATE `discount` SET `discount_status` = '1' 
            WHERE `discount_id` = '$discount_id'";

  // Prepare the update statement
  if (mysqli_query($connections, $query)) {
  
   
  } else {
    echo "Error updating record: " . mysqli_error($connections);
  }
}
?>
