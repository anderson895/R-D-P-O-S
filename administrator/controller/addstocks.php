<?php
include "../../connection.php";


$quantity = $db_prod_id_add = $prod_expiration = "";
$quantityErr = $db_prod_id_addErr = $prod_expirationErr = "";

if (isset($_POST["btnAddstocks"])) {

    $quantity = $_POST["quantity"];
    $acc_id_addstock = $_POST["acc_id_addstock"];
    $db_prod_id_add = $_POST["db_prod_id_add"];

    $prod_expiration = $_POST["prod_expiration"];

    mysqli_query($connections, "INSERT INTO `stocks` (`s_id`, `s_created`, `s_expiration`, `s_prod_id`,`s_stock_in_qty`, `s_amount`) VALUES (NULL, current_timestamp(), ' $prod_expiration', '$db_prod_id_add','$quantity' ,'$quantity')");


    ////log
    date_default_timezone_set('Asia/Manila');
    $currentDateTime = date('Y-m-d g:i A');


    $get_record = mysqli_query($connections, "SELECT * FROM product where prod_id='$db_prod_id_add' ");
    $row = mysqli_fetch_assoc($get_record);
    $db_prod_name = $row["prod_name"];


    mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date) 
    VALUES('$acc_id_addstock', 'Add $quantity stocks on product $db_prod_name', '$currentDateTime')");
    ///end log

    echo '
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
                    <script>
                        swal({
                            title: "Success!",
                            text: "Add Stocks succesfully",
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
}
