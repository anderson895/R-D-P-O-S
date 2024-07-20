<?php
require 'vendor/autoload.php'; // Include the Composer autoloader

use Picqer\Barcode\BarcodeGeneratorPNG;

// Function to generate a barcode and save it in a specific folder
function generateBarcode($text, $folder, $filename) {
    $generator = new BarcodeGeneratorPNG();
    $filePath = $folder . '/' . $filename;
    file_put_contents($filePath, $generator->getBarcode($text, $generator::TYPE_CODE_128));
    return $filePath;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Example usage
    $barcodeText = $_POST["name"];; // Change this to your desired barcode data
    $folderPath = '../../uploads/barcodes'; // Change this to the desired folder path
    $fileName = $barcodeText.".png";

    $filePath = generateBarcode($barcodeText, $folderPath, $fileName);

    header("Location: index.php?status=true&name=$fileName");

}