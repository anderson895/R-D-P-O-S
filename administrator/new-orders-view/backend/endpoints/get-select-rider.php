<?php
session_start();
include('../class.php');
$db = new global_class();

$checkUser = $db->checkUser($_SESSION['acc_id']);
$user = $checkUser->fetch_assoc();

if (isset($_GET['orderId'])) {
    $orderId = $_GET['orderId'];
    $getOrder = $db->checkId('new_tbl_orders', 'order_id', $orderId);
    if ($getOrder->num_rows > 0) {
        $order = $getOrder->fetch_assoc();
        $riderId = $order['rider_id'];

        if ($order['status'] == 'Pending' || $order['status'] == 'Accepted' || $order['status'] == 'Ready For Delivery') {
?>
            <select class="form-control" id="selectRider" data-id="<?= $order['order_id'] ?>">
                <option selected disabled>Select Rider</option>
                <option value="<?= $user['acc_id'] ?>" <?= ($user['acc_id'] == $order['rider_id']) ? 'selected' : '' ?>><?= $user['acc_fname'] . ' ' . $user['acc_lname'] ?></option>
                <?php
                $getRiders = $db->getUserType('deliveryStaff');
                while ($rider = $getRiders->fetch_assoc()) {
                ?>
                    <option value="<?= $rider['acc_id'] ?>" <?= ($rider['acc_id'] == $order['rider_id']) ? 'selected' : '' ?>><?= $rider['acc_fname'] . ' ' . $rider['acc_lname'] ?></option>
                <?php
                }
                ?>
            </select>
<?php
        } else {
            $riderName = 'N/A';
            $getRider = $db->checkId('account', 'acc_id', $riderId);
            if ($getRider->num_rows > 0) {
                $rider = $getRider->fetch_assoc();
                $riderName = $rider['acc_fname'] . ' ' . $rider['acc_lname'];
                echo $riderName;
            } else {
                echo $riderName;
            }
        }
    }
}
