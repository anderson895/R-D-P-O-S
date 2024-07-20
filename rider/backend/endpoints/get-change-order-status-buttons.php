<?php
session_start();
include('../class.php');
$db = new global_class();

if (isset($_SESSION['acc_id'])) {
    $userId  = $_SESSION['acc_id'];
    $getUser = $db->checkUser($userId);
    if ($getUser->num_rows > 0) {
        $user = $getUser->fetch_assoc();
        if (isset($_GET['orderId'])) {
            $orderId = $_GET['orderId'];
            $getOrder = $db->checkId('new_tbl_orders', 'order_id', $orderId);
            if ($getOrder->num_rows > 0) {
                $order = $getOrder->fetch_assoc();
                if ($order['status'] == 'Shipped') {
?>
                    <button class="btn btn-success btnUpgradeStatus" data-id="<?= $orderId ?>"><i class="bi bi-check-square"></i> Delivered</button>
<?php
                }
            }
        }
    }
}
