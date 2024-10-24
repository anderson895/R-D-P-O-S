<?php
include('../class.php');
$db = new global_class();

echo "<pre>";
print_r($_POST);
echo "</pre>";

if (isset($_POST['requestType'])) {
    if ($_POST['requestType'] == 'UpgradeOrderStatus') {
        echo $db->productDelivered($_POST['orderId'], $_FILES['proofOfDel']);
    }
}
