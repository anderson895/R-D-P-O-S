<?php
include("../../../../connection.php");

date_default_timezone_set('Asia/Manila');
$currentDateTime = date('Y-m-d H:i:s');

$pname = $pcat = $pcritical = $pDescript = $pVouch = $pCprice = $pImg = "";
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
$discountableTogler = $_POST["discountableTogler"];
$SellOnlineTogler = $_POST["SellOnlineTogler"];

$pcat = intval(preg_replace('/[^0-9]/', '', $_POST["pcat"]));
$pcritical = intval(preg_replace('/[^0-9]/', '', $_POST["pcritical"]));
$pDescript = mysqli_real_escape_string($connections, preg_replace('/[^0-9.,a-zA-Z\s]/', '', $_POST["pDescript"]));
$pVouch = preg_replace('/[^0-9.,]/', '', $_POST["pVouch"]);
$prod_code = preg_replace('/[^0-9.,a-zA-Z]/', '', $_POST["prod_code"]);
$acc_id = preg_replace('/[^0-9]/', '', $_POST["acc_id"]);

// Query the database for the product image
$get_record = mysqli_query($connections, "SELECT prod_image FROM product WHERE prod_code = '$prod_code'");
$row = mysqli_fetch_assoc($get_record);
$existingImage = $row['prod_image']; // Get the existing image filename

// File upload and replace logic
if ($_FILES['pImg']['error'] === UPLOAD_ERR_OK) {
    $imagePath = '../../../../upload_prodImg'; // Directory where images are stored
    $fileName = basename($_FILES['pImg']['name']); // Original file name
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION); // Get the file extension

    // Generate a unique filename
    $uniqueFileName = uniqid('prod_', true) . '.' . $fileExtension; // Unique filename
    $targetFile = $imagePath . '/' . $uniqueFileName; // Full path to the target file

    // Debug: Check if the directory exists and is writable
    if (!is_dir($imagePath) || !is_writable($imagePath)) {
        echo "Upload directory does not exist or is not writable: $imagePath\n";
        exit;
    }

    // Check if there is an existing image
    if (!empty($existingImage)) {
        // Full path to the existing image
        $existingImagePath = $imagePath . '/' . $existingImage;

        // If the existing image file exists, delete it
        if (file_exists($existingImagePath)) {
            if (unlink($existingImagePath)) {
                echo "Old file deleted successfully: $existingImage\n"; // Debug message
            } else {
                echo "Error deleting old file: $existingImage\n"; // Debug message
            }
        } else {
            echo "No existing file found to delete: $existingImage\n"; // Debug message
        }
    }

    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES['pImg']['tmp_name'], $targetFile)) {
        $pImg = $uniqueFileName; // Update with the unique file name
        echo "File uploaded successfully: $pImg\n"; // Debug message
    } else {
        echo "Error moving uploaded file: " . $_FILES['pImg']['tmp_name'] . " to $targetFile\n"; // Debug message
        echo "Error Code: " . $_FILES['pImg']['error'] . "\n"; // Show error code for debugging
    }
} else {
    // Handle the error from file upload
    echo "File upload error: " . $_FILES['pImg']['error'] . "\n"; // Debug message
}



// Continue with the database updates as before...
$get_record = mysqli_query($connections, "SELECT * FROM product LEFT JOIN category ON category.category_id = product.prod_category_id LEFT JOIN voucher ON voucher.voucher_id = product.prod_voucher_id WHERE prod_code = '$prod_code'");
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
        // Log changes as before...
        exit;
    } else {
        echo "Error updating product: " . mysqli_error($connections);
        exit;
    }
}
