<?php
include('../class.php');
$db = new global_class();

session_start();


if (isset($_GET['page'])) {
    $page = $_GET['page'];
    $orders = $db->getCodCollected($_SESSION['acc_id']);
    if ($orders->num_rows > 0) {
        while ($order = $orders->fetch_assoc()) {
            $getRider = $db->checkId('account', 'acc_id', $order['rider_id']);
            $riderName = 'NA';
            if ($getRider->num_rows > 0) {
                $rider =  $getRider->fetch_assoc();
                $riderName = $rider['acc_fname'] . ' ' . $rider['acc_lname'];
            }

            


?>
            <tr class="orders-tr">
                <td>
                    <!-- <a href="view-collected.php?rider_id=<?= $order['rider_id'] ?>" class="btn text-light" style="background-color: crimson;"><i class="bi bi-eye"></i> <?= $order['acc_code'] ?></a> -->
                   <?= $order['customer_code'] ?>
           
                </td>
                
                <td><?= ucfirst($order['customer_name']); ?></td>
                <td>₱ <?= $order['total_sales'] ?></td>

                                
                
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
