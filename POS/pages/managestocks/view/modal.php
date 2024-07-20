<input hidden type="text" value="<?=$acc_id?>" id="acc_id">
<div class="modal fade" id="ModAddStocks" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background-color: rgb(96, 0, 0); color: #fafbfe;">
        <h5 class="modal-title">Add to Cart</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
          <h5 id="db_prod_name1">
            <span style="text-transform: capitalize; display: block; text-align: center;" id="productnameLabeled">Sample Product Name</span>
          </h5>
          <hr>

        <form method="POST" onsubmit="return validateForm();">
          <input hidden type="text" id="supplierNameModal">
          <input hidden type="text" id="productNameModal">


          <div class="row mb-3">
    <div class="col-md-8">
      <!-- Left side with form groups -->
      <div class="form-group">
        <label for="quantity">Current price:</label>
        <span class="input-group-text" id="currentprice"></span>
      </div>
      <div class="form-group">
        <label for="quantity">Available Stocks:</label>
        <span class="input-group-text" id="stocks"></span>
      </div>
    </div>
    <div class="col-md-4">
      <!-- Right side with image -->
      <img src="#" alt="Product Image" class="img-fluid" id="productImage" style="max-height: 200px;">
    </div>
  </div>


          <div class="form-group">            
            <label for="quantity">Stocks Quantity:</label>
            <div class="input-group">
              <input type="number" id="quantity" placeholder="Quantity" min="1" name="quantity" class="form-control" required>
              <div class="input-group-append">
                <span class="input-group-text" id="unit"></span>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="purchasePrice">Purchase Price:</label>
            <div class="input-group">
              <input type="number" id="purchasePrice" placeholder="Purchase price" min="1" name="purchase_price" class="form-control" required>
              <div class="input-group-append">
                <span class="input-group-text">₱</span>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="discount">Discount:</label>
            <div class="input-group">
              <input type="number" id="discount" placeholder="Discount" min="0" name="discount" class="form-control" required>
              <div class="input-group-append">
                <span class="input-group-text">₱</span>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="tax">Tax:</label>
            <div class="input-group">
              <input type="number" id="tax" placeholder="Tax" min="0" name="tax" class="form-control" required>
              <div class="input-group-append">
                <span class="input-group-text" style="font-weight: bold; font-size: 15px;">%</span>
              </div>
            </div>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="radio" name="expirationOption" value="NoExpiration" onchange="toggleExpirationInput(false)" required>
            <label class="form-check-label" for="noexpire">No Expiration</label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="radio" name="expirationOption" value="withExpiration" onchange="toggleExpirationInput(true)" required>
            <label class="form-check-label" for="expire">With Expiration</label>
          </div>

          <div class="form-group" id="expirationDateInput" style="display: none;">
            <label for="expirationDate">Expiration Date</label>
            <input type="date" id="expirationDate" class="form-control" name="prod_expiration">
          </div>
        </form>
      </div>
      <div class="modal-footer justify-content-center">
        <button disabled type="button" class="btn btn-primary" id="addStockButton">Add Stocks</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>



 <script>
 $(document).ready(function () {
    // Ito ang code para alisin ang backdrop
    $('#ModAddStocks  ').on('hidden.bs.modal', function () {
      $('.modal-backdrop').remove();
    });
  });



  



  document.getElementById("addStockButton").addEventListener("click", function(event) {
    event.preventDefault(); // Prevent the default form submission


    $("#ModAddStocks").hide()
    $('.modal-backdrop').remove();
    
      var referenceNo = $("#referenceNo").val();
      var acc_id = $("#acc_id").val();
      var supplierNameModal = $("#supplierNameModal").val();
      
      var productNameModal = $("#productNameModal").val();
      var quantity = $("#quantity").val();
      var purchasePrice = $("#purchasePrice").val();
      var discount = $("#discount").val();
      var tax = $("#tax").val() / 100;
      var selectedOption = document.querySelector('input[name="expirationOption"]:checked').value;
      var expirationDate = "N/A";

      if (selectedOption === "withExpiration") {
        expirationDate = document.getElementById("expirationDate").value;
      }

      var purchased_Tax_Amount = tax * (quantity * purchasePrice);
      var purchased_Total_Cost = (quantity * purchasePrice) - discount;

      var formData = new FormData();

      formData.append("supplierNameModal", supplierNameModal);
      formData.append("productNameModal", productNameModal);
      formData.append("quantity", quantity);
      formData.append("purchasePrice", purchasePrice);
      formData.append("selectedOption", selectedOption);
      formData.append("expirationDate", expirationDate);
      formData.append("discount", discount);
      formData.append("tax", tax);
      formData.append("purchased_Tax_Amount", purchased_Tax_Amount);
      formData.append("purchased_Total_Cost_final", purchased_Total_Cost);

      formData.append("referenceNo", referenceNo);
      formData.append("acc_id", acc_id);

      $.ajax({
        url: "managestocks/controller/insertToPurchasedStockCart.php",
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          alertify.success("Purchased successfully saved.");
                          var t;
                        Swal.fire({
                            title: "Inserting",
                            html: "Loading ... <strong></strong>%.",
                            timer: 2e3,
                            confirmButtonClass: "btn btn-primary",
                            buttonsStyling: !1,
                            onBeforeOpen: function() {
                                Swal.showLoading(), t = setInterval(function() {
                                    Swal.getContent().querySelector("strong").textContent = Swal.getTimerLeft()
                                }, 100)
                            },
                            onClose: function() {
                                clearInterval(t)
                            }
                        }).then(function(t) {
                            t.dismiss === Swal.DismissReason.timer && console.log("I was closed by the timer")
                        })
                          
          
          console.log(response)
        // Close the modal on success
        $('#ModAddStocks').modal('hide');
        

          document.getElementById("referenceNo").value = "";
          document.getElementById("supplierNameModal").value = "";
          document.getElementById("productNameModal").value = "";
          document.getElementById("quantity").value = "";
          document.getElementById("purchasePrice").value = "";
          document.getElementById("discount").value = "";
          document.getElementById("tax").value = "";
          document.getElementById("expirationDate").value = "";

          document.getElementById("addStockButton").disabled = true;
          document.querySelector('input[name="expirationOption"]:checked').checked = false;
        },
        error: function(xhr, status, error) {
          console.log(response);
        }
      });
    

      
  });
</script>




