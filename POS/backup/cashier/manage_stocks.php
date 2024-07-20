<?php
include ('../config/config.php');
include ('../functions/session.php');
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventory</title>
    <link rel="icon" href="../assets/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/inventory.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body >
<?php include ('../includes/navigation.php');?>

<div class="container">
    <div class="row">
        
        <div class="col-12 col-md-6 mt-3">
            <div class="input-group">
                <input style="border: 1px solid gray;" type="text" class="form-control " placeholder="Search" aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn btn-primary" type="button" id="button-addon2">Search</button>
            </div>
        </div>

        <div class="col-12 col-md-6 mt-3 add d-flex justify-content-end">
            <button class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#add_product"><img src="../assets/images/add_inventory.png" class="btn-img" alt=""> Stock In</button>
          <!--  <button class="btn btn-primary me-0" data-bs-toggle="modal" data-bs-target="#stock"><img src="../assets/images/stocks.png" class="btn-img" alt="">Add Stocks</button>--->
        </div>
        
        <div class="col-12 col-md-12 mt-3">
            <div class="table-div">
                <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col" width="10%">Invoice No.</th>
                    <th scope="col" width="10%">Date Added</th>
                    <th scope="col" width="13%">Expiration Date</th>
                    <th scope="col" width="25%">Product Name</th>
                    <th scope="col" width="10%">Stocks</th>
                    <th scope="col" width="20%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- <?php include '../functions/table_Stocks.php'?> -->
                    
                </tbody>
                </table>
            </div>
        </div>
    </div>
    
</div>

<!-- Modal stock_in-->
<div class="modal fade mt-4" id="add_product" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Stock In</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="text" class="form-control" required placeholder="Invoice No.">
        
        <div class="dropdown mt-2">
        <button class="btn text-start btn-light border dropdown-toggle w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Select Supplier
        </button>
        
        <ul class="dropdown-menu w-100 ">
            <input type="text" class="form-control w-75 mx-2" placeholder="Search">
            <?php include "../includes/supplier.php";?>
            
        </ul>
        </div>

        <div class="dropdown mt-2">
        <button class="btn text-start btn-light border dropdown-toggle w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Select Product
        </button>
        
        <ul class="dropdown-menu w-100 ">
            <input type="text" class="form-control w-75 mx-2" placeholder="Search">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
            
        </ul>
        </div>

        <div class="d-flex flex-row mt-2">
            <select class="form-select w-50 me-1" aria-label="Default select example">
                <option selected>Select Expiration</option>
                <option value="1">With Expiration</option>
                <option value="2">Without Expiration</option>
            </select>

            <input type="date" disabled class="form-control w-50 ms-1">

        </div>

        <div class="d-flex flex-row">
        <input type="number" class="form-control me-1 mt-2" placeholder="Supplier Price">
        <input type="number" class="form-control ms-1 mt-2" placeholder="Selling Price">

        </div>

        <div class="d-flex flex-row mt-2">
            <select class="form-select w-50 me-1" aria-label="Default select example">
                <option selected>Select Unit</option>
                <option value="1">With Expiration</option>
                <option value="2">Without Expiration</option>
            </select>

            <input type="number" class="form-control w-50 ms-1" placeholder="Qty" min="1">

        </div>

        
        
      
      

            
      </div>
            <div class="modal-footer">
                        <button type="button" class="btn btn-secondary w-25" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="save" class="btn btn-primary w-25" id="btnSave">Save</button>
            </div>
    </div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>



