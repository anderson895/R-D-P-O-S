<?php
include('components/header.php');

// Redirect if 'rider_id' is not set or empty
if (!isset($_GET['rider_id']) || empty($_GET['rider_id'])) {
    header("Location: orders.php?page=Collected");
    exit;
}

$rider_id = $_GET['rider_id'];
?>

<div class="container mt-4">
    <div class="overflow-auto">
        <ul class="nav nav-tabs flex-nowrap">
            <?php 
            // Tab items with status names
            $tabs = [
                'Pending' => 'hourglass-split',
                'Accepted' => 'check2-all',
                'Ready For Delivery' => 'box-fill',
                'Shipped' => 'truck',
                'Delivered' => 'check-square',
                'Cancelled' => 'x-circle',
                'Rejected' => 'exclamation-circle',
                'Collected' => 'person-square'
            ];

            // Loop to generate tab links
            foreach ($tabs as $status => $icon) {
                $active = (isset($_GET['page']) && $_GET['page'] == $status) ? 'active' : '';
                echo "
                <li class='nav-item'>
                    <a class='nav-link $active' href='orders.php?page=$status'>
                        <i class='bi bi-$icon'></i> $status 
                        <span id='" . strtolower(str_replace(' ', '', $status)) . "Count' class='badge bg-danger'>0</span>
                    </a>
                </li>";
            }
            ?>
        </ul>
    </div>
</div>

<div class="orders-container container mt-4">
    <div class="card shadow">
            <div class="card-header text-white text-center" style="background-color:rgb(131, 0, 0);">
            <h1 class="h4 mb-0">List of NOT COLLECTED COD on</h1>
            <h3 class="h6">
                Rider: <a href="../admin_view/profile.php?account_id=<?=$rider_id;?>" class="text-white"><?=ucfirst($_GET['rider_name'])?></a>
            </h3>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-bordered mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>Collected</th>
                        </tr>
                    </thead>
                    <tbody>
             
                        <?php 
                        if (isset($rider_id)) {
                            $orders = $db->getEachCodCollected($rider_id);
                            if ($orders->num_rows > 0) {
                                while ($order = $orders->fetch_assoc()) {
                                    $getRider = $db->checkId('account', 'acc_id', $order['rider_id']);
                                   
                        ?>

                        
                                <tr class="orders-tr">
                                    <td>
                                        <a href="view-order.php?orderId=<?=$order['order_id'];?>"><?=$order['order_id'];?></a>
                                    </td>
                                    <td>
                                        <a href="../admin_view/profile_customer.php?target_id=<?=$order['cust_id'];?>"><?=ucfirst($order['customer_name']);?></a>
                                    </td>

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
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include('components/footer.php'); ?>
