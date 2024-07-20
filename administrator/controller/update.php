<?php
include ("../../connection.php");
// update.php

if(isset($_POST['confirm'])) {
    // Get the acc_id from the form
    $acc_id = $_POST['acc_id'];

    // Perform the update query
    $update_query = mysqli_query($connections, "UPDATE account SET acc_status = '1' WHERE acc_id = '$acc_id'");

    if($update_query) {
        // Update successful
        echo "<script>window.location.href = 'manageaccount.php';</script>";
      // $acc_id;
    } else {
        // Update failed
        echo "Update failed.";
    } 
        }


        if(isset($_POST['confirmArchive'])) {
            // Get the db_prod_id from the form
            $db_prod_id  = $_POST['db_prod_id'];
        
            // Perform the update query
            $update_query = mysqli_query($connections, "UPDATE product SET prod_status = '1' WHERE prod_id = '$db_prod_id '");
        
            if($update_query) {
                echo  $db_prod_id ;
              //  echo "<script>window.location.href = 'inventory.php';</script>";
            } else {
                // Update failed
                echo "Update failed.";
            } 
                }
?>
