<?php 

include('../../backend/class.php');

// Debug output for $_FILES
echo "<pre>";
print_r($_FILES);
echo "</pre>";

$db = new global_class();
session_start();
$userId = $_SESSION['acc_id'];

// Check if the file was uploaded correctly
if (isset($_FILES['profileAttachementImg']) && $_FILES['profileAttachementImg']['error'] == UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['profileAttachementImg']['tmp_name'];
    $fileName = $_FILES['profileAttachementImg']['name'];
    $fileSize = $_FILES['profileAttachementImg']['size'];
    $fileType = $_FILES['profileAttachementImg']['type'];

    // Define allowed file types and maximum file size (e.g., 5MB)
    $allowedFileTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $maxFileSize = 5 * 1024 * 1024; // 5MB

    // Check file type and size
    if (!in_array($fileType, $allowedFileTypes)) {
        echo json_encode(['error' => 'Invalid file type.']);
        exit;
    }

    if ($fileSize > $maxFileSize) {
        echo json_encode(['error' => 'File is too large.']);
        exit;
    }
    
    // Generate a unique filename
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
    $uniqueFileName = uniqid('profile_', true) . '.' . $fileExtension;

    // Define the upload directory and destination path
    $uploadFileDir = '../../../upload_img/';
    $dest_path = $uploadFileDir . $uniqueFileName;

    // Move the file to the destination directory
    if (move_uploaded_file($fileTmpPath, $dest_path)) {
        // Assuming insertImages method needs the file path, not just the file name
        $result = $db->updateEmpImage($uniqueFileName, $userId);

        // Check if $result is a valid result set
        if ($result) {
            echo json_encode(['success' => 'Image update successful']);
        } else {
            echo json_encode(['error' => 'Database update failed.']);
        }
       
    } else {
        echo json_encode(['error' => 'There was an error moving the uploaded file.']);
    }
} else {
    echo json_encode(['error' => 'File upload failed or no file was uploaded.']);
}

?>
