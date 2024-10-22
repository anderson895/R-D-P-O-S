<?php
include('components/header.php');

// Redirect to 'Collected' page if 'rider_id' is not set or is empty
if (!isset($_GET['rider_id']) || empty($_GET['rider_id'])) {
    header("Location: orders.php?page=Collected");
    exit;
}

// Capture the 'rider_id' from the URL
$page = $_GET['rider_id'];
?>

<div class="container mt-4">
    <div class="overflow-auto">
        <ul class="nav nav-tabs flex-nowrap">
            <?php
            $tabs = [
                'Pending' => 'bi-hourglass-split',
                'Accepted' => 'bi-check2-all',
                'Ready For Delivery' => 'bi-box-fill',
                'Shipped' => 'bi-truck',
                'Delivered' => 'bi-check-square',
                'Cancelled' => 'bi-x-circle',
                'Rejected' => 'bi-exclamation-circle',
                'Collected' => 'bi-person-square'
            ];

            foreach ($tabs as $pageName => $icon) {
                $activeClass = (isset($_GET['page']) && $_GET['page'] == $pageName) ? 'active' : '';
                echo "
                <li class='nav-item'>
                    <a class='nav-link $activeClass' href='orders.php?page=$pageName'>
                        <i class='bi $icon'></i> $pageName 
                        <span id='".strtolower(str_replace(' ', '', $pageName))."Count' class='badge bg-danger'>0</span>
                    </a>
                </li>";
            }
            ?>
        </ul>
    </div>
</div>

<div class="orders-container container mt-4">
    <div class="card">
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $orders = $db->getEachCodCollected($page);
                        if ($orders->num_rows > 0) {
                            while ($order = $orders->fetch_assoc()) {
                                $rider = $db->checkId('account', 'acc_id', $order['rider_id']);
                                $riderName = ($rider->num_rows > 0) ? $rider->fetch_assoc()['acc_fname'] . ' ' . $rider['acc_lname'] : 'NA';
                                echo "
                                <tr class='orders-tr'>
                                    <td>{$order['customer_code']}</td>
                                    <td>".ucfirst($order['customer_name'])."</td>
                                    <td>₱ {$order['total_sales']}</td>
                                </tr>";
                            }
                        } else {
                            echo "
                            <tr>
                                <td colspan='3' class='text-center'>No Order Found.</td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include('components/footer.php'); ?>
