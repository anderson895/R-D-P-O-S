<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Sales</h4>
                <h6>View Sales in Point Of Sales</h6>
            </div>
            <div>
                <a href="sales.php?sales_type=Ordering" class="btn btn-secondary">Ordering Sales</a>
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
                                <th>Subtotal</th>
                                <th>Vat</th>
                                <th>Discount</th>
                                <th>Total</th>
                                <th>Payment</th>
                                <th>Change</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $getPosSales = $db->getSalesInPOS();
                            while ($sales = $getPosSales->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?= $sales['orders_tcode'] ?></td>
                                    <td><?= $sales['subtotal'] ?></td>
                                    <td><?= $sales['orders_tax'] ?></td>
                                    <td><?= $sales['orders_discount'] ?></td>
                                    <td><?= $sales['orders_final'] ?></td>
                                    <td><?= $sales['orders_payment'] ?></td>
                                    <td><?= $sales['orders_change'] ?></td>
                                    <td><?= (new DateTime($sales['orders_date']))->format('F j, Y h:i A') ?></td>
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