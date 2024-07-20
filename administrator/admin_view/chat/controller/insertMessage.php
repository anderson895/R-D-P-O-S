<?php
include("../.../../../../../connection.php");
date_default_timezone_set('Asia/Manila');
$currentDateTime = date('Y-m-d H:i:s');


session_start();
$session_acc_id = $_SESSION["acc_id"];
$account_id = $_POST['account_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file = $_FILES['file'];
    $message = $_POST['message'] ?? '';

    $type = 'texts'; // Default type to texts

    if ($file['error'] === UPLOAD_ERR_OK) {
        $file_name = $file['name'];
        $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
        
        if (in_array(strtolower($file_extension), ['png','webp', 'jpg', 'jpeg', 'gif', 'pdf', 'doc', 'docx', 'txt', 'mp4', 'avi', 'mov'])) {
            $targetDir = '../.../../../../../upload_message/'; // Baguhin ang desired directory path
            $uniqueFilename = uniqid() . '.' . $file_extension;
            $targetPath = $targetDir . $uniqueFilename;

            if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                // Ang file ay na-moved ng maayos
                $message = $uniqueFilename; // Itakda ang message sa pangalan ng file
                $type = (in_array(strtolower($file_extension), ['png','webp', 'jpg', 'jpeg', 'gif'])) ? 'image' : (in_array(strtolower($file_extension), ['pdf', 'doc', 'docx', 'txt']) ? 'document' : 'video');
            } else {
                echo 'Error uploading attachment';
                exit; // I-exit ang script kung may error
            }
        } else {
            echo 'Invalid file type';
            exit; // I-exit ang script kung hindi tanggap na file type ang na-upload
        }
    }

    $sql = "INSERT INTO messages (mess_sender_id, mess_content, mess_type, mess_status, mess_reciever_id, mess_date, mess_seen) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($connections, $sql);
    
    $sender_id = $session_acc_id;
    $status = 0;
    $receiver_id = $account_id;
    $seen = 0;

    mysqli_stmt_bind_param($stmt, 'ssssisi', $sender_id, $message, $type, $status, $receiver_id, $currentDateTime, $seen);

    if (mysqli_stmt_execute($stmt)) {
        echo 'Data inserted successfully';
    } else {
        echo 'Error: ' . mysqli_error($connections);
    }

    mysqli_stmt_close($stmt);
}
?>
