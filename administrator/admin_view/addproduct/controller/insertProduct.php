<?php

date_default_timezone_set('Asia/Manila');
$currentDateTime = date('Y-m-d H:i:s');

include("../../../../connection.php");
require '../../../../library/picqer/vendor/autoload.php'; // Include the Composer autoloader for the barcode generator

echo "<pre>";
print_r($_POST);
echo "</pre>";


use Picqer\Barcode\BarcodeGeneratorPNG;




function generateBarcodeWithText($text, $folder, $filename)
{
    // Create the folder if it doesn't exist
    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    $generator = new BarcodeGeneratorPNG();
    $barcode = $generator->getBarcode($text, $generator::TYPE_CODE_128);

    // Concatenate the folder path to the filename
    $filePath = $folder . '/' . $filename;

    file_put_contents($filePath, $barcode);
}








$pname = $unit = $pcat = $pcritical = $pDescript = $pVouch  = $pCprice = $pImg = "";


$pname = mysqli_real_escape_string($connections, preg_replace('/[^0-9.,a-zA-Z\s]/', '', $_POST["pname"]));

$pCprice = floatval(preg_replace('/[^0-9.]/', '', $_POST["pCprice"]));

$pcat = intval(preg_replace('/[^0-9]/', '', $_POST["pcat"]));
$pcritical = intval(preg_replace('/[^0-9]/', '', $_POST["pcritical"]));
$pDescript = mysqli_real_escape_string($connections, preg_replace('/[^0-9.,a-zA-Z\s]/', '', $_POST["pDescript"]));
$pVouch = preg_replace('/[^0-9.,]/', '', $_POST["pVouch"]);
$acc_id = preg_replace('/[^0-9]/', '', $_POST["acc_id"]);

$expirationStatus = $_POST["expirationStatus"];


$SellOnlineTogler = preg_replace('/[^0-9.,]/', '', $_POST["SellOnlineTogler"]);

$mg =  $_POST["mg"];
$ml =  $_POST["ml"];
$g = $_POST["g"];
$unitType = $_POST['unitType'];

if ($_FILES['pImg']['error'] === UPLOAD_ERR_OK) {
    $imagePath = '../../../../upload_prodImg';
    $fileExtension = pathinfo($_FILES['pImg']['name'], PATHINFO_EXTENSION);
    $uniqueFilename = uniqid() . '.' . $fileExtension;

    $targetFile = $imagePath . '/' . $uniqueFilename;

    if (is_uploaded_file($_FILES['pImg']['tmp_name']) && move_uploaded_file($_FILES['pImg']['tmp_name'], $targetFile)) {
        $pImg = mysqli_real_escape_string($connections, $uniqueFilename);




        $query = "INSERT INTO product(prod_name, prod_currprice, prod_mg ,prod_ml,prod_g,prod_category_id,prod_critical,prod_description,prod_voucher_id,prod_image,prod_added,prod_sell_onlline,prod_expirationStatus, unit_type) 
            VALUES('$pname', '$pCprice', '$mg','$ml','$g', '$pcat', '$pcritical', '$pDescript', '$pVouch', '$pImg', '$currentDateTime','$SellOnlineTogler','$expirationStatus', '$unitType')";


        echo "Length of Image :" . strlen($pImg);

        if (mysqli_query($connections, $query)) {


            $last_id = mysqli_insert_id($connections);

            if ($last_id) {
                $code = str_pad(rand(1, 99999), 2, '0', STR_PAD_LEFT);
                $prod_code = sprintf("PROD%d", $code, $last_id);


                $uniqueCode = $prod_code;
                $barcodeText = $uniqueCode; 
                $folderPath = '../../../../upload_barcode'; 
                $fileName = $barcodeText . ".png";

                $filePath = generateBarcodeWithText($barcodeText, $folderPath, $fileName);


                $query = "UPDATE product SET prod_code='" . $prod_code . "' ,barcode='" . $fileName . "' WHERE prod_id ='" . $last_id . "' ";
                if (mysqli_query($connections, $query)) {
                    // Success, redirect or display a success message

                    //start user log
                    mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
                        VALUES('$acc_id', 'Added new product: $pname', '$currentDateTime','product','$prod_code')");
                    //end user log


                    //   header("Location: productlist.php");
                    exit;
                } else {
                    // Handle the SQL update error
                    echo "Error updating product code: " . mysqli_error($connections);
                    exit;
                }
            }
        } else {
            // Handle the SQL insert error
            echo "Error inserting product: " . mysqli_error($connections);
            exit;
        }
    } else {
        $errorDetails = error_get_last();
        echo "Error: File upload failed - " . $errorDetails['message'];
        exit;
    }
}
