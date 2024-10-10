<?php
include('../config/config.php');
include('../functions/session.php');

if (isset($_POST['searchTerm'])) {
    $searchTerm = $_POST['searchTerm'];

    $sql = "SELECT 
    product.prod_id, 
    product.prod_code, 
    product.prod_added, 
    product.prod_name, 
    product.barcode,
    product.prod_currprice, 
    product.prod_image, 
    product.prod_description, 
    product.prod_category_id, 
    product.prod_unit_id,
    product.unit_type,
    COALESCE(stock_total.total_stock_amount, 0) AS total_stock_amount
FROM 
    product
LEFT JOIN (
    SELECT 
        s_prod_id, 
        SUM(s_amount) AS total_stock_amount
    FROM 
        stocks
    GROUP BY 
        s_prod_id
) AS stock_total
ON 
    product.prod_id = stock_total.s_prod_id
WHERE (`s_expiration` = '0000-00-00' OR `s_expiration` > CURDATE()) AND
    product.prod_status = 0
    AND (
        product.prod_name LIKE '%" . $searchTerm . "%' 
        OR product.prod_code LIKE '%" . $searchTerm . "%'
        OR product.barcode LIKE '%" . $searchTerm . "%'
    )
ORDER BY 
    total_stock_amount DESC,  -- Sort by total stock amount in descending order
    product.prod_added DESC;  -- For ties, sort by the product added date
";


    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '
            <div class="col-12 col-md-4" style="position: relative; margin-bottom: 10px">
                <div class="border rounded shadow" style="height: 152px; position: relative;">
                    <div style="height: 90px;">
                        <img class="rounded" src="../../upload_prodImg/' . $row['prod_image'] . '" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="m-2 mt-1">';
            if ($row['total_stock_amount'] == '0') {
                echo '<span style="font-size: 12px; position: absolute; buttom: 0; right: 10px;" class="m-0 fw-bold"><button disabled class="btn btn-sm btn-primary rounded rounded-5 add-to-cart-button"><img src="../assets/images/add_cart.png" style="width: 25px;" class="w-100;"></button></span>';
            } else {
                echo '<span style="font-size: 12px; position: absolute; buttom: 0; right: 10px;" class="m-0 fw-bold"><button data-bs-toggle="modal" data-bs-target="#add_cart" data-prod-id="' . $row['prod_id'] . '" data-stocks="' . $row['total_stock_amount'] . '" data-name="' . $row['prod_name'] . '" data-unit_type="' . $row['unit_type'] . '"  class="btn btn-sm btn-primary rounded rounded-5 add-to-cart-button"><img src="../assets/images/add_cart.png" style="width: 25px;" class="w-100;"></button></span>';
            }

            echo '<div class="d-flex " >
                        <p style="font-size: 20px; border-right: 3px solid gray; background-color: #E9ECEF"  class="m-0 ps-2 rounded fw-bold pe-2 me-1">₱ ' . $row['prod_currprice'] . '</p>
                        ';

            if ($row['total_stock_amount'] == '0') {
                echo '<p style="font-size: 10px; color: red" class="m-0 ms-1">Not Available</p>';
            } else {

                echo '
                            <div class="d-block m-0 p-0">
                            <div><p style="font-size: 10px; color: green" class="m-0 ms-1">Available</p></div><div><p style="font-size: 10px; color: green" class="m-0 ms-1"> ' . $row['total_stock_amount'] . ' ' . $row['unit_type'] . '</p></div>
                            </div>
                            ';
            }

            echo '</div>
                        <p style="font-size: 12px; margin-top: -5;" class="m-0">' . $limitedString = substr($row['prod_name'], 0, 20) . '</p>
                    </div>
                </div>
            </div>
            ';
        }
    } else {
        echo '<p class="">No result</p>';
    }
}

?>



<!-- Modal -->
<div class="modal fade mt-4" id="add_cart" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Add to Cart</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="pos" method="POST">
                <div class="modal-body">
                    <input type="hidden" id="acc_id" name="acc_id" class="form-control mb-2" value="<?php echo $acc_id ?>">
                    <input type="hidden" id="prod_id_input" name="prod_id" class="form-control mb-2" value="">
                    <input type="hidden" id="stocks_inputs" name="stocks" class="form-control mb-2" value="">
                    <div class="input-group mt-2" id="add">
                        <label for="" class="form-control ">Product Name</label>
                        <input type="text" class="form-control text-end " value="" id="add_name" disabled style="background-color: white">
                    </div>
                    <div class="input-group mt-2" id="add">
                        <label for="" class="form-control ">Stocks (<span id="posATCUnitType"></span>)</label>
                        <input type="number" class="form-control text-end" value="" id="stocks_inputs" disabled style="background-color: white">
                    </div>
                    <input type="number" id="amount" name="amount" required placeholder="Enter quantity here" class="form-control mt-2">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="../assets/js/add_product.js"></script>