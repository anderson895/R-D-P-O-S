<?php
include('../class.php');
$db = new global_class();

// Retrieve sender ID and message from POST
$sender_id = $_POST['mess_sender_id'];
$sender_Messages = $_POST['sender_Messages'];

if (isset($_POST['requestType']) && $_POST['requestType'] == 'SentMessage') {
    // Sanitize inputs
    $sender_id = htmlspecialchars(trim($sender_id));
    $sender_Messages = htmlspecialchars(trim($sender_Messages));

    // Send the message
    $messageResponse = $db->sentMessage($sender_id, $sender_Messages);

    if ($messageResponse === 'Message sent successfully!') {
            // File upload handling
            if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['file']['tmp_name'];
                $fileName = basename($_FILES['file']['name']); // Get only the file name
                $fileSize = $_FILES['file']['size'];
                $fileType = $_FILES['file']['type'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));

                // Validate file type and size
                $allowedfileExtensions = ['jpg', 'gif', 'png', 'pdf', 'doc', 'docx', 'txt'];
                $maxFileSize = 10 * 1024 * 1024; // 10 MB limit

                if (in_array($fileExtension, $allowedfileExtensions) && $fileSize <= $maxFileSize) {
                    // Define the upload directory
                    $uploadFileDir = '../../upload_message/';
                    
                    // Generate a unique file name using only the original filename
                    $newFileName = uniqid('file_', true) . '.' . $fileExtension; // Keep the extension
                    
                    // Full destination path
                    $dest_path = $uploadFileDir . $newFileName;

                    // Move the file
                    if (move_uploaded_file($fileTmpPath, $dest_path)) {
                        echo 'Message sent successfully! File uploaded to: ' . $dest_path; // Plain text response
                    } else {
                        echo 'Error moving uploaded file.'; // Plain text response
                    }
                } else {
                    echo 'Invalid file type or size exceeded.'; // Plain text response
                }
            } else {
                echo $messageResponse; // Plain text response for message only
            }

    } else {
        echo $messageResponse; // Plain text response for error in message sending
    }
} else {
    echo 'Access Denied! No Request Type.'; // Plain text response
}
