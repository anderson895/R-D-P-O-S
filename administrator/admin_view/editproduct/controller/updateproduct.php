<?php
include("../../../../connection.php");

date_default_timezone_set('Asia/Manila');
$currentDateTime = date('Y-m-d H:i:s');

$pname = $pcat = $pcritical = $pDescript = $pVouch = $pCprice = $pImg = "";
$prod_code = $acc_id = "";

// Debugging output for $_POST data
echo "<pre>";
print_r($_POST);
echo "</pre>";

// Sanitize and validate input
$pname = mysqli_real_escape_string($connections, preg_replace('/[^0-9.,a-zA-Z\s]/', '', $_POST["pname"]));
$pCprice = floatval(preg_replace('/[^0-9.]/', '', $_POST["pCprice"]));
$mg = $_POST["mg"];
$ml = $_POST["ml"];
$g = $_POST["g"];
$unitType = $_POST['unitType'];
$discountableTogler = $_POST["discountableTogler"];
$SellOnlineTogler = $_POST["SellOnlineTogler"];
$pcat = intval(preg_replace('/[^0-9]/', '', $_POST["pcat"]));
$pcritical = intval(preg_replace('/[^0-9]/', '', $_POST["pcritical"]));
$pDescript = mysqli_real_escape_string($connections, preg_replace('/[^0-9.,a-zA-Z\s]/', '', $_POST["pDescript"]));
$pVouch = preg_replace('/[^0-9.,]/', '', $_POST["pVouch"]);
$prod_code = preg_replace('/[^0-9.,a-zA-Z]/', '', $_POST["prod_code"]);
$acc_id = preg_replace('/[^0-9]/', '', $_POST["acc_id"]);

// Handle file upload
if ($_FILES['pImg']['error'] === UPLOAD_ERR_OK) {
    $imagePath = '../../../../upload_prodImg';
    $fileExtension = strtolower(pathinfo($_FILES['pImg']['name'], PATHINFO_EXTENSION));
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif']; // Allowed file types

    if (in_array($fileExtension, $allowedExtensions)) {
        $uniqueFilename = uniqid() . '.' . $fileExtension;
        $targetFile = $imagePath . '/' . $uniqueFilename;

        if (move_uploaded_file($_FILES['pImg']['tmp_name'], $targetFile)) {
            $pImg = $uniqueFilename;
        } else {
            echo "Error uploading file.";
            exit;
        }
    } else {
        echo "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.";
        exit;
    }
}

// Fetch existing product data
$query = "SELECT * FROM product 
          LEFT JOIN category ON category.category_id = product.prod_category_id
          LEFT JOIN voucher ON voucher.voucher_id = product.prod_voucher_id
          WHERE prod_code = ?";
$stmt = mysqli_prepare($connections, $query);
mysqli_stmt_bind_param($stmt, 's', $prod_code);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo "Error: Product not found.";
    exit;
}

// Store original values for comparison
$db_prod_name = $row["prod_name"];
$db_prod_currprice = $row["prod_currprice"];
$db_prod_critical = $row["prod_critical"];
$db_prod_description = $row["prod_description"];
$db_prod_image = $row["prod_image"];
$db_category_name = $row["category_name"];
$db_voucher_name = $row["voucher_name"];

// Update product data
if ($prod_code > 0) {
    $updateQuery = "UPDATE product SET 
                    prod_name = ?, 
                    prod_currprice = ?, 
                    prod_mg = ?, 
                    prod_ml = ?, 
                    prod_g = ?, 
                    prod_category_id = ?, 
                    prod_critical = ?, 
                    prod_description = ?, 
                    prod_voucher_id = ?, 
                    prod_edit = ?, 
                    prod_sell_onlline = ?, 
                    unit_type = ?";

    if ($pImg) {
        $updateQuery .= ", prod_image = ?";
    }

    $updateQuery .= " WHERE prod_code = ?";
    $stmtUpdate = mysqli_prepare($connections, $updateQuery);

    if ($pImg) {
        mysqli_stmt_bind_param($stmtUpdate, 'sdsddiiissssi', $pname, $pCprice, $mg, $ml, $g, $pcat, $pcritical, $pDescript, $pVouch, $currentDateTime, $SellOnlineTogler, $unitType, $pImg, $prod_code);
    } else {
        mysqli_stmt_bind_param($stmtUpdate, 'sdsddiiissss', $pname, $pCprice, $mg, $ml, $g, $pcat, $pcritical, $pDescript, $pVouch, $currentDateTime, $SellOnlineTogler, $unitType, $prod_code);
    }

    if (mysqli_stmt_execute($stmtUpdate)) {
        // Fetch updated product data
        $result = mysqli_query($connections, "SELECT * FROM product 
                                              LEFT JOIN category ON category.category_id = product.prod_category_id
                                              LEFT JOIN voucher ON voucher.voucher_id = product.prod_voucher_id
                                              WHERE prod_code = '$prod_code'");
        $row = mysqli_fetch_assoc($result);

        // Log changes if values have changed
        logChanges($connections, $row, $db_prod_name, $db_prod_currprice, $db_prod_critical, $db_prod_description, $db_prod_image, $db_category_name, $db_voucher_name, $acc_id, $prod_code, $currentDateTime);

        echo "Product updated successfully.";
    } else {
        echo "Error updating product: " . mysqli_error($connections);
    }
}

function logChanges($connections, $newRow, $oldName, $oldPrice, $oldCritical, $oldDescription, $oldImage, $oldCategory, $oldVoucher, $accountId, $productCode, $currentDateTime) {
    // Compare and log changes
    if ($oldName != $newRow["prod_name"]) {
        mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date, act_table, act_collumn_id) 
                                     VALUES('$accountId', '$oldName changed to {$newRow['prod_name']}', '$currentDateTime', 'product', '$productCode')");
    }

    if ($oldPrice != $newRow["prod_currprice"]) {
        mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date, act_table, act_collumn_id) 
                                     VALUES('$accountId', '$oldName changed current price: $oldPrice to {$newRow['prod_currprice']}', '$currentDateTime', 'product', '$productCode')");
    }

    if ($oldCritical != $newRow["prod_critical"]) {
        mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date, act_table, act_collumn_id) 
                                     VALUES('$accountId', '$oldName changed critical level $oldCritical to {$newRow['prod_critical']}', '$currentDateTime', 'product', '$productCode')");
    }

    if ($oldDescription != $newRow["prod_description"]) {
        mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date, act_table, act_collumn_id) 
                                     VALUES('$accountId', '$oldName changed product description: $oldDescription to {$newRow['prod_description']}', '$currentDateTime', 'product', '$productCode')");
    }

    if ($oldImage != $newRow["prod_image"]) {
        mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date, act_table, act_collumn_id) 
                                     VALUES('$accountId', '$oldName changed product image', '$currentDateTime', 'product', '$productCode')");
    }

    if ($oldCategory != $newRow["category_name"]) {
        mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date, act_table, act_collumn_id) 
                                     VALUES('$accountId', '$oldName changed category $oldCategory to {$newRow['category_name']}', '$currentDateTime', 'product', '$productCode')");
    }

    if ($oldVoucher != $newRow["voucher_name"]) {
        mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date, act_table, act_collumn_id) 
                                     VALUES('$accountId', '$oldName changed voucher $oldVoucher to {$newRow['voucher_name']}', '$currentDateTime', 'product', '$productCode')");
    }
}

mysqli_close($connections);
?>
