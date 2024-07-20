<?php

include "../../connection.php";

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the form data
  $voucher_id = $_POST['voucher_id'];
  $voucher_name = $_POST['voucherName'];
  $voucher_discount = $_POST['discountRate'];
  $voucher_expiration = $_POST['dateExpire'];
  $voucher_maximumLimit = $_POST['maximumLimit'];

  // Perform the database update
  $query = "UPDATE `voucher` SET 
            `voucher_name` = '$voucher_name',
            `voucher_discount` = '$voucher_discount',
            `voucher_expiration` = '$voucher_expiration',
            `voucher_maximumLimit` = '$voucher_maximumLimit' 
            WHERE `voucher_id` = '$voucher_id'";

  // Prepare the update statement
  if (mysqli_query($connections, $query)) {
  
   echo '
   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
   <script>
       swal({
           title: "Success!",
           text: "Voucher Updated ",
           icon: "success",
           html: true
       }).then((value) => {
           if (value) {
               window.location.href = "managevoucher.php";
             
           
           } else {
               window.location.reload();
           }
       });
   </script>
   ';
  } else {
    echo "Error updating record: " . mysqli_error($connections);
  }
}
?>
