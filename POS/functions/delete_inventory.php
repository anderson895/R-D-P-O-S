<?php
// Include the configuration file to establish a database connection
include("../config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve the product code from the POST data
    $prod_code = $_POST["pcode"];

    // Construct the SQL query to delete the record based on the product code
    $delete_query = "DELETE FROM product WHERE prod_code = ?";
    
    // Prepare and execute the query
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("s", $prod_code); // Assuming prod_code is a string; use "i" for integers
    $stmt->execute();

    // Check if the query was successful
    if ($stmt->affected_rows > 0) {
        echo '<script>
            alert("Deleted successfully.");
            window.location.href = "../pages/inventory.php";
        </script>';
    } else {
        echo '<script>
            alert("No records were deleted.");
            window.location.href = "../pages/inventory.php";
        </script>';
    }
    

    // Close the statement and the database connection
    $stmt->close();
    $conn->close();
}
?>
