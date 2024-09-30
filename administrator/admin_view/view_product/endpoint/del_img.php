
<?php

include "../../../../connection.php";

// Get `img_id` and `filename` from POST data
$img_id = $_POST['img_id'];
$filename = $_POST['filename'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // First, delete the file from the server
    $file_path = '../../../../product_photos/' . $filename;
    if (file_exists($file_path)) {
        if (unlink($file_path)) {
            // Then, remove the entry from the database
            $stmt = $connections->prepare("DELETE FROM productphotos WHERE ID = ?");
            $stmt->bind_param("i", $img_id);
            
            if ($stmt->execute()) {
                echo '200'; // Success response
            } else {
                echo 'Error deleting from the database.';
            }

            $stmt->close();
        } else {
            echo 'Error deleting the file.';
        }
    } else {
        echo 'File not found.';
    }
} else {
    echo 'Invalid request method.';
}

$connections->close();
?>
