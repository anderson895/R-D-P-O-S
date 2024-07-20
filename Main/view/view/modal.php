
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" >
          <div class="modal-content" >
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add to cart</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
      
      <form method="POST" action="addcart.php">
          
          
      
        <div class="modal-body">
      <input type="hidden" id="id" name="id">

      <?php
      ?>
        
        <center>
          <div class="discount">
          
          <button type="button" class="m-btn btn btn-default decrease" onclick="decreaseQuantity(this)" data-id="'.$db_cart_id.'"><i class="fa fa-minus"></i></button>
        
        <input style="width:100px;" name="qty" type="number" class="m-btn btn btn-default qty-input" value="1" min="1" max="" required>
            
              
          <button type="button" class="m-btn btn btn-default" onclick="increaseQuantity(this)" ><i class="fa fa-plus"></i></button>
      
          </div>		
          </center>
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="add" class="btn btn-danger">Cunfirm</button>
        </div>
        </form>
      </div>
    </div>
</div>

<!--start-modalBuynow-->

<div class="modal fade" id="modalBuynow" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" >
          <div class="modal-content" >
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Buy now</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
      
      <form method="POST" action="checkoutBuyNow.php">
          
          
      
        <div class="modal-body">
      <input type="hidden" id="id" name="id">

      <?php
      ?>
        
        <center>
          <div class="discount">
          <input hidden type="text" name="ssid" id="ssid">
          <input hidden type="text" name="myCheckbox" id="myCheckbox">
          <input hidden type="text" name="prod_name" id="prod_name">
          <input hidden type="text" name="prod_currprice" id="prod_currprice">
          <button type="button" class="m-btn btn btn-default decrease" onclick="decreaseQuantity(this)" data-id="'.$db_cart_id.'"><i class="fa fa-minus"></i></button>
        
        <input name="qty" type="number" class="m-btn btn btn-default qty-input" value="1" min="1" max="" required>
            
              
          <button type="button" class="m-btn btn btn-default" onclick="increaseQuantity(this)" ><i class="fa fa-plus"></i></button>
      
          </div>		
          </center>
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="btnCheckOut" class="btn btn-danger">Cunfirm</button>
        </div>
        </form>
      </div>
    </div>
</div>
<!--end-modalBuynow-->

<style>
  /* Add this style to reduce the width of the input field */
  .qty-input {
    width: 50px; /* You can adjust the width according to your preference */
  }

  /* Add this media query for responsiveness on smaller screens */
  @media (max-width: 768px) {
    .qty-input {
      width: 100%; /* Set the input width to 100% on smaller screens */
      max-width: 200px; /* You can adjust the maximum width if needed */
    }
  }
</style>


<script>
  function decreaseQuantity(button) {
    var inputField = $(button).closest('.discount').find('.qty-input');
    var currentValue = parseInt(inputField.val());
    if (currentValue > 1) {
      inputField.val(currentValue - 1);
    }
  }

  function increaseQuantity(button) {
    var inputField = $(button).closest('.discount').find('.qty-input');
    var currentValue = parseInt(inputField.val());
    inputField.val(currentValue + 1);
  }
</script>