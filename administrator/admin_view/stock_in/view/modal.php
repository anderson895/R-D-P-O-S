<!-- Modal stock_in -->
<div class="modal fade mt-4" id="add" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Stock In</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Product selection dropdown and search -->
        <label for="searchProduct">Search product details</label>
        <input type="text" class="form-control mt-2" id="searchProduct" placeholder="Search...">
        <input hidden type="text" class="form-control mt-2" id="searchProductCode">
        <input hidden type="text" class="form-control mt-2" id="prod_expirationStatus">
        <!-- Suggestions container -->
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12" style="position: relative;">
              <div id="suggestionsContainer" style="position: absolute; background-color: white; z-index: 100; width:100%;"></div>
              <!-- Your other content goes here -->
            </div>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-md-6 text-start">
              <h6 id="productname" class="mt-4 "></h6>
            </div>
            <div class="col-md-6 text-end">
              <img id="productImage" class="img-fluid mt-4" style="display:none; max-height: 150px; max-width: 150px;" alt="Product Image">
            </div>
          </div>
        </div>
        <!-- Quantity and Supplier Price input fields -->
        <div class="d-flex flex-row">
          <div class="form-group me-3 mt-4">
            <label for="qtyInput">Quantity <strong style="display:none;" id='unitLabel'>Unit</strong></label>
            <input type="number" class="form-control txtInputQty" min="1" placeholder="0" id="qtyInput">
          </div>
          <div class="form-group mt-4">
            <label for="supplierPriceInput">Supplier Price</label>
            <input type="number" class="form-control" placeholder="0.00" id="supplierPriceInput">
          </div>
        </div>
        <div class="form-group me-3 mt-2" id="expiDateDiv">
          <label for="expiDate">Expiration Date</label>
          <input type="date" class="form-control" id="expiDate">
        </div>
      </div>
      <!-- Modal footer with Save and Cancel buttons -->
      <div class="modal-footer">
        <button type="button" id="btnSave" name="save" class="btn btn-primary w-25">Save</button>
        <button type="button" class="btn btn-secondary w-25" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>










<!-- Modal stock_in -->
<div class="modal fade mt-4" id="edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Stock In</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Product selection dropdown and search -->
        <label for="updatesearchProduct">Search product details</label>
        <input  type="text" class="form-control mt-2" id="updatesearchProduct" placeholder="Search...">
        <input hidden type="text" class="form-control mt-2" id="updatesearchProductCode">
        <input hidden type="text" class="form-control mt-2" id="updateprod_expirationStatus">
        <input hidden type="text" class="form-control mt-2" id="db_s_id">
        <!-- Suggestions container -->
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12" style="position: relative;">
              <div id="updatesuggestionsContainer" style="position: absolute; background-color: white; z-index: 100; width:100%;"></div>
              <!-- Your other content goes here -->
            </div>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-md-6 text-start">
              <h6 id="updateproductname" class="mt-4 "></h6>
            </div>
            <div class="col-md-6 text-end">
              <img id="updateproductImage" class="img-fluid mt-4" style="display:none; max-height: 150px; max-width: 150px;" alt="Product Image">
            </div>
          </div>
        </div>
        <!-- Quantity and Supplier Price input fields -->
        <div class="d-flex flex-row">
          <div class="form-group me-3 mt-4">
            <label for="updateqtyInput">Quantity <strong style="display:none;" id='UpdateunitLabel'>Unit</strong></label>
            <input type="number" class="form-control" min="1" placeholder="0" id="updateqtyInput">
          </div>
          <div class="form-group mt-4">
            <label for="updatesupplierPriceInput">Supplier Price</label>
            <input type="number" class="form-control" placeholder="0.00" id="updatesupplierPriceInput">
          </div>
        </div>
        <div class="form-group me-3 mt-2" id="updateexpiDateDiv">
          <label for="updateexpiDate">Expiration Date</label>
          <input type="date" class="form-control" id="updateexpiDate">
        </div>
      </div>
      <!-- Modal footer with Save and Cancel buttons -->
      <div class="modal-footer">
        <button type="button" id="btnEdit" name="btnEdit" class="btn btn-primary w-25">Update Save</button>
        <button type="button" class="btn btn-secondary w-25" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>



<script>
  function checkInvoiceNumber() {
    var invoiceNo = document.getElementById('invoice_no').value;

    // Perform AJAX request
    $.ajax({
      type: 'POST',
      url: 'stock_in/controller/check_invoice.php', // Create this file to check if the invoice number exists
      data: { invoice_no: invoiceNo },
      success: function(response) {
        if (response === 'exists') {
          alertify.error('Invoice number already exists. Please use a different one.');
        } else {
          // If invoice number doesn't exist, submit the form
          document.getElementById('stock_form').submit();
        }
      }
    });

    // Prevent the form from submitting immediately
    return false;
  }
</script>

<!-- Modal -->
<div class="modal fade" id="stock_in" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">New Stock</h1>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="add_stock.php" id="stock_form" onsubmit="return checkInvoiceNumber();">
   
          <label for="invoice_no">Invoice No.</label>
          <input type="text" name="invoice_no" id="invoice_no" class="form-control mb-3" required placeholder="Invoice No.">
          
          <label for="supplier_code">Select Supplier</label>
          <select name="supplier_code" id="supplier_code" class="form-select" aria-label="Default select example" required>
            <option selected disabled>Select Supplier</option>
            <?php
            $view_query = mysqli_query($connections, "SELECT * FROM supplier WHERE spl_status='0'");
            while ($row = mysqli_fetch_assoc($view_query)) {
              $db_spl_code = $row["spl_code"];
              $db_spl_name = $row["spl_name"];
              echo '<option value="' . $db_spl_code . '">' . $db_spl_name . '</option>';
            }
            ?>
          </select>
          
          <label for="stockin_date" class="mt-3">Stockin Date</label>
          <input type="date" name="stockin_date" id="stockin_date" class="form-control" value="<?php echo date("Y-m-d")?>">
      </div>
      <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="stock_submit_btn">Set</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="export" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Export </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <select class="form-select" aria-label="Default select example">
        <option selected>Select Export As</option>
        <option value="1">Excel</option>
        <option value="2">PDF</option>
      </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Export</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cancel</button>

      </div>
    </div>
  </div>
</div>