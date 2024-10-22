<?php
include('components/header.php');

// Redirect if 'rider_id' is not set or empty
if (!isset($_GET['rider_id']) || empty($_GET['rider_id'])) {
    header("Location: orders.php?page=Collected");
    exit;
}

$page = $_GET['rider_id'];
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
    <div class="card">
        <div class="card-header text-white text-center" style="background-color:rgb(131, 0, 0);">
            <h1 >List of NOT COLLECTED COD on</h1>
            <h3 class="mb-0">Rider: <?=ucfirst($_GET['rider_name'])?> </h3>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-bordered mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Customer ID</th>
                            <th>Customer Name</th>
                            <th>Collected</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if (isset($page)) {
                            $orders = $db->getEachCodCollected($page);
                            if ($orders->num_rows > 0) {
                                while ($order = $orders->fetch_assoc()) {
                                    $getRider = $db->checkId('account', 'acc_id', $order['rider_id']);
                                   
                        ?>
                                <tr class="orders-tr">
                                    <td><?= $order['customer_code'] ?></td>
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
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include('components/footer.php'); ?>
