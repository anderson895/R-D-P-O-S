<?php
include('../config/config.php');
include ('session.php');
require '../library/picqer/vendor/autoload.php'; // Include the Composer autoloader for the barcode generator

/*echo "<pre>";
print_r($_POST);
echo "</pre>";
*/




date_default_timezone_set('Asia/Manila');
$currentDateTime = date('Y-m-d H:i:s');




use Picqer\Barcode\BarcodeGeneratorPNG;

// Function to generate a barcode with text below it and save it in a specific folder
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





if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $transaction_code = 'RD' . str_pad(mt_rand(0, 99999), 5, '0', STR_PAD_LEFT);

    $discountRateVal = $_POST["discountRateVal"];
    $discount_name = $_POST["discount_name"];
    $amount_change = $_POST["amount_changeVal"];
    $discount = $_POST["modal_discount"];
    $tax = $_POST["modal_tax"];
    $total = $_POST["modal_total"];
    $payment = $_POST["amount_payment"];

    // Generate barcode
    $uniqueCode = $transaction_code;
    $barcodeText = $uniqueCode;
    $folderPath = '../../upload_barcode/';
    $fileName = $barcodeText . ".png";
    $filePath = generateBarcodeWithText($barcodeText, $folderPath, $fileName);

    // Split cart IDs and quantities
    $prodIds = explode(',', $_POST['prodIds']);
    $quantities = explode(',', $_POST['quantities']);

    foreach ($prodIds as $key => $prod_id) {
        $quantities_value = $quantities[$key];
        $product_id_value = $prodIds[$key];
        
        // Fetch cart details
        $view_query = mysqli_query($connections, "SELECT * FROM pos_cart 
            LEFT JOIN product ON pos_cart.pos_cart_prod_id = product.prod_id
            WHERE pos_cart_user_id='$acc_id' AND pos_cart.pos_cart_prod_id='$product_id_value'");

        if ($cart_row = mysqli_fetch_assoc($view_query)) {
            $prod_currprice = $cart_row["prod_currprice"];

            // Start deducting stock
            $get_record = mysqli_query($connections, "
                SELECT *
                FROM product AS a
                LEFT JOIN stocks AS b ON a.prod_id = b.s_prod_id
                WHERE a.prod_status = '0'
                    AND a.prod_id = '$product_id_value'
                    AND s_amount > 0 
                    AND (DATE(b.s_expiration) >= CURDATE() OR b.s_expiration = '0000-00-00')
                ORDER BY b.s_expiration ASC;
            ");

            if ($stock_row = $get_record->fetch_array()) {
                $db_s_id = $stock_row["s_id"];
                $db_s_amount = $stock_row["s_amount"];
                $db_s_expiration = $stock_row["s_expiration"];

                $subtotal = $prod_currprice * $quantities_value;

                // Insert order details
                $insertQuery = "INSERT INTO `pos_orders` 
                    (`orders_tcode`, `orders_prod_id`,`orders_prod_price`, `orders_prodQty`, `orders_subtotal`, `orders_discount`, `orders_discount_name`, `orders_tax`, `orders_date`, `orders_final`, `orders_payment`, `orders_change`, `orders_user_id`, `orders_status`, `orders_barcode`) 
                    VALUES 
                    ('$transaction_code', '$product_id_value','$prod_currprice', '$quantities_value', '$subtotal', '$discount', '$discount_name', '$tax', NOW(), '$total', '$payment', '$amount_change', '$acc_id', '0', '$fileName')";

                $result = mysqli_query($connections, $insertQuery);

                if ($result) {
                    // Handle success
                } else {
                    // Handle failure
                }
            }
        }
    }

    // Clear cart items after processing
    mysqli_query($connections, "DELETE FROM pos_cart WHERE pos_cart_user_id ='$acc_id'");

    // Return transaction code
    echo $transaction_code;

}
?>


