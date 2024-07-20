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
            <button class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#add_product"><img src="../assets/images/add_inventory.png" class="btn-img" alt=""> Add Product</button>
          <!--  <button class="btn btn-primary me-0" data-bs-toggle="modal" data-bs-target="#stock"><img src="../assets/images/stocks.png" class="btn-img" alt="">Add Stocks</button>--->
        </div>
        
        <div class="col-12 col-md-12 mt-3">
            <div class="table-div">
                <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col" width="10%">Product ID</th>
                    <th scope="col" width="15%">Date Added</th>
                    <th scope="col" width="25%">Product Name</th>
                    <th scope="col" width="10%">Stocks</th>
                    <th scope="col" width="15%">Barcode</th>
                    <th scope="col" width="20%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php include '../functions/table_inventory.php'?>
                    
                </tbody>
                </table>
            </div>
        </div>
    </div>
    
</div>




<!-- Modal add_product-->
<div class="modal fade mt-4" id="add_product" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Product</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
                  
      
      <form action="../functions/add_product.php" method="POST" enctype="multipart/form-data" id="productForm">

                  <input hidden type="text" value="<?=$acc_id?>" name="acc_id">

                <input type="text" required class="form-control" placeholder="Product Name" name="name">
                <input type="number" required class="form-control mt-2" name="r_price" placeholder="Current Price" min="1" step="0.01">

                
                <div class="row">
                    <div class="col-12 col-md-6 mt-2">
                        <div class="dropdown">
                        <!--  <button class="btn w-100 btn border border-1 dropdown-toggle text-start" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                              Select Category
                          </button>--->
                          <select class="btn w-100 btn border border-1 dropdown-toggle text-start" name="category" id="category" >
                            <option value="">Select Category</option>

                   
                              <?php
                             
                              $sql = "SELECT * FROM `category`";
                              $result = mysqli_query($conn, $sql);

                              if ($result) {
                                  while ($row = mysqli_fetch_assoc($result)) {
                                   echo '<option value="' . $row['category_id'] . '">' . $row['category_name'] . '</option>';
                                   
                                 }
                              } else {
                                  echo 'Error: ' . mysqli_error($conn);
                              }
                              ?>
                        
                            </select>
                      </div>
                    </div>
                    <div class="col-12 col-md-6 mt-2">
                    <div class="dropdown">
                         <!-- <button for="unit" class="btn w-100 btn border border-1 dropdown-toggle text-start" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                              Select Unit
                          </button> --->

                         <!-- <ul class="dropdown-menu w-100" style="max-height: 80px; overflow-y: auto;">--->
                          <select class="btn w-100 btn border border-1 dropdown-toggle text-start" name="unit" id="unit" >
                            <option value="">Select Unit</option>
                              <?php
                              // Assuming you have a database connection established
                              $sql = "SELECT * FROM `unit`";
                              $result = mysqli_query($conn, $sql);

                              if ($result) {
                                  while ($row = mysqli_fetch_assoc($result)) {
                                    //echo '<li><a class="dropdown-item" href="#"><input type="radio" name="unit" value="' . $row['unit_id'] . '">' . $row['unit_name'] . '</a></li>';
                                    echo '<option  value="' . $row['unit_id'] . '">' . $row['unit_name'] . '</option>';
                                    
                                  }
                              } else {
                                  echo 'Error: ' . mysqli_error($conn);
                              }
                              ?>
                          </select>
                          <!--  </ul>-->
                      </div>
                    </div>
                </div>
                <input type="number" required class="form-control mt-2" name="c_level" placeholder="Critical Level" min="1" step="1" pattern="^[1-9]\d*$">

                <input required class="form-control mt-2" type="file" id="formFile" name="img">
                <input type="text" required class="form-control mt-2" placeholder="Description" name="description">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary w-25" data-bs-dismiss="modal">Cancel</button>
                    <button disabled type="submit" name="save" class="btn btn-primary w-25" id="btnSave">Save</button>

                </div>
            </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Stock-->
<div class="modal fade mt-4" id="stock" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Stocks</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="../functions/add_stocks.php" method="POST">
              <div class="dropdown">
                                  <button class="btn w-100 btn border border-1 dropdown-toggle text-start" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                      Select Product
                                  </button>

                                  <ul class="dropdown-menu w-100" style="max-height: 80px; overflow-y: auto;">
                                      <?php
                                      // Assuming you have a database connection established
                                      $sql = "SELECT * FROM `product` WHERE prod_status = 0";
                                      $result = mysqli_query($conn, $sql);

                                      if ($result) {
                                          while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<li><a class="dropdown-item" href="#"><input type="radio" required name="prod_id" value="' . $row['prod_id'] . '">' . $row['prod_name'] . '</a></li>';
                                          }
                                      } else {
                                          echo 'Error: ' . mysqli_error($conn);
                                      }
                                      ?>
                                  </ul>
                </div>
              <input type="number" required name="amount" placeholder="Enter amount to add" class="form-control mt-2">
              <input type="date" required name="date" placeholder="Enter amount to add" class="form-control mt-2" min="<?php echo date('Y-m-d'); ?>">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary w-25" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary w-25">Save</button>
          </form>
      </div>
    </div>
  </div>
</div>







<script src="../assets/js/prevent_negative_numbers.js"></script>
<script src="../assets/js/login-loading.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
<script>
    $(document).ready(function () {
        // Function to check if all required fields are filled
        function checkFields() {
            var formValid = true;

            // Loop through each required input and select
            $('#productForm input[required], #productForm select[required]').each(function () {
                if ($(this).val() === '') {
                    formValid = false;
                    return false; // Exit the loop if any field is empty
                }
            });

            // Check the Current Price input for a valid positive decimal number
            var currentPriceInput = $('#productForm input[name="r_price"]');
            var currentPriceValue = parseFloat(currentPriceInput.val());
            if (isNaN(currentPriceValue) || currentPriceValue < 0.01) {
                formValid = false;
            }

            // Check the Critical Level input for a valid positive whole number without a dot at the end
            var criticalLevelInput = $('#productForm input[name="c_level"]');
            var criticalLevelValue = criticalLevelInput.val();
            if (criticalLevelValue.includes('.') || !(/^\d+$/.test(criticalLevelValue))) {
                formValid = false;
            }

            // Check if an image is selected
            var imageInput = $('#productForm input[name="img"]');
            var fileName = imageInput.val();
            var validImageFormats = ['jpg', 'jpeg', 'png', 'gif'];

            if (fileName) {
                var fileExtension = fileName.split('.').pop().toLowerCase();
                if ($.inArray(fileExtension, validImageFormats) === -1) {
                    formValid = false;
                }
            }

            // Enable or disable the Save button based on form validity
            $('#btnSave').prop('disabled', !formValid);
        }

        // Call the checkFields function on input change
        $('#productForm input[required], #productForm select[required], #productForm input[name="r_price"], #productForm input[name="c_level"], #productForm input[name="img"]').on('input change', function () {
            checkFields();
        });

        // Call the checkFields function on page load
        checkFields();
    });
</script>
