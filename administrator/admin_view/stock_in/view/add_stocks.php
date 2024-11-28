<?php

if (!empty($_POST["supplier_code"]) && !empty($_POST["invoice_no"])) {
    $supplier_code = $_POST["supplier_code"];
    $invoice_no = $_POST["invoice_no"];
} else {
    echo "<script>location.href='stock_in.php';</script>";
    exit(); // Good practice to stop script execution after redirect
}

date_default_timezone_set('Asia/Manila');
$stockin_date = date('Y-m-d H:i:s');

$view_query = mysqli_query($connections, "SELECT * from supplier where spl_code='$supplier_code' ");

while ($row = mysqli_fetch_assoc($view_query)) {
    $spl_id = $row["spl_id"];
    $db_spl_name = $row["spl_name"];
    $db_spl_email = $row["spl_email"];
    $db_spl_contact = $row["spl_contact"];
    $db_spl_address = $row["spl_address"];
}
?>
<input hidden type="text" value="<?= $supplier_code ?>" id="supplier_code">
<input hidden type="text" value="<?= $invoice_no ?>" id="invoice_no">
<input hidden type="text" value="<?= $stockin_date ?>" id="stockin_date">

<div class="container mt-5">
    <div class="row">
        <!-- Supplier Information -->
        <div class="col-12 col-lg-6 mb-4">
            <div class="card p-3 shadow-sm">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold"><?= $db_spl_name ?></h5>
                    <p class="text-muted mb-0"><?= $invoice_no ?></p>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <p class="mb-0"><?= $db_spl_contact ?></p>
                    <p class="mb-0"><?= $db_spl_email ?></p>
                </div>
            </div>
        </div>

        <!-- Actions Section -->
        <div class="col-12 col-lg-6 text-lg-end mb-4">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">Add Stock</button>
            <button class="btn btn-success ms-2" data-bs-toggle="modal" data-bs-target="#export">Export</button>
        </div>
    </div>

    <!-- Expiration Status Legend -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card p-3">
                <h6 class="fw-bold">Expiration Status</h6>
                <p><span class="text-success">●</span> <strong>Normal (Green):</strong> Item is in good standing and not nearing expiration.</p>
                <p><span class="text-warning">●</span> <strong>Soon to Expire (Orange):</strong> Item soon to expire within 2 months.</p>
                <p><span class="text-danger">●</span> <strong>Expired (Red):</strong> The item has already expired and is automatically excluded from the stock count.</p>
            </div>
        </div>
    </div>

    <!-- Expiration Filter Dropdown -->
    <div class="row mb-4">
        <div class="col-12 col-lg-4">
            <select id="expirationFilter" class="form-select">
                <option value="all">All</option>
                <option value="soon_to_expire">Soon to Expire</option>
                <option value="expired">Expired</option>
            </select>
        </div>
    </div>

    <!-- Stock Table -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th scope="col"><input type="checkbox" id="AllCheckbox"></th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Stock In</th>
                                <th scope="col">Current Stock</th>
                                <th scope="col">Unit</th>
                                <th scope="col">Current price</th>
                                <th scope="col">Supplier price</th>
                                <th scope="col">Mark up</th>
                                <th scope="col">Expiration</th>
                                <th scope="col">Date Added</th>
                                <th scope="col" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="stockTableBody">
                            <!-- Table content will be dynamically updated here -->
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-end">
                    <button class="btn btn-danger btn-sm">Delete all</button>
                </div>
            </div>
        </div>
    </div>
</div>
