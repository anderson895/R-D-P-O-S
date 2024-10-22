<?php
include('../class.php');
$db = new global_class();

if (isset($_GET['orderId'])) {
    $orderId = $_GET['orderId'];
    $getOrder = $db->checkId('new_tbl_orders', 'order_id', $orderId);
    if ($getOrder->num_rows > 0) {
        $order = $getOrder->fetch_assoc();
?>
        <div class="input-container-label-top m-2 <?= ($order['status'] == 'Cancelled' || $order['status'] == 'Rejected') ? 'text-danger' : '' ?>">
            <label>Status</label>
            <input type="text" id="OrdStatus" readonly class="form-control <?= ($order['status'] == 'Cancelled' || $order['status'] == 'Rejected') ? 'text-danger' : '' ?>" value="<?= ($order['status'] == 'Shipped') ? 'Ongoing Delivery' : $order['status'] ?>">
        </div>
<?php
    }
}
