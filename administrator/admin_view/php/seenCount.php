<?php 


include("../.../../../../connection.php");
// Check kung may error sa pagkonekta
if ($connections->connect_error) {
    die("Connection failed: " . $connections->connect_error);
}

// Kung ang action na ipinapasa mula sa AJAX ay 'update_notification'
if ($_POST['action'] === 'update_notification') {
    // I-update ang users_log table
    $sql = "UPDATE users_log SET act_seen = 1";
    if ($connections->query($sql) === TRUE) {
        echo "Notification updated successfully.";
    } else {
        echo "Error updating notification: " . $coconnectionsnn->error;
    }
}

?>