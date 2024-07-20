<?php 
include "../../connection.php";
$acc_id=$_POST["acc_id"];
$db_prod_id = $_POST["db_prod_id"];
$db_prod_name=$_POST["db_prod_name"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Check if the confirmation form is submitted
//if (isset($_POST["btnArchive"])) {
    // Update the prod_status column
    $sql = "UPDATE product SET prod_status = 1 WHERE prod_id = '$db_prod_id'";

    
     ////log
     date_default_timezone_set('Asia/Manila');
     $currentDateTime = date('Y-m-d g:i A');

     mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date) 
     VALUES('$acc_id', 'ARCHIVE PRODUCT:$db_prod_name', '$currentDateTime')");
     //log

    if (mysqli_query($connections, $sql)) {
        echo '
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        <script>
            swal({
                title: "Success!",
                text: "ARCHIVE PRODUCT SUCCESS",
                icon: "success",
                html: true
            }).then((value) => {
                if (value) {
                    window.location.href = "inventory.php";
                } else {
                    window.location.reload();
                }
            });
        </script>
    ';
    } else {
        echo "Error updating prod_status: " . mysqli_error($connections);
    }
    exit; // Terminate the script after updating the prod_status
//}

}


?>


