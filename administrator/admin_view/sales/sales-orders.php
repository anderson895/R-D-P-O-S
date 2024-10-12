<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Sales</h4>
                <h6>View Sales in Ordering</h6>
            </div>
            <div>
                <a href="sales.php?sales_type=POS" class="btn btn-secondary">POS Sales</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-top">
                    <div class="search-set">
                        <div class="search-input">
                            <a class="btn btn-searchset">
                                <img src="assets/img/icons/search-white.svg" alt="img">
                            </a>
                        </div>
                    </div>
                    <div class="wordset">
                        <ul>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="assets/img/icons/pdf.svg" alt="img"></a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="assets/img/icons/excel.svg" alt="img"></a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="assets/img/icons/printer.svg" alt="img"></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table  datanew">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer</th>
                                <th>Payment Type</th>
                                <th>Subtotal</th>
                                <th>Vat</th>
                                <th>Shipping Fee</th>
                                <th>Total</th>
                                <th>Order Date</th>
                                <th>Date Delivered</th>
                                <th>Delivered By</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $getOrders = $db->getOrderSales();
                            while ($sales = $getOrders->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?= $sales['order_id'] ?></td>
                                    <td><?= $sales['cust_fname'] . ' ' . $sales['cust_lname'] ?></td>
                                    <td><?= ($sales['payment_id'] == 'COD') ? 'COD' : $sales['payment'] ?></td>
                                    <td>₱<?= number_format($sales['subtotal'],2) ?></td>
                                    <td>₱<?= number_format($sales['vat'],2) ?></td>
                                    <td>₱<?= number_format($sales['sf'],2) ?></td>
                                    <td>₱<?= number_format($sales['total'],2) ?></td>
                                    <td><?= (new DateTime($sales['order_date']))->format('F j, Y h:i A') ?></td>
                                    <td><?= (new DateTime($sales['delivered_date']))->format('F j, Y h:i A') ?></td>
                                    <td><?= $sales['db_fname'] . ' ' . $sales['db_lname'] ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script src="userlist/controller/ajaxUserlist.js"></script>