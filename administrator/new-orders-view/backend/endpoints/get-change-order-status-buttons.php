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
            <button class="btn btn-success btnUpgradeStatus" data-id="<?= $orderId ?>" data-currstats="<?= $orderStatus ?>"><i class="bi bi-check2"></i> Accept</button>
            <button class="btn btn-danger btnRejectOrder" data-id="<?= $orderId ?>"><i class="bi bi-x-lg"></i> Reject</button>
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
