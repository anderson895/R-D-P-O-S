<?php
include('components/header.php');
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    if (!in_array($page, ['Pending', 'Accepted', 'Ready For Delivery', 'Shipped', 'Delivered', 'Cancelled', 'Rejected'])) {
        header("Location: orders.php?page=Pending");
        exit;
    }
} else {
    header("Location: orders.php?page=Pending");
    exit;
}
?>

<div class="container mt-5">
    <div class="d-flex justify-content-between">
        <h2><i class="bi bi-newspaper"></i> My Orders <span class="text-danger" style="font-size: 15px;"><?= $page ?></span></h2>
    </div>

    <!-- Navigation Tabs for larger screens -->
    <ul class="nav nav-tabs d-none d-md-flex mt-3">
        <?php 
        $statuses = ['Pending', 'Accepted', 'Ready For Delivery', 'Shipped', 'Delivered', 'Cancelled', 'Rejected'];
        $icons = ['hourglass-split', 'check2-all', 'box-fill', 'truck', 'check-square', 'x-circle', 'exclamation-circle'];
        foreach ($statuses as $index => $status): ?>
            <li class="nav-item">
                <a class="nav-link <?= ($page == $status) ? 'active' : '' ?>" href="orders.php?page=<?= $status ?>">
                    <i class="bi bi-<?= $icons[$index] ?>"></i> <?= $status ?> <span id="<?= strtolower(str_replace(' ', '', $status)) ?>Count" class="badge bg-danger">0</span>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- Dropdown for smaller screens -->
    <div class="d-block d-md-none mt-3">
        <label for="orderSelectPage">Select Order Status</label>
        <select class="form-select" id="orderSelectPage" onchange="location = this.value;">
            <?php foreach ($statuses as $status): ?>
                <option value="orders.php?page=<?= $status ?>" <?= ($page == $status) ? 'selected' : '' ?>><?= $status ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Orders Table -->
    <div class="table-responsive mt-4">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Subtotal</th>
                    <th>VAT</th>
                    <th>Shipping Fee</th>
                    <th>Total</th>
                    <th>Order Date</th>
                    <?php if ($page == 'Delivered'): ?><th>Delivery Date</th><?php endif; ?>
                    <?php if (in_array($page, ['Delivered', 'Shipped'])): ?><th>Rider</th><?php endif; ?>
                    <?php if ($page == 'Rejected'): ?><th>Reject Reason</th><?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $getOrders = $db->getUserOrders($user['acc_id'], $page);
                if ($getOrders->num_rows > 0) {
                    while ($order = $getOrders->fetch_assoc()) {
                ?>
                        <tr>
                            <td>
                                <a href="view-order.php?orderId=<?= $order['order_id'] ?>" class="btn btn-sm text-light" style="background-color: crimson;"><i class="bi bi-eye"></i> <?= $order['order_id'] ?></a>
                            </td>
                            <td>₱<?= number_format($order['subtotal'],2) ?></td>
                            <td>₱<?= number_format($order['vat'],2) ?></td>
                            <td>₱<?= number_format($order['sf'],2) ?></td>
                            <td>₱<?= number_format($order['total'],2) ?></td>
                            <td><?= date('F j, Y g:i A', strtotime($order['order_date'])) ?></td>
                            <?php if ($page == 'Delivered'): ?><td><?= date('F j, Y g:i A', strtotime($order['delivered_date'])) ?></td><?php endif; ?>
                            <?php if (in_array($page, ['Delivered', 'Shipped'])): ?><td><?= ucfirst($order['acc_fname']) . ' ' . $order['acc_lname'] ?></td><?php endif; ?>
                            <?php if ($page == 'Rejected'): ?><td><?= $order['reject_reason'] ?></td><?php endif; ?>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="7" class="text-center">No Order Found.</td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include('components/footer.php'); ?>

<script>
    document.getElementById('orderSelectPage').addEventListener('change', function () {
        window.location.href = this.value;
    });
    document.querySelector('.nav-my-orders').classList.add('nav-active');
</script>
