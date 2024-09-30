<?php
include("../../../../connection.php");

date_default_timezone_set('Asia/Manila');
$currentDateTime = date('Y-m-d H:i:s');

$pname  = $pcat = $pcritical = $pDescript = $pCprice = $pImg = "";
$prod_code = $acc_id = "";

// Sanitize and assign POST values
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

$prod_code = preg_replace('/[^0-9.,a-zA-Z]/', '', $_POST["prod_code"]);
$acc_id = preg_replace('/[^0-9]/', '', $_POST["acc_id"]);

// Check if an image was uploaded
if ($_FILES['pImg']['error'] === UPLOAD_ERR_OK) {
    $imagePath = '../../../../upload_prodImg';
    $fileExtension = pathinfo($_FILES['pImg']['name'], PATHINFO_EXTENSION);
    $uniqueFilename = uniqid() . '.' . $fileExtension;

    $targetFile = $imagePath . '/' . $uniqueFilename;

    if (move_uploaded_file($_FILES['pImg']['tmp_name'], $targetFile)) {
        $pImg = $uniqueFilename;
    }
}

// Get the existing product record
$get_record = mysqli_query($connections, "SELECT * FROM product WHERE prod_code = '$prod_code'");
$row = mysqli_fetch_assoc($get_record);
$db_prod_id = $row["prod_id"];
$db_prod_image = $row["prod_image"];

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
                  prod_edit = '$currentDateTime',
                  prod_sell_onlline = '$SellOnlineTogler',
                  unit_type = '$unitType'";

    // Check if an image was uploaded
    if ($pImg) {
        // If the existing image is not the same as the new one, replace it
        if ($db_prod_image) {
            // Remove the existing image file if needed
            $existingImagePath = $imagePath . '/' . $db_prod_image;
            if (file_exists($existingImagePath)) {
                unlink($existingImagePath); // Delete the existing image file
            }
        }
        $query .= ", prod_image = '$pImg'";
    }

    $query .= " WHERE prod_code = '$prod_code'";

    if (mysqli_query($connections, $query)) {
        // Log activity and exit
        // (Your logging code here)
        exit;
    } else {
        echo "Error updating product: " . mysqli_error($connections);
        exit;
    }
}
?>
