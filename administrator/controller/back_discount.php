<?php

include("../../connection.php");

$discountName = $discountRate = "";
$discountNameErr = $discountRateErr = "";

if (isset($_POST["btn_save_discount"])) {
    if (empty($_POST["discountName"])) {
        $discountNameErr = "Discount Name is required!";
    } else {
        $discountName = $_POST["discountName"];
    }

    if (empty($_POST["discountRate"])) {
        $discountRateErr = "Discount Rate is required!";
    } elseif (!is_numeric($_POST["discountRate"])) {
        $discountRateErr = "Discount Rate must be a number!";
    } else {
        $discountRate = $_POST["discountRate"];
    }

    if ($discountName && $discountRate) {

        $check_discountName = mysqli_query($connections, "SELECT * from discount WHERE discount_name='$discountName'");
        $check_discountName_row = mysqli_num_rows($check_discountName);

        if ($check_discountName_row > 0) {
            $discountRateErr = "Discount Name already exists!";
        }else {

        $query = "INSERT INTO discount (discount_name, discount_rate, discount_status) VALUES (?, ?, '1')";
        $stmt = mysqli_prepare($connections, $query);
        mysqli_stmt_bind_param($stmt, "sd", $discountName, $discountRate);
        mysqli_stmt_execute($stmt);

        echo '
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        <script>
        document.addEventListener("DOMContentLoaded", function() {
            swal({
                title: "Success!",
                text: "Add Discount Successful",
                icon: "success",
                html: true
            }).then((value) => {
                if (value) {
                    window.location.href = "managediscount.php";
                } else {
                    window.location.reload();
                }
            });
        });
        </script>
        ';
    }
    }
}


if (isset($_POST["btn_discount_remove"])) {
    $discount_id = $_POST['discount_id'];

   
        // Perform the database update
        $query = "DELETE FROM `discount` WHERE `discount_id` = '$discount_id'";

        // Execute the delete statement
        if (mysqli_query($connections, $query)) {
            // Deletion successful
            echo '
            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
            <script>
            document.addEventListener("DOMContentLoaded", function() {
                swal({
                    title: "Success!",
                    text: "Remove Discount Success",
                    icon: "success",
                    html: true
                }).then((value) => {
                    if (value) {
                        window.location.href = "managediscount.php";
                    } else {
                        window.location.reload();
                    }
                });
            });
            </script>
            ';
        } else {
            echo "Error deleting record: " . mysqli_error($connections);
        }
    }



$discount_id = $discountName = $discountRate = "";
// Check if the request is a POST request
if (isset($_POST["btn_update_discount"])) {
  // Retrieve the form data
  $discount_id = $_POST['discount_id_update'];
  $discountName = $_POST['discount_name_update'];
  $discountRate = $_POST['discount_rate_update'];

  // Perform the database update
  $query = "UPDATE `discount` SET 
            `discount_name` = '$discountName',
            `discount_rate` = '$discountRate'
            WHERE `discount_id` = '$discount_id'";

  // Prepare the update statement
  if (mysqli_query($connections, $query)) {
    // Update successful
    echo '
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
      swal({
        title: "Success!",
        text: "Update Discount Successful",
        icon: "success",
        content: true // Use the "content" option instead of "html"
      }).then((value) => {
        if (value) {
          window.location.href = "managediscount.php";
          // Display the print receipt code here
        } else {
          window.location.reload();
        }
      });
    });
    </script>';
  } else {
    // Error occurred while updating
    echo "Error updating record: " . mysqli_error($connections);
  }
}

?>
