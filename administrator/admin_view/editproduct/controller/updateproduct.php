<?php
include("../../../../connection.php");

date_default_timezone_set('Asia/Manila');
$currentDateTime = date('Y-m-d H:i:s');

$pname  = $pcat = $pcritical = $pDescript = $pVouch  = $pCprice = $pImg = "";
$prod_code = $acc_id = "";

echo "<pre>";
print_r($_POST);
echo "</pre>";

$pname = mysqli_real_escape_string($connections, preg_replace('/[^0-9.,a-zA-Z\s]/', '', $_POST["pname"]));

$pCprice = floatval(preg_replace('/[^0-9.]/', '', $_POST["pCprice"]));
$mg = $_POST["mg"];
$ml = $_POST["ml"];
$g = $_POST["g"];

$unitType = $_POST['unitType'];

// $vatableTogler = $_POST["vatableTogler"];
$discountableTogler = $_POST["discountableTogler"];
$SellOnlineTogler = $_POST["SellOnlineTogler"];


$pcat = intval(preg_replace('/[^0-9]/', '', $_POST["pcat"]));
$pcritical = intval(preg_replace('/[^0-9]/', '', $_POST["pcritical"]));
$pDescript = mysqli_real_escape_string($connections, preg_replace('/[^0-9.,a-zA-Z\s]/', '', $_POST["pDescript"]));
$pVouch = preg_replace('/[^0-9.,]/', '', $_POST["pVouch"]);
$prod_code = preg_replace('/[^0-9.,a-zA-Z]/', '', $_POST["prod_code"]);
$acc_id = preg_replace('/[^0-9]/', '', $_POST["acc_id"]);


if ($_FILES['pImg']['error'] === UPLOAD_ERR_OK) {
    $imagePath = '../../../../upload_prodImg';
    $fileExtension = pathinfo($_FILES['pImg']['name'], PATHINFO_EXTENSION);
    $uniqueFilename = uniqid() . '.' . $fileExtension;

    $targetFile = $imagePath . '/' . $uniqueFilename;

    if (move_uploaded_file($_FILES['pImg']['tmp_name'], $targetFile)) {
        $pImg = $uniqueFilename;
    }
}

$get_record = mysqli_query($connections, "SELECT *
     FROM product
     LEFT JOIN category ON category.category_id = product.prod_category_id
     LEFT JOIN voucher ON voucher.voucher_id = product.prod_voucher_id
     WHERE prod_code = '$prod_code' ");
$row = mysqli_fetch_assoc($get_record);
$db_prod_id = $row["prod_id"];
$db_prod_code = $row["prod_code"];
$db_prod_name = $row["prod_name"];

$db_prod_currprice = $row["prod_currprice"];
$db_prod_critical = $row["prod_critical"];
$db_prod_description = $row["prod_description"];
$db_prod_image = $row["prod_image"];
$db_prod_added = $row["prod_added"];


$db_prod_category_id = $row["prod_category_id"];
$db_prod_voucher_id = $row["prod_voucher_id"];


$db_category_name = $row["category_name"];
$db_voucher_name = $row["voucher_name"];



if ($prod_code > 0) {
    $query = "UPDATE product SET 
                  prod_name = '$pname',
                  prod_currprice = '$pCprice',
                  prod_mg = '$mg',
                  prod_ml = '$ml',
                  prod_g = '$g',
                  prod_category_id = '$pcat',
                  prod_critical = '$pcritical',
                  prod_description = '$pDescript',
                  prod_voucher_id = '$pVouch',
                  prod_edit = '$currentDateTime',
                  prod_sell_onlline = '$SellOnlineTogler',
                  unit_type = '$unitType'
                  ";

    if ($pImg) {
        $query .= ", prod_image = '$pImg'";
    }

    $query .= " WHERE prod_code = '$prod_code'";

    if (mysqli_query($connections, $query)) {



        $get_record = mysqli_query($connections, "SELECT *
            FROM product
            LEFT JOIN category ON category.category_id = product.prod_category_id
            LEFT JOIN voucher ON voucher.voucher_id = product.prod_voucher_id
            WHERE prod_code = '$prod_code' ");
        $row = mysqli_fetch_assoc($get_record);
        $new_db_prod_id = $row["prod_id"];
        $new_db_prod_code = $row["prod_code"];
        $new_db_prod_name = $row["prod_name"];
        $new_db_prod_currprice = $row["prod_currprice"];
        $new_db_prod_critical = $row["prod_critical"];
        $new_db_prod_description = $row["prod_description"];
        $new_db_prod_image = $row["prod_image"];
        $new_db_prod_added = $row["prod_added"];


        $new_db_prod_category_id = $row["prod_category_id"];
        $new_db_prod_voucher_id = $row["prod_voucher_id"];


        $new_db_category_name = $row["category_name"];
        $new_db_voucher_name = $row["voucher_name"];


        if ($db_prod_name != $new_db_prod_name) {
            mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
                        VALUES('$acc_id', '$db_prod_name changed to $new_db_prod_name ', '$currentDateTime','product','$prod_code')");
        }

        if ($db_prod_currprice != $new_db_prod_currprice) {
            mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
                        VALUES('$acc_id', '$db_prod_name changed current price: $db_prod_currprice to $new_db_prod_currprice', '$currentDateTime','product','$prod_code')");
        }
        if ($db_prod_critical != $new_db_prod_critical) {
            mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
                        VALUES('$acc_id', '$db_prod_name changed critical level $db_prod_critical to $new_db_prod_critical', '$currentDateTime','product','$prod_code')");
        }

        if ($db_prod_description != $new_db_prod_description) {
            mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
                        VALUES('$acc_id', '$db_prod_name changed product description $db_prod_description to $pDescript', '$currentDateTime','product','$prod_code')");
        }
        if ($db_prod_image != $new_db_prod_image) {
            mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
                        VALUES('$acc_id', '$db_prod_name changed product image', '$currentDateTime','product','$prod_code')");
        }


        if ($db_category_name != $new_db_category_name) {
            mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
                        VALUES('$acc_id', '$db_prod_name changed category $db_category_name to $new_db_category_name', '$currentDateTime','product','$prod_code')");
        }
        if ($db_voucher_name != $new_db_voucher_name) {
            mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
                        VALUES('$acc_id', '$db_prod_name changed voucher $db_voucher_name to $new_db_voucher_name', '$currentDateTime','product','$prod_code')");
        }


        exit;
    } else {

        echo "Error updating product: " . mysqli_error($connections);
        exit;
    }
}
