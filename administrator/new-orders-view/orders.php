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
<div class="container mt-4">
        <div class="overflow-auto">
            <ul class="nav nav-tabs flex-nowrap">
                <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'Pending') ? 'active' : '' ?>" href="orders.php?page=Pending"><i class="bi bi-hourglass-split"></i> Pending</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'Accepted') ? 'active' : '' ?>" href="orders.php?page=Accepted"><i class="bi bi-check2-all"></i> Accepted</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'Ready For Delivery') ? 'active' : '' ?>" href="orders.php?page=Ready For Delivery"><i class="bi bi-box-fill"></i> Ready For Delivery</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'Shipped') ? 'active' : '' ?>" href="orders.php?page=Shipped"><i class="bi bi-truck"></i> Ongoing Delivery</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'Delivered') ? 'active' : '' ?>" href="orders.php?page=Delivered"><i class="bi bi-check-square"></i> Delivered</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'Cancelled') ? 'active' : '' ?>" href="orders.php?page=Cancelled"><i class="bi bi-x-circle"></i> Cancelled</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'Rejected') ? 'active' : '' ?>" href="orders.php?page=Rejected"><i class="bi bi-exclamation-circle"></i> Rejected</a>
                </li>
             </ul>
    </div>
</div>

<div class="orders-container">
    <div class="table-responsive">
                <table class="table">
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
                <tbody id="ordersContainer">

                </tbody>
        </table>
    </div>
</div>
<?php
include('components/footer.php');
