<?php 


print_r($_FILES);
?>

<?php
include "../.../../../../connection.php";
date_default_timezone_set('Asia/Manila');

session_start();
$session_acc_id = $_SESSION["acc_id"];
$account_id = $_POST['account_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file = $_FILES['audio'];
   

    if ($file['error'] === UPLOAD_ERR_OK) {
        $file_name = $file['name'];
        $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);

        if (strtolower($file_extension) === 'wav') {
            $targetDir = '../.../../../../upload_message/'; // Baguhin ang desired directory path
            $uniqueFilename = uniqid() . '.' . $file_extension;
            $targetPath = $targetDir . $uniqueFilename;

            if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                // Ang file ay na-moved ng maayos
                $message = $uniqueFilename; // Itakda ang message sa pangalan ng file
                $type = 'audio'; // Itakda ang message type sa 'audio' para sa .wav files
            } else {
                echo 'Error uploading attachment';
                exit; // I-exit ang script kung may error
            }
        } else {
            echo 'Invalid file type. Please upload a .wav file.';
            exit; // I-exit ang script kung hindi tanggap na file type ang na-upload
        }
    }

    $sql = "INSERT INTO messages (mess_sender_id, mess_content, mess_type, mess_status, mess_reciever_id, mess_date, mess_seen) VALUES (?, ?, ?, ?, ?, NOW(), ?)";
    $stmt = mysqli_prepare($connections, $sql);

    $sender_id = $session_acc_id;
    $status = 0;
    $receiver_id = $account_id;
    $seen = 0;

    mysqli_stmt_bind_param($stmt, 'ssssii', $sender_id, $message, $type, $status, $receiver_id, $seen);

    if (mysqli_stmt_execute($stmt)) {
        echo 'Data inserted successfully';
    } else {
        echo 'Error: ' . mysqli_error($connections);
    }

    mysqli_stmt_close($stmt);
}
?>
