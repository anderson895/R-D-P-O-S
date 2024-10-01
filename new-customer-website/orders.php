<?php
include('components/header.php');
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    if ($page != 'Pending' && $page != 'Accepted' && $page != 'Ready For Delivery' && $page != 'Shipped' && $page != 'Delivered' && $page != 'Cancelled' && $page != 'Rejected') {
        header("Location: orders.php?page=Pending");
        exit;
    }
} else {
    header("Location: orders.php?page=Pending");
    exit;
}
?>
<div class="d-flex justify-content-between">
    <h2><i class="bi bi-newspaper"></i> My Orders <span style="font-size: 15px; color:crimson"><?= $page ?></span></h2>
</div>

<div class="container mt-5">
    <ul class="nav nav-tabs remove-when-767px-sc-width">
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
                <i class="bi bi-box-fill"></i> Ready For Delivery <span id="readyDeliveryCount" class="badge bg-danger">0</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'Shipped') ? 'active' : '' ?>" href="orders.php?page=Shipped">
                <i class="bi bi-truck"></i> Ongoing Delivery <span id="ongoingCount" class="badge bg-danger">0</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'Delivered') ? 'active' : '' ?>" href="orders.php?page=Delivered">
                <i class="bi bi-check-square"></i> Delivered <span id="deliveredCount" class="badge bg-danger">0</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'Cancelled') ? 'active' : '' ?>" href="orders.php?page=Cancelled">
                <i class="bi bi-x-circle"></i> Cancelled <span id="CancelledCount" class="badge bg-danger">0</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'Rejected') ? 'active' : '' ?>" href="orders.php?page=Rejected">
                <i class="bi bi-exclamation-circle"></i> Rejected <span id="RejectedCount" class="badge bg-danger">0</span>
            </a>
        </li>
    </ul>

    <div class="input-container-label-top show-only-when-767px-sc-width">
        <label for="orderSelectPage">Select Order Status</label>
        <select class="form-control" id="orderSelectPage">
            <option value="Pending" <?= ($page == 'Pending') ? 'selected' : '' ?>>Pending</option>
            <option value="Accepted" <?= ($page == 'Accepted') ? 'selected' : '' ?>>Accepted</option>
            <option value="Ready For Delivery" <?= ($page == 'Ready For Delivery') ? 'selected' : '' ?>>Ready For Delivery</option>
            <option value="Shipped" <?= ($page == 'Shipped') ? 'selected' : '' ?>>Shipped</option>
            <option value="Delivered" <?= ($page == 'Delivered') ? 'selected' : '' ?>>Delivered</option>
            <option value="Cancelled" <?= ($page == 'Cancelled') ? 'selected' : '' ?>>Cancelled</option>
            <option value="Rejected" <?= ($page == 'Rejected') ? 'selected' : '' ?>>Rejected</option>
        </select>
    </div>

    <div class="orders-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Subtotal</th>
                    <th>VAT</th>
                    <th>Shipping Fee</th>
                    <th>Total</th>
                    <th>Order Date</th>
                    <?= ($page == 'Delivered') ? '<th>Delivery Date</th>' : '' ?>
                    <?= ($page == 'Delivered' || $page == 'Shipped') ? '<th>Rider</th>' : '' ?>
                    <?= ($page == 'Rejected') ? '<th>Reject Reason</th>' : '' ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $getOrders = $db->getUserOrders($user['acc_id'], $page);
                if ($getOrders->num_rows > 0) {
                    while ($order = $getOrders->fetch_assoc()) {
                ?>
                        <tr class="orders-tr">
                            <td>
                                <a href="view-order.php?orderId=<?= $order['order_id'] ?>" class="btn text-light" style="background-color: crimson;"><i class="bi bi-eye"></i> <?= $order['order_id'] ?></a>
                            </td>
                            <td><?= $order['subtotal'] ?></td>
                            <td><?= $order['vat'] ?></td>
                            <td><?= $order['sf'] ?></td>
                            <td><?= $order['total'] ?></td>
                            <td><?= date('F j, Y g:i A', strtotime($order['order_date'])) ?></td>
                            <?= ($page == 'Delivered') ? '<td>' . $order['delivered_date'] . '</td>' : '' ?>
                            <?= ($page == 'Delivered' || $page == 'Shipped') ? '<td>' . ucfirst($order['acc_fname']) . ' ' . $order['acc_lname'] . '</td>' : '' ?>
                            <?= ($page == 'Rejected') ? '<td>' . $order['reject_reason'] . '</td>' : '' ?>
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
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php
include('components/footer.php');
?>
<script>
    $('.nav-my-orders').addClass('nav-active');
</script>