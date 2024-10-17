<?php
include('../class.php');
$db = new global_class();

if (isset($_GET['page'])) {
    $page = $_GET['page'];
    $orders = $db->getOrders($page);
    if ($orders->num_rows > 0) {
        while ($order = $orders->fetch_assoc()) {
            $getRider = $db->checkId('account', 'acc_id', $order['rider_id']);
            $riderName = 'NA';
            if ($getRider->num_rows > 0) {
                $rider =  $getRider->fetch_assoc();
                $riderName = $rider['acc_fname'] . ' ' . $rider['acc_lname'];
            }
            $reason=$order['reject_reason'];
            
?>
            <tr class="orders-tr">
                <td>
                    <a href="view-order.php?orderId=<?= $order['order_id'] ?>" class="btn text-light" style="background-color: crimson;"><i class="bi bi-eye"></i> <?= $order['order_id'] ?></a>
                </td>
                <td>₱<?= number_format( $order['subtotal'],2) ?></td>
                <td>₱<?= number_format($order['vat'],2) ?></td>
                <td>₱<?= number_format( $order['sf'],2) ?></td>
                <td>₱<?= number_format( $order['total'],2) ?></td>
                <td><?= date('F j, Y g:i A', strtotime($order['order_date'])) ?></td>
                <?= ($page == 'Delivered') ? '<td>' . date('F j, Y g:i A', strtotime($order['delivered_date'])) . '</td>' : '' ?>
                <?= ($page == 'Delivered' || $page == 'Shipped') ? '<td>' . ucfirst($riderName) . '</td>' : '' ?>
                <?= ($page == 'Rejected') ? '<td>' . ucfirst($reason) . '</td>' : '' ?>
    
            </tr>
        <?php
        }
    } else {
        ?>
        <tr>
            <td colspan="9" style="text-align: center;">No Order Found.</td>
        </tr>
<?php
    }
}
