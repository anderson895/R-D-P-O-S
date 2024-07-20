<?php
include ('../config/config.php');
include ('../functions/session.php');
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Transaction</title>
    <link rel="icon" href="../assets/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/inventory.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body >

<?php include ('../includes/navigation.php');?>

<div class="container">
    <div class="row">
    <div class="col-12 col-md-4 mt-3 ">
          <div class="btn border ms-0" style=" width: 100%" id="postext">POS Transactions</div>
          <div class="btn border ms-0 " style=" display: none" id="onlinetext">Ordering Transactions</div>
          <div class="btn border ms-0 " style=" display: none" id="return_postext">POS Returns </div>
          <div class="btn border ms-0 " style=" display: none" id="return_ordertext">Ordering Returns </div>
          
        </div>
    
        <div class="col-12 col-md-5 mt-3">
        <div class="input-group">
            <input type="text" class="form-control" id="searchInput" placeholder="Search Transaction Code">
            <button class="btn btn-primary" type="button" id="button-addon2">Search</button>
        </div>


        </div>
        <div class="col-12 col-md-3 mt-3 d-flex justify-content-end">
            <button class="btn  border" data-bs-toggle="modal" data-bs-target="#export"><img src="../assets/images/export.png"  class="btn-img" alt=""> Export</button>
          <div class="btn-group ">
              <button type="button" class="btn btn-primary dropdown-toggle mx-2" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="../assets/images/view.png" class="btn-img" alt=""> View As
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" id="pos">POS Transactions</a></li>
                <li><a class="dropdown-item" href="#" id="online">Ordering Transactions</a></li>
                <li><a class="dropdown-item" href="#" id="return_pos">POS Returns</a></li>
                <li><a class="dropdown-item" href="#" id="return_order">Ordering Returns</a></li>
              </ul>
            </div>
        </div>
        
        
        <div class="col-12 col-md-12 mt-3">
            <!-- table Transactions -->
            <div class="table-div" id="view_transaction">
                    <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col" width="5%"></th>
                        <th scope="col" width="15%">Transaction Code</th>
                        <th scope="col" width="10%">Subtotal</th>
                        <th scope="col" width="10%">Discount</th>
                        <th scope="col" width="10%">VAT</th>
                        <th scope="col" width="10%">Total</th>
                        <th scope="col" width="10%">Payment</th>
                        <th scope="col" width="10%">Change</th>
                        <th scope="col" width="20%">Cashier name</th>
                        <th scope="col" width="20%">Position</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include '../functions/table_transactions.php'?>
                        
                    </tbody>
                    </table>
                <!-- table Transactions -->
                </div>
                
                <div class="table-div" style="display: none;" id="view_online">
                    <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col" width="5%"></th>
                        <th scope="col" width="15%">Transaction Code</th>
                        <th scope="col" width="10%">Subtotal</th>
                        
                        <th scope="col" width="10%">Shipping fee</th>
                        <th scope="col" width="10%">Total</th>
                        <th scope="col" width="10%">Payment</th>
                        <th scope="col" width="10%">Name</th>
                        <th scope="col" width="20%">Date Recieved</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include '../functions/table_online.php'?>
                        
                    </tbody>
                    </table>
                <!-- table Transactions -->
                </div>



                
                <div class="table-div" style="display: none;" id="view_return_pos">
                    <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col" width="15%">Transaction Code POS</th>
             
                       
                 
                        <th scope="col" width="10%">Total</th>
                        <th scope="col" width="20%">Cashier</th>
                        <th scope="col" width="20%">Date Recieved</th>
                        <th scope="col" width="20%">Date Return</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  include '../functions/table_returnPOs.php'?>
                        
                    </tbody>
                    </table>
                <!-- table Transactions -->
                </div>















                <div class="table-div" style="display: none;" id="view_return_order">
                    <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col" width="5%"></th>
                        <th scope="col" width="15%">Transaction Code Order</th>
                        <th scope="col" width="10%">Subtotal</th>
                        <th scope="col" width="10%">VAT</th>
                        <th scope="col" width="10%">Shipping fee</th>
                        <th scope="col" width="10%">Total</th>
                        <th scope="col" width="10%">Payment</th>
                        <th scope="col" width="10%">Name</th>
                        <th scope="col" width="20%">Date Recieved</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php // include '../functions/table_online.php'?>
                        
                    </tbody>
                    </table>
                <!-- table Transactions -->
                </div>
          </div>


    </div>
    
</div>

<!-- Modal -->
<div class="modal fade mt-4" id="export" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Exportation Setup</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="input-group mb-3">
          <label class="input-group-text" for="inputGroupSelect01">Select Options</label>
          <select class="form-select" id="inputGroupSelect01">
            <option selected>All</option>
            <option value="1">Year</option>
            <option value="2">Month</option>
            <option value="3">Days</option>
          </select>
        </div>
        <div class="input-group mb-3">
          <label class="input-group-text w-25" for="inputGroupSelect01">Select Year</label>
          <input type="date" class="input-group-text w-75">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Export</button>
      </div>
    </div>
  </div>
</div>

<script src="../assets/js/transaction_showhide_components.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>


<!-- Add this script below your existing jQuery script -->
<!-- Add this script below your existing jQuery script -->
<script>
    $(document).ready(function () {
        // Function to handle search for both offline and online transactions
        $('#searchInput').on('input', function () {
            var searchTerm = $(this).val().toLowerCase();

            // Hide/show rows based on search term in offline transactions
            $('#view_transaction .clickable-row').each(function () {
                var transactionCode = $(this).find('#tcode').text().toLowerCase();

                if (transactionCode.includes(searchTerm)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });

            // Hide/show rows based on search term in online transactions
            $('#view_online .clickable-row').each(function () {
                var transactionCode = $(this).find('#tcode').text().toLowerCase();

                if (transactionCode.includes(searchTerm)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>

