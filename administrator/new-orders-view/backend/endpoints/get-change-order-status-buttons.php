<?php
include('../class.php');
$db = new global_class();

if (isset($_GET['orderId'])) {
    $orderId = $_GET['orderId'];
    $getOrder = $db->checkId('new_tbl_orders', 'order_id', $orderId);
    if ($getOrder->num_rows > 0) {
        $order = $getOrder->fetch_assoc();
        $orderStatus = $order['status'];
        if ($orderStatus == 'Pending') {
?>

<?php 
$paymentType = $order['payment_id'];
if ($paymentType != 'COD') {
    $getPaymentType = $db->checkId('mode_of_payment', 'payment_id', $paymentType);
    if ($getPaymentType->num_rows > 0) {
        $paymentTypeResult = $getPaymentType->fetch_assoc();
        $paymentType = $paymentTypeResult['payment_name'];
    }
}

// adddress
$delAddress = '';
$orderBy = '';
$userId = $order['cust_id'];

$getAddress = $db->getUserAddress($userId);
if($getAddress->num_rows > 0) {
    $address = $getAddress->fetch_assoc();
    $delAddress = $address['user_complete_address'];

    $assignRider = $address['address_rider'];
    $orderBy = $address['acc_fname'].' '.$address['acc_lname'];
    $userCode = $address['acc_code'];

    $cutoff = $address['cutoff'];
}

$current_time = date("H:i:s");

if ($current_time < $cutoff || $cutoff ===null) {
    $cutoffStatus = ''; 
    ?>
    <button <?=$cutoffStatus?> class="btn btn-success btnUpgradeStatus" data-id="<?= $orderId ?>" data-currstats="<?= $orderStatus ?>"><i class="bi bi-check2"></i> Accept</button>
    <button class="btn btn-danger btnRejectOrder" data-id="<?= $orderId ?>"><i class="bi bi-x-lg"></i> Reject</button>
    <?php
} else {
   
$cutoffStatus = '<i class="text-danger">Unable to Accept Orders<br> Cutoff Time Reached</i>'; 
   
}?>

        <?php echo $cutoffStatus?>

          
        <?php
        } elseif ($orderStatus == 'Accepted') {
        ?>
            <button class="btn btn-success btnUpgradeStatus" data-id="<?= $orderId ?>" data-currstats="<?= $orderStatus ?>"><i class="bi bi-box-fill"></i> Order Packed</button>
            <button class="btn btn-danger btnRejectOrder" data-id="<?= $orderId ?>"><i class="bi bi-x-lg"></i> Cancel</button>
        <?php
        } elseif ($orderStatus == 'Ready For Delivery') {
        ?>
            <button class="btn btn-success btnUpgradeStatus" data-id="<?= $orderId ?>" data-currstats="<?= $orderStatus ?>"><i class="bi bi-truck"></i> Proceed to Delivery</button>
            <!-- <button class="btn btn-danger btnRejectOrder" data-id="<?= $orderId ?>"><i class="bi bi-x-lg"></i> Cancel</button> -->
        <?php
        } elseif ($orderStatus == 'Shipped') {
        ?>
            <button class="btn btn-success btnUpgradeStatus" data-id="<?= $orderId ?>" data-currstats="<?= $orderStatus ?>"><i class="bi bi-check-square"></i> Delivered</button>
            <!-- <button class="btn btn-danger btnRejectOrder" data-id="<?= $orderId ?>"><i class="bi bi-x-lg"></i> Cancel</button> -->
<?php
        }
    }
}
