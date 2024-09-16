<?php 


include("../.../../../../connection.php");
// Check kung may error sa pagkonekta
if ($connections->connect_error) {
    die("Connection failed: " . $connections->connect_error);
}

session_start();
//$acc_id=$_GET["acc_id"];
$acc_id=$_SESSION["acc_id"];
// Kung ang action na ipinapasa mula sa AJAX ay 'update_notification'
if ($_POST['action'] === 'update_notification') {
    // I-update ang users_log table
    $sql = "UPDATE messages SET mess_seen = 1 where (mess_reciever='$acc_id' OR mess_reciever ='Admin') AND mess_seen !='2'";
    if ($connections->query($sql) === TRUE) {
        echo "Notification updated successfully.";
    } else {
        echo "Error updating notification: " . $coconnectionsnn->error;
    }
}

?>