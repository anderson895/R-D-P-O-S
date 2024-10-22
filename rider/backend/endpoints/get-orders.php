<?php
session_start();
include('../class.php');
$db = new global_class();

if (isset($_SESSION['acc_id'])) {
    $userId  = $_SESSION['acc_id'];
    $getUser = $db->checkUser($userId);
    if ($getUser->num_rows > 0) {
        $user = $getUser->fetch_assoc();
        if (isset($_GET['page'])) {
            $page = $_GET['page'];

            $getOrders = $db->getOrdersSetToRider($userId, $page);
            if ($getOrders->num_rows > 0) {
                while ($order = $getOrders->fetch_assoc()) {
?>
                    <tr class="orders-tr">
                        <td>
                            <a href="view-order.php?orderId=<?= $order['order_id'] ?>" class="btn text-light" style="background-color: crimson;">
                                <!-- <i class="bi bi-eye"></i>  -->
                                <?= $order['order_id'] ?></a>
                        </td>
                        <td>₱<?= number_format( $order['subtotal'],2) ?></td>
                        <td>₱<?= number_format( $order['vat'],2) ?></td>
                        <td>₱<?= number_format($order['sf'],2) ?></td>
                        <td>₱<?= number_format( $order['total'],2) ?></td>
                        <td><?= date('F j, Y g:i A', strtotime($order['order_date'])) ?></td>
                        <?= ($page == 'Delivered') ? '<td>' . date('F j, Y', strtotime($order['estimated_delivery'])) . '</td>' : '' ?>
                        <?= ($page == 'Delivered') ? '<td>' . date('F j, Y g:i A', strtotime($order['delivered_date'])) . '</td>' : '' ?>
                    </tr>
                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="7" style="text-align: center;">No Order Found.</td>
                </tr>
<?php
            }
        }
    }
}
