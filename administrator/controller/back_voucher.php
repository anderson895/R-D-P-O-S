<?php
include("../../connection.php");

$voucherName = $discountRate = $dateExpire = $maximumLimit = "";
$voucherNameErr = $discountRateErr = $dateExpireErr = $maximumLimitErr = "";

if (isset($_POST["btn_save_voucher"])) {
    if (empty($_POST["voucherName"])) {
        $voucherNameErr = "Voucher Name is Required!";
    } else {
        $voucherName = $_POST["voucherName"];
    }

    if (empty($_POST["discountRate"])) {
        $discountRateErr = "Discount Rate is Required!";
    } elseif (!is_numeric($_POST["discountRate"])) {
        $discountRateErr = "Discount Rate must be a number!";
    } else {
        $discountRate = $_POST["discountRate"];
    }

    if (empty($_POST["dateExpire"])) {
        $dateExpireErr = "Voucher Expiration is Required!";
    } else {
        $dateExpire = $_POST["dateExpire"];
    }

    if (empty($_POST["maximumLimit"])) {
        $maximumLimitErr = "Maximum Limit is Required!";
    } elseif (!is_numeric($_POST["maximumLimit"])) {
        $maximumLimitErr = "Maximum Limit must be a number!";
    } else {
        $maximumLimit = $_POST["maximumLimit"];
    }

    if ($voucherName && $discountRate && $dateExpire && $maximumLimit) {
        $check_voucherName = mysqli_query($connections, "SELECT * from voucher WHERE voucher_name='$voucherName'");
        $check_voucherName_row = mysqli_num_rows($check_voucherName);

        if ($check_voucherName_row > 0) {
            $voucherNameErr = "Voucher Name already exists!";
        }else {
            $query = "INSERT INTO voucher (voucher_name, voucher_discount, voucher_created, voucher_expiration, voucher_maximumLimit, voucher_status)
                      VALUES (?, ?, NOW(), ?, ?, '1')";
                      
            $stmt = mysqli_prepare($connections, $query);
            mysqli_stmt_bind_param($stmt, "ssss", $voucherName, $discountRate, $dateExpire, $maximumLimit);
            mysqli_stmt_execute($stmt);

            echo '
            <script>
              alert("Add voucher successful")
            </script>
            ';
        }
    }
}






if (isset($_POST["btn_voucher_remove"])) {
    $voucher_id = $_POST['voucher_id'];

   
        // Perform the database update
        $query = "DELETE FROM `voucher` WHERE `voucher_id` = '$voucher_id'";

        // Execute the delete statement
        if (mysqli_query($connections, $query)) {
            // Deletion successful
            echo '
            <script>
              alert("Remove voucher successful")
            </script>
            ';
        } else {
            echo "Error deleting record: " . mysqli_error($connections);
        }
    }



?>
