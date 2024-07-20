<?php
include ('../config/config.php');

if(isset($_POST['add'])) {
    // Assuming $name and $c_level have been properly sanitized to prevent SQL injection.

    $name = $_POST['name'];
    $c_level = $_POST['c_level'];

    // SQL statement with placeholders
    $sql = "INSERT INTO `category` (`category_id`, `category_name`, `critical_level`, `category_status`) VALUES (NULL, ?, ?, '1')";

    // Prepare the statement
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        die("Preparation failed: " . mysqli_error($conn));
    }

    // Bind the parameters
    mysqli_stmt_bind_param($stmt, "si", $name, $c_level);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        // Query executed successfully
        echo '<script>alert("Successfully added");</script>';
        echo '<script>window.location = "../pages/maintenance";</script>';

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
