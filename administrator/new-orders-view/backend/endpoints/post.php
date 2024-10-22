<?php
include('../class.php');
$db = new global_class();

if (isset($_POST['requestType'])) {

    $estimatedDelivery = !empty($_POST['estimatedDelivery']) ? $_POST['estimatedDelivery'] : "";



    if ($_POST['requestType'] == 'UpgradeOrderStatus') {
        if(isset($_POST['deliveredItem'])){
            echo $db->changeOrderStatusToDelivered($_POST['orderId'], $_FILES['proofOfDel']);
        } else {
            echo $db->changeOrderStatus($_POST['orderId'],$estimatedDelivery);
        }
    } elseif ($_POST['requestType'] == 'RejectOrder') {
        echo $db->rejectOrder($_POST['orderId'],$_POST['rejectReason']);
    } elseif ($_POST['requestType'] == 'SelectRider') {
        echo $db->changeOrderRider($_POST['orderId'], $_POST['riderId']);
    }
}
