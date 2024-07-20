<?php
include('../config/config.php');
include('../functions/session.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

// Execute the SQL query to retrieve all records
$table_sql = "
SELECT
    t.orders_orders_id,
    t.orders_prodQty,
    t.return_availability,
    p.prod_currprice,
    c.category_id,
    p.prod_name,
    p.prod_id
FROM
    pos_orders AS t
JOIN
    product AS p
ON
    t.orders_prod_id = p.prod_id
JOIN
    category AS c
ON
    p.prod_category_id = c.category_id
WHERE
    t.orders_tcode = '$id'; 
";

$result = $conn->query($table_sql);

if ($result->num_rows > 0) {
    $tbody = '';
    $tbodyModal = '';
    $returnAvailabilityString = '';
    $rows = [];

    // Fetch all rows and store them in an array
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }

    // Loop through the array for the first while loop
    foreach ($rows as $row) {
        $return_availability = $row["return_availability"];
        $returnAvailabilityString .= $return_availability;
        $tbody .= '
        <tr>
        
        <td class="pt-1">' . (strlen($row["prod_name"]) > 20 ? substr($row["prod_name"], 0, 20) . '...' : $row["prod_name"]) . '</td>
        <td class="text-end pt-1"> ₱' . $row["prod_currprice"] . '</td>
        <td class="text-end pt-1">' . $row["orders_prodQty"] . '</td>
        <td></td>
      </tr>';
    }

    // Loop through the array for the second while loop
    foreach ($rows as $row) {
        $maxQty = $row["orders_prodQty"];
        $prod_id = $row["prod_id"];
        $orders_orders_id = $row["orders_orders_id"];
        
        if($row["category_id"] == 3){
            $tbodyModal .= '
            <tr>
                <td><input disabled type="checkbox" name="itemReturn" ></td>
                <td class="text-end text-secondary pt-1"> <input disabled  class="form-control  text-center quantityInput" type="number" value="'.$maxQty.'" max="'.$maxQty.'" min="1" data-prod_id="' . $prod_id . '" ></td>
                <td class="pt-1 text-secondary">' . (strlen($row["prod_name"]) > 20 ? substr($row["prod_name"], 0, 20) . '...' : $row["prod_name"]) . '</td>
                <td class="text-end text-secondary pt-1"> ₱' . $row["prod_currprice"] . ' <input disabled hidden type="text" value="'.$row["prod_currprice"].'" class="currPrice""></td>
                <td class="text-end text-secondary pt-1">'.$row["orders_prodQty"].'</td>
            </tr>';
        }else{
            $tbodyModal .= '
            <tr>
                <td><input class="checked_checkbox" type="checkbox" name="itemReturn" data-prod_id="' . $prod_id . '" data-orders_orders_id="' . $orders_orders_id . '"></td>
                <td class="text-end pt-1"> <input class="form-control  text-center quantityInput" type="number" value="'.$maxQty.'" max="'.$maxQty.'" min="1" data-prod_id="' . $prod_id . '"></td>
                <td class="pt-1">' . (strlen($row["prod_name"]) > 20 ? substr($row["prod_name"], 0, 20) . '...' : $row["prod_name"]) . '</td>
                <td class="text-end pt-1"> ₱' . $row["prod_currprice"] . ' <input hidden type="text" value="'.$row["prod_currprice"].'" class="currPrice""></td>
                <td class="text-end pt-1">'.$row["orders_prodQty"].'</td>
                
            </tr>';
        }

    }
    
} else {
    echo "No results found.";
}



    // Execute the SQL query
    $sql = "
    SELECT
    t.orders_barcode,
    SUM(t.orders_prodQty * orders_prod_price) Allsubtotal,
        CONCAT(
            t.orders_date, ',',
            t.orders_subtotal, ',',
            t.orders_discount, ', ',
            t.orders_tax, ', ',
            t.orders_final, ', ',
            t.orders_payment, ', ',
            t.orders_change, ', ',
             CONCAT(a.acc_fname, ' ', a.acc_lname)
        ) AS transaction_info
    FROM
        pos_orders AS t
    JOIN
        product AS p
    ON
        t.orders_prod_id = p.prod_id
    JOIN
        account AS a
    ON
        t.orders_user_id = a.acc_id
    WHERE
        t.orders_tcode = '$id';
    ";

    $result = $conn->query($sql);
    
    // Check if there are results
    if ($result->num_rows > 0) {
        
        
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            $db_order_barcode = $row["orders_barcode"];
            $Allsubtotal = $row["Allsubtotal"];
            $data = $row["transaction_info"];
        }
        
        $dataArray = explode(",", $data);

        if (count($dataArray) === 8) {
            list($date, $subtotal, $discount, $tax, $total, $payment, $change, $cashier) = $dataArray;
            
        } else {
            echo "The input data does not contain exactly six values separated by commas.";
        }

    } else {
        echo "No results found.";
    }
} else {
    header("location: pos");
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Transaction</title>
    <link rel="icon" href="../assets/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/inventory.css">


    <link rel="stylesheet" href="../../administrator/admin_view/assets/plugins/scrollbar/scroll.min.css">
    <link rel="stylesheet" href="../../administrator/admin_view/assets/plugins/alertify/alertify.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
    .right{
        text-align: end;
    }
    </style>
</head>
<body >

<?php include ('../includes/navigation.php');?>



<div class="container ">
    <div class="row ">
        
        <div class="col-12 col-md-7 mt-3">
            <div class="border rounded p-4 shadow">
            <h5 class="fw-bold">Transaction Details</h5>
            <div class="container border rounded py-2" >
            <table style="width: 100%;">
                <tr>
                    <td>Transaction Code <input hidden type="text" value="<?=$id?>" id='transactionCode'></td>
                    <td class="right"><?php echo $id?></td>
                </tr>
                <tr>
                    <td>Date <input hidden type="text" value="<?=$date?>" id='datePurchase'></td>
                    <td class="right"><?= date("Y F j H:i A", strtotime($date)) ?></td>


                </tr>
                <tr>
                    <td>Cashier Name</td>
                    <td class="right"><?php echo $cashier?></td>
                </tr>
                <tr>
                    <td>Payment</td>
                    <td class="right">₱<?php echo $payment?></td>
                </tr>
                <tr>
                    <td>Change</td>
                    <td class="right">₱<?php echo $change?></td>
                </tr>
            </table>
            </div>
            <div class="container mt-3 border rounded py-2" >
                <div style="overflow: auto; height: 250px;">
            <table class="table" style="width: 100%; ">
            <thead>
                <th>Product</th>
                <th class="text-end">Price</th>
                <th class="text-end">Qty</th>
                <th class="text-end"></th>
            </thead>
                <div >
                <?php echo $tbody?>
                </div>
            </table>
            </div>
            </div>
            </div>
            
        </div>

        <div class="col-12 col-md-5 mt-3">
            
            <div class="border rounded p-4 shadow">
            <h5 class="fw-bold">Purchased Summary</h5>
            <div class="container border rounded py-2">
            <table style="width: 100%;">
                <tr>
                    <td>Subtotal</td>
                    <td class="right">₱<?php echo $Allsubtotal?></td>
                </tr>
                <tr>
                    <td>Discount</td>
                    <td class="right">₱<?php echo $discount?></td>
                </tr>
                <tr class="border-bottom">
                    <td>VAT (100%)</td>
                    <td class="right">₱<?php echo $tax?></td>
                </tr>
                <tr >
                    <td class="fw-bold fs-3">₱TOTAL</td>
                    <td class="right fs-3 fw-bold">₱<?php echo $total?></td>
                </tr>
            </table>
            </div>
            

    


            <?php 
            if (preg_match('/^0+$/',  $returnAvailabilityString)) {
                echo '<button  class="btn mt-3 w-100 btn-primary" data-bs-toggle="modal" data-bs-target="#return">Return</button>';
            } else {
                echo '<button disabled class="btn mt-3 w-100 btn-primary" data-bs-toggle="modal" data-bs-target="#return">Return</button>';
            }
            
            ?>
            
            <button class="btn mt-3 w-100 text-primary border-primary ">Print As Document</button>
            <button class="btn mt-3 w-100 text-primary border-primary">Print As Reciept</button>
            


            </div>
        </div>

        
    </div>
</div>







<!-- Modal -->
<div class="modal fade mt-4" id="return" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Select Product to Return</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container mb-3 border rounded py-2" >
                    <div style="overflow: auto; height: 250px;">
                <table class="table" style="width: 100%; ">
                <thead>
                    <td class="text-secondary"><input class="checkAll" type="checkbox" ></td>
                    <th >Quantity</th>
                    <th>Product</th>
                    <th class="text-end">Price</th>
                    <th class="text-end">Qty</th>
                </thead>
                    <div >
                    <?php echo $tbodyModal?>
                    
                    </div>
                </table>
                </div>
                
      </div>


    <div class="row">
    <div class="col-12 col-md-6">
        <!-- <label for="reason">Reason</label> -->
        <select class="form-select mb-3" aria-label="Default select example" id="reason">
                    <option value="" selected>Select Reason</option>
                    <option value="expired">Expired</option>
                    <option value="defective">Defective</option>
        </select>
    </div>

    <div class="col-12 col-md-6">
        <!-- <label for="returnType">Return type</label> -->
        <select class="form-select  mb-3" aria-label="Default select example" id="returnType">
                    <option value="" selected>Select Type Request</option>
                    <option value="replace">Replace</option>
                
        </select>
    </div>
    </div>
                
      <div class="modal-footer">

        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <div id="loadingSpinner"></div>
        <button style="display:block;" disabled type="button" class="btn btn-primary btnCunfirmReturn">Confirm</button>
      </div>
    </div>
  </div>
</div>


<script src="../../administrator/admin_view/assets/plugins/alertify/alertify.min.js"></script>
<script src="../../administrator/admin_view/assets/js/jquery.slimscroll.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>


<script src='../assets/js/checkbox.js'></script>