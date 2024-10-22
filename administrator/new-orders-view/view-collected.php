<?php
include('components/header.php');
if (isset($_GET['rider_id'])) {
    $page = $_GET['rider_id'];
    if (empty($page)) {
        header("Location: orders.php?page=Collected");
        exit;
    }
} else {
    header("Location: orders.php?page=Collected");
    exit;
}
?>
<div class="container mt-4">
    <div class="overflow-auto">
        <ul class="nav nav-tabs flex-nowrap">
            <li class="nav-item">
                <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'Pending') ? 'active' : '' ?>" href="orders.php?page=Pending">
                    <i class="bi bi-hourglass-split"></i> Pending <span id="pendingCount" class="badge bg-danger">0</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'Accepted') ? 'active' : '' ?>" href="orders.php?page=Accepted">
                    <i class="bi bi-check2-all"></i> Accepted <span id="acceptedCount" class="badge bg-danger">0</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'Ready For Delivery') ? 'active' : '' ?>" href="orders.php?page=Ready For Delivery">
                    <i class="bi bi-box-fill"></i> Ready For Delivery <span id="readyForDeliveryCount" class="badge bg-danger">0</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'Shipped') ? 'active' : '' ?>" href="orders.php?page=Shipped">
                    <i class="bi bi-truck"></i> Ongoing Delivery <span id="shippedCount" class="badge bg-danger">0</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'Delivered') ? 'active' : '' ?>" href="orders.php?page=Delivered">
                    <i class="bi bi-check-square"></i> Delivered <span id="deliveredCount" class="badge bg-danger">0</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'Cancelled') ? 'active' : '' ?>" href="orders.php?page=Cancelled">
                    <i class="bi bi-x-circle"></i> Cancelled <span id="cancelledCount" class="badge bg-danger">0</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'Rejected') ? 'active' : '' ?>" href="orders.php?page=Rejected">
                    <i class="bi bi-exclamation-circle"></i> Rejected <span id="rejectedCount" class="badge bg-danger">0</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'Collected') ? 'active' : '' ?>" href="orders.php?page=Collected">
                    <i class="bi bi-person-square"></i> COD Collected <span id="collectedCount" class="badge bg-danger">0</span>
                </a>
            </li>
        </ul>
    </div>
</div>

<?php 
    if (isset($page)) {
        $orders = $db->getEachCodCollected($page);
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
include('components/footer.php');
