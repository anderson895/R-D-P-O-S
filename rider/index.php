<?php
include('components/header.php');
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    if ($page != 'Ready For Delivery' && $page != 'Shipped' && $page != 'Delivered' && $page != 'Collected') {
        header('Location: index.php?page=Ready For Delivery');
        exit;
    }
} else {
    header('Location: index.php?page=Ready For Delivery');
    exit;
}
?>



<h5>Hello, <?= $user['acc_fname'] . ' ' . $user['acc_lname'] ?>!</h5>



<div class="container mt-4">
    <div class="overflow-auto">
        <ul class="nav nav-tabs flex-nowrap">
            <li class="nav-item">
                <a class="nav-link <?= ($page == 'Ready For Delivery') ? 'active' : '' ?>" href="index.php?page=Ready For Delivery">
                    <i class="bi bi-box-fill"></i> For Pick up
                    <span class="badge bg-danger ms-2" id="readyForDeliveryCount">0</span> 
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($page == 'Shipped') ? 'active' : '' ?>" href="index.php?page=Shipped">
                    <i class="bi bi-truck"></i> In-transit
                    <span class="badge bg-danger ms-2" id="shippedCount">0</span> 
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($page == 'Delivered') ? 'active' : '' ?>" href="index.php?page=Delivered">
                    <i class="bi bi-check-square"></i> Delivered
                    <span class="badge bg-danger ms-2" id="deliveredCount">0</span> 
                    <!--  -->
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'Collected') ? 'active' : '' ?>" href="index.php?page=Collected">
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
                            <th>Customer ID</th>
                            <th>Customer Name</th>
                            <th>Collected</th>
                            <th>Date</th>
                        
                        </tr>
                    </thead>
                    <tbody id="CodCollectedContainer">
                    </tbody>
                </table>

                        <!-- <div class="d-flex justify-content-center">
                            <div class="spinner-border" role="status">
                                <span class="sr-only"></span>
                            </div>
                        </div> -->
            </div>
        </div>
    </div>
</div>


<?php }else{?>
<div class="orders-container">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Subtotal</th>
                    <th>VAT</th>
                    <th>Shipping Fee</th>
                    <th>Total</th>
                    <th>Order Date</th>
                    <?= ($page == 'Delivered') ? '<th>Estimated Delivery</th>' : '' ?>
                    <?= ($page == 'Delivered') ? '<th>Delivery Date</th>' : '' ?>
                   
                </tr>
            </thead>
            <tbody id="OrdersContainer">

            </tbody>
        </table>
    </div>
</div>
<?php } ?>

<?php
include('components/footer.php');
?>