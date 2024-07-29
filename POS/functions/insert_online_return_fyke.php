<?php
include('../config/config.php');
include('session.php');

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve and sanitize POST data
$rcode = isset($_POST['rcode']) ? $conn->real_escape_string($_POST['rcode']) : '';
$rreason = isset($_POST['rreason']) ? $conn->real_escape_string($_POST['rreason']) : '';
$rtype = isset($_POST['rtype']) ? $conn->real_escape_string($_POST['rtype']) : '';
$selectedItems = isset($_POST['selectedItems']) ? $conn->real_escape_string($_POST['selectedItems']) : ''; // Fixed variable name
$rtransaction = 1;
$rcustomer = isset($_POST['rcustomer']) ? $conn->real_escape_string($_POST['rcustomer']) : '';

// Handle file upload
$rupload = '';
if (isset($_FILES['rupload']) && $_FILES['rupload']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = '../uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileTmpPath = $_FILES['rupload']['tmp_name'];
    $fileName = $_FILES['rupload']['name'];
    $fileSize = $_FILES['rupload']['size'];
    $fileType = $_FILES['rupload']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

    $allowedfileExtensions = array('jpg', 'jpeg', 'png');
    if (in_array($fileExtension, $allowedfileExtensions)) {
        $dest_path = $uploadDir . $newFileName;
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            $rupload = $newFileName;
        } else {
            echo 'There was an error moving the uploaded file.';
            exit;
        }
    } else {
        echo 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
        exit;
    }
} else {
    echo 'No file uploaded or there was an upload error.';
    exit;
}

// Prepare and execute the SQL statements
$insertSql = "INSERT INTO return_pos_table (rdate, rcode, rreason, rtype, selected_items, rtransaction, rproof, rcustomer)
              VALUES (NOW(), '$rcode', '$rreason', '$rtype', '$selectedItems', '$rtransaction', '$rupload', '$rcustomer')";

$updateSql = "UPDATE new_tbl_orders 
              SET t_status = '1' 
              WHERE order_id = '$rcode'";

try {
    // Begin a transaction
    $conn->begin_transaction();

    // Insert into return_pos_table
    if ($conn->query($insertSql) !== TRUE) {
        throw new Exception("Insert Error: " . $conn->error);
    }

    // Update pos_orders
    if ($conn->query($updateSql) !== TRUE) {
        throw new Exception("Update Error: " . $conn->error);
    }

    // Commit the transaction
    $conn->commit();
    echo "New record created and orders status updated successfully";
} catch (Exception $e) {
    // Rollback the transaction on error
    $conn->rollback();
    echo $e->getMessage();
}

// Close the connection
$conn->close();
?>

