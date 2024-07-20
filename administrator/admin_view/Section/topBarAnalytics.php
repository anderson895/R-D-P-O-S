<?php
// Query para kunin ang Total Sale Amount
$sql_query_order= "SELECT SUM(orders_subtotal - (orders_subtotal * IF(orders_voucher_rate LIKE '%%', REPLACE(orders_voucher_rate, '%', '') / 100, 0))) AS TotalSaleAmount FROM orders";
$result = $connections->query($sql_query_order);

if ($result->num_rows > 0) {
    // I-fetch ang resulta
    $row = $result->fetch_assoc();
    $totalSaleAmount = $row["TotalSaleAmount"];
    $totalSaleAmount=number_format($totalSaleAmount, 2, '.', ''); 

    // I-output ang Total Sale Amount
  //  echo "Total Sale Amount: $" . number_format($totalSaleAmount, 2);//total sales in Ordering
} else {
    echo "Walang resulta.";
}



// Gumawa ng SQL query para kunin ang total sales amount
$sql_query_pos = "SELECT SUM(orders_final) AS total_sales FROM pos_orders";

$result = $connections->query($sql_query_pos);

if ($result->num_rows > 0) {
    // Kunin ang resulta ng query
    $row = $result->fetch_assoc();
    $totalSales = $row["total_sales"];
    $totalSales= number_format($totalSales, 2, '.', ''); //total ammount ng POS
   
} else {
    echo "No records found.";
}


// SQL query to count customers
$sql_customer = "SELECT COUNT(*) AS total_customers FROM `account` WHERE `acc_type` = 'customer'";
$result = $connections->query($sql_customer);

// Check if the query was successful
if ($result) {
    $row = $result->fetch_assoc();
    $totalCustomers = $row["total_customers"];
   // echo "Total Customers: " . $totalCustomers;
} else {
    echo "Error: " . $connections->error;
}

// SQL query to count employee
$sql_employee = "SELECT COUNT(*) AS total_employee FROM `account` WHERE `acc_type` != 'customer' AND `acc_type` != 'administrator' AND acc_display_status='0'";
$result_employee = $connections->query($sql_employee);

// Check if the query was successful
if ($result_employee) {
    $row_emp = $result_employee->fetch_assoc();
    $total_employee = $row_emp["total_employee"];
   // echo "Total Customers: " . $totalCustomers;
} else {
    echo "Error: " . $connections->error;
}





// SQL query to count employee
$sql_supplier = "SELECT COUNT(*) AS total_spl_name FROM `supplier` WHERE `spl_status` = '0'";
$result_supplier = $connections->query($sql_supplier);

// Check if the query was successful
if ($result_supplier) {
    $row_emp = $result_supplier->fetch_assoc();
    $spl_name = $row_emp["total_spl_name"];
   // echo "Total Customers: " . $totalCustomers;
} else {
    echo "Error: " . $connections->error;
}







// SQL query to count employee
$sql_orders = "SELECT COUNT(*) AS total_orders FROM orders WHERE orders_status NOT IN ('Complete', 'Invalid', 'Cancelled');";
$result_orders = $connections->query($sql_orders);
// Check if the query was successful
if ($result_orders) {
    $row_order = $result_orders->fetch_assoc();
    $total_orders = $row_order["total_orders"];
   // echo "Total Customers: " . $totalCustomers;
} else {
    echo "Error: " . $connections->error;
}


// SQL query to calculate total sales invoice
$salesQuery = "SELECT SUM(orders_final) AS total_sales_invoice FROM pos_orders WHERE orders_final > 0";
$salesResult = $connections->query($salesQuery);
$salesRow = $salesResult->fetch_assoc();
$totalSalesInvoice = $salesRow["total_sales_invoice"];

// SQL query to calculate total purchase invoice
$purchaseQuery = "SELECT SUM(orders_final) AS total_purchase_invoice FROM pos_orders WHERE orders_final < 0";
$purchaseResult = $connections->query($purchaseQuery);
$purchaseRow = $purchaseResult->fetch_assoc();
$totalPurchaseInvoice = $purchaseRow["total_purchase_invoice"];

// Display the results
//echo "Total Sales Invoice: $" . number_format($totalSalesInvoice, 2) . "<br>";
//echo "Total Purchase Invoice: $" . number_format($totalPurchaseInvoice, 2) . "<br>";


?>
<div class="page-wrapper">
<div class="content">
<div class="row">
<a href="stock_in.php" class="col-lg-3 col-sm-6 col-12">
<div class="dash-widget">
<div class="dash-widgetimg">
<span><img src="assets/img/icons/dash1.svg" alt="img"></span>
</div>
<div class="dash-widgetcontent">
<h5>₱ <span class="counters" data-count="307144.00">$307,144.00</span></h5>
<h6>Total Purchase Due</h6>
</div>
</div>
</a>

<a href="sales.php?sales_type=POS" class="col-lg-3 col-sm-6 col-12">
<div class="dash-widget dash1">
<div class="dash-widgetimg">
<span><img src="assets/img/icons/dash2.svg" alt="img"></span>
</div>
<div class="dash-widgetcontent">
<h5>₱ <span class="counters" data-count="4385.00">$4,385.00</span></h5>
<h6>Total Sales Due</h6>
</div>
</div>
</a>

<a href="sales.php?sales_type=Ordering" class="col-lg-3 col-sm-6 col-12">
<div class="dash-widget dash2">
<div class="dash-widgetimg">
<span><img src="assets/img/icons/onlineShop.svg" alt="img"></span>
</div>
<div class="dash-widgetcontent">
<h5>₱ <span class="counters" data-count="<?= $totalSaleAmount ?>">0</span></h5>
<h6>Total Sales Amount in ordering</h6>
</div>
</div>
</a>

<a href="sales.php?sales_type=POS" class="col-lg-3 col-sm-6 col-12">
<div class="dash-widget dash3">
<div class="dash-widgetimg">
<span><img src="assets/img/icons/store.svg" alt="img"></span>
</div>
<div class="dash-widgetcontent">
<h5>₱ <span class="counters" data-count="<?= $totalSales?>">0</span></h5>
<h6>Total Sales Amount in point of sales</h6>
</div>
</div>
</a>

<a href="customerlist.php" class="col-lg-3 col-sm-6 col-12 d-flex">
<div class="dash-count">
<div class="dash-counts">
<h4 class="counters" data-count="<?=$totalCustomers?>">0</h4>
<h5>Customers</h5>
</div>
<div class="dash-imgs">
<i data-feather="user"></i>
</div>
</div>
</a>


<a href="../new-orders-view/orders.php?page=Pending" class="col-lg-3 col-sm-6 col-12 d-flex">
<div class="dash-count das1">
<div class="dash-counts">
<h4 class="counters" data-count="<?=$total_orders?>">0</h4>
<h5>Total orders</h5>
</div>
<div class="dash-imgs">
<i data-feather="truck"></i>
</div>
</div>
</a>


<a href="userlist.php" class="col-lg-3 col-sm-6 col-12 d-flex">
<div class="dash-count das2">
<div class="dash-counts">
<h4 class="counters" data-count="<?=$total_employee?>"><?= $total_employee?></h4>
<h5>Employee</h5>
</div>
<div class="dash-imgs">
<i data-feather="file-text"></i>
</div>
</div>
</a>


<a href="supplierlist.php" class="col-lg-3 col-sm-6 col-12 d-flex">
<div class="dash-count das3">
<div class="dash-counts">
<h4 class="counters" data-count="<?=$spl_name?>">0</h4>
<h5>Active Suppliers</h5>
</div>
<div class="dash-imgs">
<i data-feather="user-check"></i>
</div>
</div>
</div>
</a>