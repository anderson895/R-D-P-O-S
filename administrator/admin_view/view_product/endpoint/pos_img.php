<?php

include "../../../../connection.php";

// Pagkuha ng `PHOTOS_PROD_ID` mula sa POST data (ang ID na maaari mong idagdag sa form kung kinakailangan)
$photos_prod_id = $_POST['PHOTOS_PROD_ID'] ?? 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['img_photos']) && $_FILES['img_photos']['error'] == 0) {
        $fileTmpPath = $_FILES['img_photos']['tmp_name'];
        $fileName = $_FILES['img_photos']['name'];
        $fileSize = $_FILES['img_photos']['size'];
        $fileType = $_FILES['img_photos']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedExtensions = ['jpg', 'jpeg', 'png','webp'];
        if (in_array($fileExtension, $allowedExtensions)) {
            // Generate a unique filename
            $uniqueFileName = uniqid('photo_', true) . '.' . $fileExtension;

            $uploadFileDir = '../../../../product_photos/';
            $dest_path = $uploadFileDir . $uniqueFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                // Insert the unique filename and PHOTOS_PROD_ID into the database
                $stmt = $connections->prepare("INSERT INTO productphotos (PHOTOS_PROD_ID, PROD_PHOTOS) VALUES (?, ?)");
                $stmt->bind_param("ss", $photos_prod_id, $uniqueFileName);
                
                if ($stmt->execute()) {
                    echo '200'; // Success response
                } else {
                    echo 'Error saving to the database.';
                }

                $stmt->close();
            } else {
                echo 'Error uploading the file.';
            }
        } else {
            echo 'Unsupported file type.';
        }
    } else {
        echo 'No file uploaded or there was an upload error.';
    }
} else {
    echo 'Invalid request method.';
}

$connections->close();
?>
