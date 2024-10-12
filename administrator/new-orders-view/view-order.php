<?php
include('components/header.php');

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
if ($order['rider_id'] != '') {
    $getRider = $db->checkUser($order['rider_id']);
    if ($getRider->num_rows > 0) {
        $riderResult = $getRider->fetch_assoc();
        $rider = $riderResult['acc_fname'] . ' ' . $riderResult['acc_lname'];
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

// adddress
$delAddress = '';
$orderBy = '';
$userId = $order['cust_id'];
$getAddress = $db->getUserAddress($userId);
if($getAddress->num_rows > 0) {
    $address = $getAddress->fetch_assoc();
    $delAddress = $address['user_complete_address'];
    $orderBy = $address['acc_fname'].' '.$address['acc_lname'];
}
?>
<!-- SweetAlert2 CSS -->
<!-- <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet"> -->

<!-- SweetAlert2 JS -->
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->

<div class="container pt-4">
    <div class="container d-flex justify-content-between">
        <a href="orders.php?page=<?= $order['status'] ?>" class="btn" style="font-size: 20px;"><i class="bi bi-arrow-return-left"></i> Back</a>
        <div id="btnChangeOrderStatusContainer">

        </div>
    </div>
    <div class="container mt-3">
        <div class="d-flex justify-content-between flex-wrap">
            <div class="input-container-label-top m-2">
                <label>Order ID</label>
                <input type="text" readonly class="form-control" value="<?= $order['order_id'] ?>">
            </div>
            <div id="viewOrderStatusContainer">

            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <td colspan="5">
                        
                            <button class="btn btn-secondary" onclick="window.open('waybill.php?orderId=<?=$orderId?>', '_blank')">
                                <i class="bi bi-printer ms-2"></i> Print bill
                            </button>
                            
                            
                        <h5 style="font-weight: 700;" class="mt-3 mb-2 text-secondary">
                                <i class="bi bi-feather"></i> Items  </h5>
                            

                        </td>
                    </tr>
                    <tr>
                        <th class="">#</th>
                        <th class="">Code</th>
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
                            <td class="pt-3"><?=$orderItem['prod_code'] ?></td>
                            <td class="">
                                <img src="../../upload_prodImg/<?=$orderItem['prod_image']?>" style="height: 40px; width: 40px;">
                                <?= $orderItem['prod_name'] ?>
                            </td>
                            <td class="pt-3"><?= $orderItem['qty'] . ' x ' . $orderItem['prod_currprice'] ?></td>
                            <td class="pt-3"><?= number_format($Amount=$orderItem['qty'] * $orderItem['prod_currprice'],2) ?></td>
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
                        <td class="justify-content-between"><span class="" style="font-weight: 600;"><?= $order['subtotal'] ?></span></td>
                    </tr>
                    <tr>
                        <td class="justify-content-between"><span class="" style="font-weight: 600;">Vat:</span></td>
                        <td></td>
                        <td></td>
                        <td class="justify-content-between"><span class="" style="font-weight: 600;"><?= $order['vat'] ?></span></td>
                    </tr>
                    <tr>
                        <td class="justify-content-between"><span class="" style="font-weight: 600;">Shipping Fee:</span></td>
                        <td></td>
                        <td></td>
                        <td class="justify-content-between"><span class="" style="font-weight: 600;"><?= $order['sf'] ?></span></td>
                    </tr>
                    <tr>
                        <td class="justify-content-between"><span class="text-success" style="font-weight: 700;">Total:</span></td>
                        <td></td>
                        <td></td>
                        <td class="justify-content-between"><span class="text-success" style="font-weight: 700;"><?= $order['total'] ?></span></td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <h5 style="font-weight: 700;" class="mt-5 mb-2 text-secondary">
                                <i class="bi bi-truck"></i> Delivery Details
                            </h5>
                        </td>
                    </tr>
                    <tr>
                        <td class="justify-content-between"><span style="font-weight: 600;">Order Date:</span></td>
                        <td></td>
                        <td></td>
                        <td class="justify-content-between"><span style="font-weight: 600;"><?= (new DateTime($order['order_date']))->format('F j, Y, g:i a') ?></span></td>
                    </tr>
                    <tr>
                        <td class="justify-content-between"><span style="font-weight: 600;">Address:</span></td>
                        <td></td>
                        <td></td>
                        <td class="justify-content-between"><span style="font-weight: 600;"><?= $delAddress ?></span></td>
                    </tr>
                    <tr>
                        <td class="justify-content-between"><span style="font-weight: 600;">Order By:</span></td>
                        <td></td>
                        <td></td>
                        <td class="justify-content-between"><span style="font-weight: 600;"><?= $orderBy ?></span></td>
                    </tr>
                    <?php
                    if ($order['status'] == 'Delivered') {
                    ?>
                        <tr>
                            <td class="justify-content-between"><span style="font-weight: 600;">Delivered Date:</span></td>
                            <td></td>
                            <td></td>
                            <td class="justify-content-between"><span style="font-weight: 600;"><?= (new DateTime($order['delivered_date']))->format('F j, Y, g:i a') ?></span></td>
                        </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td class="justify-content-between"><span style="font-weight: 600;">Delivery Rider:</span></td>
                        <td></td>
                        <td></td>
                        <td class="justify-content-between">
                            <span style="font-weight: 600;" id="selectRiderContainer">

                            </span>
                        </td>
                    </tr>
                    <?php
                    if ($order['status'] == 'Delivered') {
                        ?>
                        <tr>
                            <td colspan="4" class="text-center">
                                <center class="mt-5">
                                    <h5 class="text-success">
                                        <i>
                                            Proof of Delivery
                                        </i>
                                    </h5>
                                </center>
                                <div class="pof-container container">
                                    <img src="../../rider/backend/proof-of-del/<?= $order['proof_of_del'] ?>" style="max-width: 300px;">
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
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
                                    <img src="../../new-customer-website/backend/proof-of-payment/<?= $order['pof'] ?>" style="max-width: 300px;" >
                                </div>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
include('components/footer.php');
