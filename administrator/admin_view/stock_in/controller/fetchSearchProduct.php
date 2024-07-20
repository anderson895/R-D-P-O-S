<?php
// process.php
include("../.../../../../../connection.php");

$current_date = date("Y-m-d");


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $selectedProduct = $_POST["product"];
    $expirationType = $_POST["expirationType"];
    $expirationDate = $_POST["expirationDate"];
    $quantity = $_POST["quantity"];
    $supplierPrice = $_POST["supplierPrice"];

    // Validate the form data (add your own validation logic here if needed)
    if (empty($selectedProduct) || empty($expirationType) || empty($quantity) || empty($supplierPrice)) {
        echo "All fields are required.";
        exit();
    }

    // Perform your processing logic here
    // For example, insert data into the database
    $insert_query = "INSERT INTO stock_table (product, expiration_type, expiration_date, quantity, supplier_price)
                     VALUES ('$selectedProduct', '$expirationType', '$expirationDate', '$quantity', '$supplierPrice')";

    if (mysqli_query($connections, $insert_query)) {
        echo "Form data inserted successfully!";
    } else {
        echo "Error: " . $insert_query . "<br>" . mysqli_error($connections);
    }
} else {
    // Handle invalid request method
    echo "Invalid request method!";
}

// Close the database connection
mysqli_close($connections);
?>
