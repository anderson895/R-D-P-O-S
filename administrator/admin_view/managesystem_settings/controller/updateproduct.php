<?php
include("../../../../connection.php");

$pname = $unit = $pcat = $pcritical = $pDescript = $pVouch  = $pCprice = $pImg = "";
$prod_code = $acc_id = "";

print_r($_POST);


//if (isset($_POST["btnSubmit"])) {
    // Sanitize and validate input
    $pname = mysqli_real_escape_string($connections, preg_replace('/[^0-9.,a-zA-Z\s]/', '', $_POST["pname"]));

    $pCprice = floatval(preg_replace('/[^0-9.]/', '', $_POST["pCprice"]));
    $unit = intval(preg_replace('/[^0-9]/', '', $_POST["unit"]));
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

     //updated product 
     $get_record = mysqli_query ($connections,"SELECT *
     FROM product
     LEFT JOIN unit ON unit.unit_id = product.prod_unit_id
     LEFT JOIN category ON category.category_id = product.prod_category_id
     LEFT JOIN voucher ON voucher.voucher_id = product.prod_voucher_id
     WHERE prod_code = '$prod_code' ");
             $row = mysqli_fetch_assoc($get_record);
              $db_prod_id = $row["prod_id"];
              $db_prod_code = $row["prod_code"];
              $db_prod_name = $row["prod_name"];
              $db_prod_orgprice = $row["prod_orgprice"];
              $db_prod_currprice = $row["prod_currprice"];
              $db_prod_critical = $row["prod_critical"];
              $db_prod_description = $row["prod_description"];
              $db_prod_image = $row["prod_image"];
              $db_prod_added = $row["prod_added"];
     
              $db_prod_unit_id=$row["prod_unit_id"];
              $db_prod_category_id=$row["prod_category_id"];
              $db_prod_voucher_id=$row["prod_voucher_id"];
     
              $db_unit_name=$row["unit_name"];
              $db_category_name=$row["category_name"];
              $db_voucher_name=$row["voucher_name"];

    date_default_timezone_set('Asia/Manila');
    $currentDateTime = date('Y-m-d H:i:s');

    if ($prod_code > 0) {
        $query = "UPDATE product SET 
                  prod_name = '$pname',
                  prod_currprice = '$pCprice',
                  prod_unit_id = '$unit',
                  prod_category_id = '$pcat',
                  prod_critical = '$pcritical',
                  prod_description = '$pDescript',
                  prod_voucher_id = '$pVouch',
                  prod_edit = '$currentDateTime'";

        if ($pImg) {
            $query .= ", prod_image = '$pImg'";
        }

        $query .= " WHERE prod_code = '$prod_code'";

        if (mysqli_query($connections, $query)) {
            // Success, redirect or display a success message

          

                     
            // Start user log
            //updated product 
            $get_record = mysqli_query ($connections,"SELECT *
            FROM product
            LEFT JOIN unit ON unit.unit_id = product.prod_unit_id
            LEFT JOIN category ON category.category_id = product.prod_category_id
            LEFT JOIN voucher ON voucher.voucher_id = product.prod_voucher_id
            WHERE prod_code = '$prod_code' ");
                    $row = mysqli_fetch_assoc($get_record);
                     $new_db_prod_id = $row["prod_id"];
                     $new_db_prod_code = $row["prod_code"];
                     $new_db_prod_name = $row["prod_name"];
                     $new_db_prod_orgprice = $row["prod_orgprice"];
                     $new_db_prod_currprice = $row["prod_currprice"];
                     $new_db_prod_critical = $row["prod_critical"];
                     $new_db_prod_description = $row["prod_description"];
                     $new_db_prod_image = $row["prod_image"];
                     $new_db_prod_added = $row["prod_added"];
            
                     $new_db_prod_unit_id=$row["prod_unit_id"];
                     $new_db_prod_category_id=$row["prod_category_id"];
                     $new_db_prod_voucher_id=$row["prod_voucher_id"];
            
                     $new_db_unit_name=$row["unit_name"];
                     $new_db_category_name=$row["category_name"];
                     $new_db_voucher_name=$row["voucher_name"];


                     if($db_prod_name !=$new_db_prod_name){
                        mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
                        VALUES('$acc_id', '$db_prod_name changed to $new_db_prod_name ', '$currentDateTime','product','$prod_code')");
                     }
                     if($db_prod_orgprice !=$new_db_prod_orgprice){
                        mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
                        VALUES('$acc_id', '$db_prod_name changed origincal price: $db_prod_orgprice to $new_db_prod_orgprice', '$currentDateTime','product','$prod_code')");
                     }
                     if($db_prod_currprice !=$new_db_prod_currprice){
                        mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
                        VALUES('$acc_id', '$db_prod_name changed current price: $db_prod_currprice to $new_db_prod_currprice', '$currentDateTime','product','$prod_code')");
                     }
                     if($db_prod_critical !=$new_db_prod_critical){
                        mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
                        VALUES('$acc_id', '$db_prod_name changed critical level $db_prod_critical to $new_db_prod_critical', '$currentDateTime','product','$prod_code')");
                     }

                     if($db_prod_description !=$new_db_prod_description){
                        mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
                        VALUES('$acc_id', '$db_prod_name changed product description $db_prod_description to $pDescript', '$currentDateTime','product','$prod_code')");
                     }
                     if($db_prod_image !=$new_db_prod_image){
                        mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
                        VALUES('$acc_id', '$db_prod_name changed product image', '$currentDateTime','product','$prod_code')");
                     }
                     if($db_unit_name !=$new_db_unit_name){
                        mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
                        VALUES('$acc_id', '$db_prod_name changed unit $db_unit_name to $new_db_unit_name', '$currentDateTime','product','$prod_code')");
                     }

                     if($db_category_name !=$new_db_category_name){
                        mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
                        VALUES('$acc_id', '$db_prod_name changed category $db_category_name to $new_db_category_name', '$currentDateTime','product','$prod_code')");
                     }
                     if($db_voucher_name !=$new_db_voucher_name){
                        mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
                        VALUES('$acc_id', '$db_prod_name changed voucher $db_voucher_name to $new_db_voucher_name', '$currentDateTime','product','$prod_code')");
                     }
           
            // End user log

            // Redirect to product list page
         //   header("Location: productlist.php");
            exit;
        } else {
            // Handle the SQL update error
            echo "Error updating product: " . mysqli_error($connections);
            exit;
        }
    }
//}
?>
