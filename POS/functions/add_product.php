<?php
include('../config/config.php');
include('session.php');
require '../library/picqer/vendor/autoload.php'; // Include the Composer autoloader for the barcode generator

date_default_timezone_set('Asia/Manila');
$currentDateTime = date('Y-m-d H:i:s');



use Picqer\Barcode\BarcodeGeneratorPNG;

// Function to generate a barcode with text below it and save it in a specific folder
function generateBarcodeWithText($text, $folder, $filename) {
    $generator = new BarcodeGeneratorPNG();
    $barcodeImage = $generator->getBarcode($text, $generator::TYPE_CODE_128);

    // Create an image resource from the barcode image
    $barcodeImageResource = imagecreatefromstring($barcodeImage);

    // Set the font size and color
    $fontSize = 20; // You can adjust the font size as needed
    $textColor = imagecolorallocate($barcodeImageResource, 0, 0, 0); // Black color

    // Calculate the position to center the text
    $textWidth = imagefontwidth($fontSize) * strlen($text);
    $textX = (imagesx($barcodeImageResource) - $textWidth) / 2;

    // Calculate the Y position to place the text below the barcode
    $textY = imagesy($barcodeImageResource) + 10; // Adjust the Y position as needed

    // Add the text to the image
    imagestring($barcodeImageResource, $fontSize, $textX, $textY, $text, $textColor);

    // Save the image with text
    $filePath = $folder . '/' . $filename;
    imagepng($barcodeImageResource, $filePath);

    // Clean up the image resources
    imagedestroy($barcodeImageResource);

    return $filePath;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $acc_id = $_POST["acc_id"];
    $productName = $_POST["name"];
    $retailPrice = $_POST["r_price"];
     $retailPrice = sprintf("%.2f", (float)$retailPrice);  
     $category = $_POST["category"];
    $unit = $_POST["unit"];

    $clevel = str_replace('.', '', $_POST["c_level"]);
    $description = $_POST["description"];

    // Handling the image data
    $targetDirectory = "../../upload_prodImg/";

     $imageName=$_FILES["img"]["name"];
    $targetFile = $targetDirectory . basename($_FILES["img"]["name"]);

    
        // Product name is not found, proceed with insertion
        if ($category && $unit) {
            // Make sure the file was uploaded successfully
            if (move_uploaded_file($_FILES["img"]["tmp_name"], $targetFile)) {
               // $uniqueCode = generateUniqueCode();

                // Example usage
             //   $barcodeText = $uniqueCode; // Change this to your desired barcode data
              //  $folderPath = '../../upload_barcode/'; // Change this to the desired folder path
              //  $fileName = $barcodeText . ".png";

              //  $filePath = generateBarcodeWithText($barcodeText, $folderPath, $fileName);

                $sql = "INSERT INTO product (`prod_name`, `prod_currprice`, `prod_unit_id`, `prod_category_id`, `prod_description`, `prod_image`, `prod_added`, `prod_status`, `prod_critical`) VALUES ('$productName', '$retailPrice', '$unit', '$category', '$description', '$imageName', NOW(), 0, '$clevel')";

                $result = mysqli_query($conn, $sql);

                $last_id = mysqli_insert_id($conn);
                
                if ($last_id) {
                    $code = str_pad(rand(1, 99999), 2, '0', STR_PAD_LEFT);
                        //$last_id = $last_id % 100;
                    $prod_code = sprintf("PROD%d", $code, $last_id);


                    $uniqueCode = $prod_code;
                    $barcodeText = $uniqueCode; // Change this to your desired barcode data
                    $folderPath = '../../upload_barcode/'; // Change this to the desired folder path
                    $fileName = $barcodeText . ".png";
        
                    $filePath = generateBarcodeWithText($barcodeText, $folderPath, $fileName);


                    $query = "UPDATE product SET prod_code='" . $prod_code . "' ,barcode='".$fileName."' WHERE prod_id ='" . $last_id . "' ";
                    if (mysqli_query($conn, $query)) {
                        // Success, redirect or display a success message
                        
                        //start user log
                       

                        mysqli_query($conn, "INSERT INTO users_log(act_account_id, act_activity, act_date,act_table,act_collumn_id) 
                        VALUES('$acc_id', 'Added new product: $productName', '$currentDateTime','product','$prod_code')");
                        //end user log


                   
                     //   exit;
                 //   echo '<script>alert("Successfully Added");</script>';
                //     echo '<script>window.location = "../pages/inventory";</script>';

                     
                    } else {
                        // Handle the SQL update error
                        echo "Error updating product code: " . mysqli_error($conn);
                        exit;
                    }
                }


                if ($result) {
                    echo '<script>alert("Successfully Added");</script>';
                  echo '<script>window.location = "../pages/inventory";</script>';
                } else {
                    echo "Error: " . mysqli_error($conn);
                }

                $conn->close();
            } else {
                echo "File upload failed!";
            }
        } else {
          echo '<script>alert("Please fill out the category and unit");</script>';
            echo '<script>window.location = "../pages/inventory";</script>';
        }
    
}
?>
