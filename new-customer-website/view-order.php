<?php
include ('components/header.php');
function backToPendingOrders()
{
    header("Location: orders.php?page=Pending");
    exit;
}

if (isset($_GET['orderId'])) {
    $orderId = $_GET['orderId'];
    $getOrders = $db->checkId('new_tbl_orders', 'order_id', $orderId);
    if ($getOrders->num_rows < 1) {
        backToPendingOrders();
    }
} else {
    backToPendingOrders();
}

$order = $getOrders->fetch_assoc();
$getOrderItems = $db->getUserOrderItems($orderId);
if ($getOrderItems->num_rows < 1) {
    backToPendingOrders();
}

// get rider
$rider = 'Pending';
$accContactNo = 'Pending';
$riderContactNo = 'Pending';
if ($order['rider_id'] != '') {
    $getRider = $db->checkUser($order['rider_id']);
    if ($getRider->num_rows > 0) {
        $riderResult = $getRider->fetch_assoc();
        $rider = $riderResult['acc_fname'] . ' ' . $riderResult['acc_lname'];
        $riderContactNo = $riderResult['acc_contact'];
    }
}

// payment type
$paymentType = $order['payment_id'];
if ($paymentType != 'COD') {
    $getPaymentType = $db->checkId('mode_of_payment', 'payment_id', $paymentType);
    if ($getPaymentType->num_rows > 0) {
        $paymentTypeResult = $getPaymentType->fetch_assoc();
        $paymentType = $paymentTypeResult['payment_name'];
    }
}

// User Address
$getAddress = $db->getUserAddress($order['cust_id']);
$userAddress = '';
if ($getAddress->num_rows > 0) {
    $address = $getAddress->fetch_assoc();
    $userAddress = $address['address'];
}

?>
<div class="d-flex justify-content-between">
    <a href="orders.php?page=<?= $order['status'] ?>" class="btn" style="font-size: 20px;"><i
            class="bi bi-arrow-return-left"></i> Back</a>
    <?=
        ($order['status'] == 'Pending' || $order['status'] == 'Accepted') ? '<button type="button" class="btn btn-danger" id="btnCancelOrder" data-id="' . $orderId . '"><i class="bi bi-x-lg"></i> Cancel Order</button>' : '';
    ?>
</div>

<div class="container mt-3">
    <div class="d-flex justify-content-between flex-wrap">
        <div class="input-container-label-top m-2">
            <label>Order ID</label>
            <input type="text" readonly class="form-control" value="<?= $order['order_id'] ?>">
        </div>
        <div
            class="input-container-label-top m-2 <?= ($order['status'] == 'Cancelled' || $order['status'] == 'Rejected') ? 'text-danger' : '' ?>">
            <label>Status</label>
            <input type="text" readonly
                class="form-control <?= ($order['status'] == 'Cancelled' || $order['status'] == 'Rejected') ? 'text-danger' : '' ?>"
                value="<?= ($order['status'] == 'Shipped') ? "Ongoing Delivery" : $order['status'] ?>">
        </div>
    </div>
    <?php
    if ($order['status'] == 'Rejected') {
        ?>
        <div class="input-container-label-top m-2">
            <label>Reject Reason</label>
            <textarea class="form-control" readonly><?= $order['reject_reason'] ?></textarea>
        </div>
        <?php
    }
    ?>
    <table class="table">
        <thead>
            <tr>
                <td colspan="4">
                    <h5 style="font-weight: 700;" class="mt-3 mb-2 text-secondary">
                        <i class="bi bi-feather"></i> Items
                    </h5>
                </td>
            </tr>
            <tr>
                <th class="">#</th>
                <th class="">Item</th>
                <th class="">Quantity</th>
                <th class="">Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count = 1;
            while ($orderItem = $getOrderItems->fetch_assoc()) {
                ?>
                <tr style="font-size: 0.9rem;">
                    <td class="pt-3"><?= $count ?></td>
                    <td class="">
                        <img src="../upload_prodImg/<?= $orderItem['prod_image'] ?>" style="height: 40px; width: 40px;">
                        <?= $orderItem['prod_name'] ?>
                    </td>
                    <td class="pt-3"><?= $orderItem['qty'] . ' x ' . $orderItem['prod_currprice'] ?></td>
                    <td class="pt-3"><?= $orderItem['qty'] * $orderItem['prod_currprice'] ?></td>
                </tr>
                <?php
                $count++;
            }
            ?>
            <tr>
                <td colspan="4">
                    <h5 style="font-weight: 700;" class="mt-5 mb-2 text-secondary">
                        <i class="bi bi-currency-exchange"></i> Order Details
                    </h5>
                </td>
            </tr>
            <tr>
                <td class="justify-content-between"><span class="" style="font-weight: 600;">Subtotal:</span></td>
                <td></td>
                <td></td>
                <td class="justify-content-between"><span class=""
                        style="font-weight: 600;"><?= $order['subtotal'] ?></span></td>
            </tr>
            <tr>
                <td class="justify-content-between"><span class="" style="font-weight: 600;">Vat:</span></td>
                <td></td>
                <td></td>
                <td class="justify-content-between"><span class="" style="font-weight: 600;"><?= $order['vat'] ?></span>
                </td>
            </tr>
            <tr>
                <td class="justify-content-between"><span class="" style="font-weight: 600;">Shipping Fee:</span></td>
                <td></td>
                <td></td>
                <td class="justify-content-between"><span class="" style="font-weight: 600;"><?= $order['sf'] ?></span>
                </td>
            </tr>
            <tr>
                <td class="justify-content-between"><span class="text-success" style="font-weight: 700;">Total:</span>
                </td>
                <td></td>
                <td></td>
                <td class="justify-content-between"><span class="text-success"
                        style="font-weight: 700;"><?= $order['total'] ?></span></td>
            </tr>
            <tr>
                <td colspan="4">
                    <h5 style="font-weight: 700;" class="mt-5 mb-2 text-secondary">
                        <i class="bi bi-truck"></i> Delivery Details
                    </h5>
                </td>
            </tr>
            <tr>
                <td class="justify-content-between"><span style="font-weight: 600;">Address:</span></td>
                <td></td>
                <td></td>
                <td class="justify-content-between"><span style="font-weight: 600;"><?= $userAddress ?></span></td>
            </tr>
            <tr>
                <td class="justify-content-between"><span style="font-weight: 600;">Order Date:</span></td>
                <td></td>
                <td></td>
                <td class="justify-content-between"><span
                        style="font-weight: 600;"><?= (new DateTime($order['order_date']))->format('F j, Y, g:i a') ?></span>
                </td>
            </tr>
            <?php
            if ($order['status'] == 'Delivered') {
                ?>
                <tr>
                    <td class="justify-content-between"><span style="font-weight: 600;">Delivered Date:</span></td>
                    <td></td>
                    <td></td>
                    <td class="justify-content-between"><span
                            style="font-weight: 600;"><?= (new DateTime($order['delivered_date']))->format('F j, Y, g:i a') ?></span>
                    </td>
                </tr>
                <?php
            }
            ?>
            <tr>
                <td class="justify-content-between"><span style="font-weight: 600;">Delivery Rider:</span></td>
                <td></td>
                <td></td>
                <td class="justify-content-between"><span style="font-weight: 600;"><?= $rider ?></span></td>
            </tr>
            <tr>
                <td class="justify-content-between"><span style="font-weight: 600;">Delivery Contact No:</span></td>
                <td></td>
                <td></td>
                <td class="justify-content-between"><span style="font-weight: 600;"><?= $riderContactNo ?></span></td>
            </tr>
            <tr>
                <td colspan="4">
                    <h5 style="font-weight: 700;" class="mt-5 mb-2 text-secondary">
                        <i class="bi bi-credit-card-2-back"></i> Payment Details
                    </h5>
                </td>
            </tr>
            <tr>
                <td class="justify-content-between"><span style="font-weight: 600;">Payment Type:</span></td>
                <td></td>
                <td></td>
                <td class="justify-content-between"><span style="font-weight: 600;"><?= $paymentType ?></span></td>
            </tr>
            <?php
            if ($paymentType != 'COD') {
                ?>
                <tr>
                    <td colspan="4" class="text-center">
                        <center class="mt-5">
                            <h5 class="text-success">
                                <i>
                                    Proof of Payment
                                </i>
                            </h5>
                        </center>
                        <div class="pof-container container">
                            <img src="backend/proof-of-payment/<?= $order['pof'] ?>" style="max-width: 300px;">
                        </div>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
<?php
include ('components/footer.php');
?>
<script>
    $('.nav-my-orders').addClass('nav-active');
</script>