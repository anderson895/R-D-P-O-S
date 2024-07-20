<?php
include('../config/config.php');
include('session.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $productName = $_POST["name"];
    $retailPrice = $_POST["r_price"];
    $category = $_POST["category"];
    $unit = $_POST["unit"];
    $criticalLevel = $_POST["c_level"];
    $description = $_POST["description"];

    $imageFile = $_FILES["img"];

    $newImagePath = ''; // Initialize the newImagePath variable.

    if (!empty($imageFile) && $imageFile["error"] == 0) {
        // File upload is successful. You can add or update it here.
        $imageFileName = $imageFile["name"];
        $imageTempName = $imageFile["tmp_name"];
        
        // Move the uploaded image to your desired directory.
        $uploadDirectory = "../uploads/images/";
        $newImagePath = $uploadDirectory . $imageFileName;
        
        if (move_uploaded_file($imageTempName, $newImagePath)) {
            // File moved successfully, now you can perform an insert or update query.

            // Prepare and execute the SQL statement using placeholders and bound parameters.
            $sql = "UPDATE `product` SET `prod_name` = ?, `prod_currprice` = ?, `prod_category_id` = ?, `prod_unit_id` = ?, `prod_description` = ?, `prod_image` = ?, `prod_edit` = NOW(), `prod_critical` = ? WHERE `prod_id` = ?";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                // Bind parameters to the statement.
                $stmt->bind_param("sssssssi", $productName, $retailPrice, $category, $unit, $description, $newImagePath, $criticalLevel, $id);

                // Execute the statement.
                if ($stmt->execute()) {
                    // Successfully updated.
                    echo '<script>alert("Successfully updated");</script>';
                    echo '<script>window.location = "../pages/inventory";</script>';
                } else {
                    echo '<script>alert("Failed to Update");</script>';
                    echo '<script>window.location = "../pages/inventory";</script>';
                }
    
                // Close the statement.
                $stmt->close();
            } else {
                die("Error in SQL query: " . $conn->error);
            }
        } else {
            echo '<script>alert("Failed to move the uploaded image");</script>';
            echo '<script>window.location = "../pages/inventory";</script>';
        }
    }
    else {
        // If no image is uploaded, or if there's an error with the file upload, you can still update the other fields.

        // Prepare and execute the SQL statement using placeholders and bound parameters.
        $sql = "UPDATE `product` SET `prod_name` = ?, `prod_orgprice` = ?, `prod_currprice` = ?, `prod_category_id` = ?, `prod_unit_id` = ?, `prod_edit` = NOW(), `c_level` = ? WHERE `prod_id` = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Bind parameters to the statement.
            $stmt->bind_param("ssssiii", $productName, $originalPrice, $retailPrice, $category, $unit, $criticalLevel, $id);

            // Execute the statement.
            if ($stmt->execute()) {
                echo '<script>alert("Successfully updated");</script>';
                echo '<script>window.location = "../pages/inventory";</script>';
            } else {
                echo '<script>alert("Failed to Update");</script>';
                echo '<script>window.location = "../pages/inventory";</script>';
            }

            // Close the statement.
            $stmt->close();
        } else {
            die("Error in SQL query: " . $conn->error);
        }
    }
    
    // Close the database connection.
    $conn->close();
}
?>
