<?php
include('../class.php');
$db = new global_class();


$sender_id = $_POST['mess_sender_id'];
$sender_Messages = $_POST['sender_Messages'];


    echo "<pre>";
    print_r($_POST);
    echo "</pre>";




    // if (isset($_POST['requestType'])) {
    //     if ($_POST['requestType'] == 'SentMessage') {
    //         echo $db->sentMessage($sender_id, $sender_Messages);
        
    //     } else {
    //         echo 'Else';
    //     }
    // } else {
    //     echo 'Access Denied! No Request Type.';
    // }
