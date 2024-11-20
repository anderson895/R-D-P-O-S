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



<div class="ms-3 container">
    <div class="row mt-5">
        <div class="col-12 col-lg-6">
            <div class="border rounded p-3 ">
                <div class="d-flex" style="justify-content: space-between;">
                    <h5 class="fw-bold"><?= $db_spl_name ?></h5>
                    <p><?= $invoice_no ?></p>
                </div>
                <div class="d-flex " style="justify-content: space-between;">
                    <p><?= $db_spl_contact ?></p>
                    <p><?= $db_spl_email ?></p>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 #export text-end">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">Add Stock</button>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#export">Export</button>
        </div>

        <!-- Expiration Status Legend -->
        <div class="col-12 mt-3">
            <div class="border rounded p-3">
                <h6 class="fw-bold">Expiration Status Legend</h6>
                <p><span style="color: green; font-weight: bold;">●</span> Normal (Green)</p>
                <p><span style="color: orange; font-weight: bold;">●</span> Soon to Expire (Orange)</p>
                <p><span style="color: red; font-weight: bold;">●</span> Expired (Red)</p>
            </div>
        </div>

        <div class="col-12 col-lg-12 mt-3">
            <table class="table table-hover">
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
                        <th class="text-end" scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody id="stockTableBody">
                    <!-- Table content will be dynamically updated here -->
                </tbody>
            </table>
            <button class="btn btn-primary btn-sm mt-2">Delete all</button>
        </div>
    </div>
</div>
