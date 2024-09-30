<?php
include('../class.php');
$db = new global_class();
session_start();
$userId = $_SESSION['acc_id'];

$currpass = $_POST['currpass'];
$newpass = $_POST['newpass'];
$confpass = $_POST['confpass'];


    if (isset($_POST['requestType'])) {
        if ($_POST['requestType'] == 'updatePass') {

            // Hash the passwords using SHA256
            $hashed_currpass = hash('sha256', $currpass);
            $hashed_newpass = hash('sha256', $newpass);
            $hashed_confpass = hash('sha256', $confpass);

            // Now pass the hashed passwords to the updatePass method
            echo $db->updatePass($hashed_currpass, $hashed_newpass, $hashed_confpass);

        } else {
            echo 'Else';
        }
    } else {
        echo 'Access Denied! No Request Type.';
    }

?>
