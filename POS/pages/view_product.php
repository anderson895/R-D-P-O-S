<?php
include ('../config/config.php');
include ('../functions/session.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $pcode = $_GET["product_code"];

    if ($pcode === null) {
        // Redirect to another page (replace 'your_redirect_page.php' with the actual page)
        header("Location: inventory");
        exit();
    }

    // Construct the SQL query
    $sql = "SELECT product.*, SUM(stocks.s_amount) AS total_s_amount
    FROM product
    LEFT JOIN stocks ON product.prod_id = stocks.s_prod_id
    WHERE product.prod_id = '$pcode'
    GROUP BY product.prod_id;
    ";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    // Check if any rows are found
    if (mysqli_num_rows($result) == 0) {
        // Redirect to another page (replace 'your_redirect_page.php' with the actual page)
        header("Location: inventory");
        exit();
    }

    // Fetch and process the results
    while ($row = mysqli_fetch_assoc($result)) {
        // You can access the result data here
        $product_name = $row['prod_name'];
        $product_description = $row['prod_description'];
        $added = $row['prod_added'];
        $p_code = $row['prod_code'];
        $edit = $row['prod_edit'];
        $cprice = $row['prod_currprice'];
        $clevel = $row['prod_critical'];
        $image = $row['prod_image'];
        $barcode = $row['barcode'];
        $stocks = $row['total_s_amount'];
    }
}

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product</title>
    <link rel="icon" href="../assets/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/inventory.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        @media print {
        .navigations{
        display: none;
        }

        .barcode{
            display: block;
        }
        
        .cont{
            display: none;
        }

        .print{
            margin: 0px;
            padding: 0px;
            border: none;
            border-radius: none;
        }

        }

    </style>
</head>
<body >
<div class="navigations">
    
<?php include ('../includes/navigation.php');?>
</div>
<div class="container print">
    <div class="row  print h-100" id="view_products">
        <div class="col-12 col-md-7 cont mt-3">
            <div class="container border px-4 rounded py-4 shadow">
            <div class="row">
            <div class="col-12 col-md-3">
                <h5 class="fw-bolder">View Product</h5>
            </div>
            <div class="col-12 col-md-9 d-flex justify-content-end">
                <a href="inventory" class="btn me-2 btn-primary border" >Back</a>
                <button  class="btn border border-primary text-primary me-2" id="btn_stocks">View Stocks</button>
                <button class="btn border border-primary text-primary me-2">Edit</button>
                <button class="btn border border-primary text-primary me-2">Delete</button>
                <button class="btn border-primary text-primary" id="printButton">Print</button>
            </div>
            </div>
            <div class="input-group">
                <label for="" class="form-control mt-3">Date Added: <?php echo $added?></label>
                <label for="" class="form-control mt-3">Date Edited: <?php echo $edit?></label>       
            </div>
            <label for="" class="form-control mt-3">Product Code: <?php echo $p_code?></label>
                <label for="" class="form-control mt-3">Product Name: <?php echo $product_name?></label>
            <div class="input-group">
                
                <label for="" class="form-control mt-3">Retail Price: <?php echo $cprice?></label>
            </div>
                <div class="border rounded mt-3 p-2"> Description: <?php echo $product_description?></div>
                <label for="" class="form-control mt-3">Critical Level: <?php echo $clevel?></label>
                <label for="" class="form-control mt-3">Stocks: <?php echo $stocks?></label>
            
            
            </div>
        </div>
        <div class="col-12 col-md-5 mt-3 print">
            <div class="container border shadow rounded">
            <div class="cont mt-3 px-3 pt-3" style="width: 100%; height: 342px;">
                <img src="../../upload_prodImg/<?php echo $image; ?>" class="rounded  " alt="product image" style=" object-fit: cover; width: 100%; height: 100%;">
            </div>

            <div class="mt-3 mb-4 px-3">
                <img id="barcode" src="../../upload_barcode/<?php echo $barcode; ?>" alt="barcode" width="100%" height="69px">
            </div>

            </div>
        </div>
        <img id="barcode" class="barcode" style="display: none" src="../../upload_barcode/<?php echo $barcode; ?>" alt="barcode" width="100%" height="69px">

    </div>

    <div class="row display" style="display: none;" id="view_stocks">
        <div class="container ">
            <div class="container border shadow rounded mt-3 p-4">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <h5 class="fw-bolder">Stocks</h5>
                    </div>
                    
                    <div class="col-12 col-md-6">
                        <div class="input-group">
                            <input type="text" class="form-control input-sm" placeholder="Search date here (yyyy-mm-dd)">
                            <button class=" btn btn-primary btn-sm">Search</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-2 d-flex flex-row justify-content-end ">
                        <button  class="btn  border btn-primary  me-2" id="btn_products" style="display:none">Back</button>
                        <button  class="btn border border-primary text-primary me-2" id="btn_add" style="display: none" data-bs-target="#add_Modal" data-bs-toggle="modal">Add</button>
                    </div>
                    
                </div>
                <div class="table-div-stocks mt-2">
                <table class="table">
                    <thead >
                        <tr>
                            <th width="30%">Date Added</th>
                            <th width="20%">Expiration</th>
                            <th width="20%">Amount Added</th>
                            <th width="20%">Available</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        
                        $sql="SELECT * FROM stocks WHERE s_prod_id = '$pcode'";

                        $result = mysqli_query($conn, $sql);
    
                        if (!$result) {
                            die("Query failed: " . mysqli_error($conn));
                        }
                        
                        // Fetch and process the results
                        while ($row = mysqli_fetch_assoc($result)) {
                            // You can access the result data here
                            $s_created = $row['s_created'];
                            $s_expiration = $row['s_expiration'];
                            $amount = $row['s_amount'];
                       
                            echo '
                            <tr>
                                <td>'.$s_created.'</td>
                                <td>'.$s_expiration.'</td>
                                <td>'.$amount.'</td>
                                <td>'.$amount.'</td>
                                <td><button class="btn border btn-sm">Delete</button></td>
                            </tr>';
                        }
                        ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal Add -->
<div class="modal fade mt-4" id="add_Modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-center" id="staticBackdropLabel">Add Stocks</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addForm" enctype="multipart/form-data">
                    <input type="hidden" name="prod_id" value="<?php echo $pcode?>">
                    <input type="number" required class="form-control" placeholder="Enter amount" name="amount">
                    <input type="date" required class="form-control mt-2" name="date" min="<?php echo date('Y-m-d'); ?>">
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-secondary w-25" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary w-25" id="save-button">Save</button>
            </div>
        </div>
    </div>
</div>


               

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="../assets/js/maintenance.js"></script>
<script src="../assets/js/maintenance_view_product.js"></script>
<script>
    $(document).ready(function () {
        $("#save-button").click(function () {
            $.ajax({
                type: "POST",
                url: "../functions/add_stocks_no_reload.php",
                data: $("#addForm").serialize(),
                success: function (response) {
                    $("#add_Modal").modal("hide");
                    
                    // You can also close the modal if the request was successful.

                },
                error: function (error) {
                    // Handle errors if the request fails.
                }
            });
        });
    });
</script>
<script>
    document.getElementById("printButton").addEventListener("click", function() {
        window.print();
    });
</script>
</body>
</html>
