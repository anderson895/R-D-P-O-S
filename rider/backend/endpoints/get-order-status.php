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
?>
                <div class="input-container-label-top m-2 <?= ($order['status'] == 'Cancelled' || $order['status'] == 'Rejected') ? 'text-danger' : '' ?>">
                    <label>Status</label>
                    <input type="text" readonly class="form-control <?= ($order['status'] == 'Cancelled' || $order['status'] == 'Rejected') ? 'text-danger' : '' ?>" value="<?= $order['status'] ?>">
                </div>
<?php
            }
        }
    }
}
