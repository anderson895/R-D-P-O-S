<?php
include('components/header.php');
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    if ($page != 'Pending' && $page != 'Accepted' && $page != 'Ready For Delivery' && $page != 'Shipped' && $page != 'Delivered' && $page != 'Cancelled' && $page != 'Rejected' && $page != 'Collected') {
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
if($page == 'Collected'){ ?>
<div class="orders-container container mt-4">
    <div class="card shadow">
        <div class="card-header text-white" style="background-color:rgb(131, 0, 0);">
         <h3 class="mb-0">Daily Cash on Delivery Collected</h3>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-bordered mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Rider ID</th>
                            <th>Rider Name</th>
                            <th>Collected</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="CodCollectedContainer">
                    </tbody>
                </table>

                       
            </div>
        </div>
    </div>
</div>


<?php }else{?>

<div class="orders-container">
    <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>Order ID</th>
                        <?= ($page != 'Delivered') ? '<th>Status</th>' : '' ?>
                        
                        <th>Subtotal</th>
                        <th>VAT</th>
                        <th>Shipping Fee</th>
                        <th>Total</th>
                        <th>Order Date</th>
                        <?= ($page == 'Delivered'||$page == 'Shipped') ? '<th>Estimated Delivery</th>' : '' ?>
                        <?= ($page == 'Delivered') ? '<th>Delivery Date</th>' : '' ?>
                        <th>Rider</th>
                        <?= ($page == 'Rejected') ? '<th>Reject Reason</th>' : '' ?>
                        <?= ($page == 'Cancelled') ? '<th>Customer Name</th>' : '' ?>
                        <?= ($page == 'Cancelled') ? '<th>Cancel Reason</th>' : '' ?>
                    </tr>
                <tbody id="ordersContainer">

                </tbody>
        </table>
    </div>
</div>

<?php
}
?>

<?php
include('components/footer.php');
