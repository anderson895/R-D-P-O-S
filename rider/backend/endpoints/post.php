<?php
include('../class.php');
$db = new global_class();

if (isset($_POST['requestType'])) {
    if ($_POST['requestType'] == 'UpgradeOrderStatus') {
        echo $db->productDelivered($_POST['orderId'], $_FILES['proofOfDel']);
    }
}
