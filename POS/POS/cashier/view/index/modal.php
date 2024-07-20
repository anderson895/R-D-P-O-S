
<!-- Modal cart -->
<div class="modal fade" id="ModalCart" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
		
	  <form method="POST" action="addcart.php">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add to cart</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
			<input type="text" id="id" name="id">
            How many <span id='unit_nameDisplay'></span>?<br>
	
        <input type="number" name="qty" required class="form-control" min="1" placeholder="" >							
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="add" class="btn btn-primary">Cunfirm</button>
      </div>
	  	</form>
    </div>
  </div>
</div>
<!--end modal-->



<!-- Modal cart --><div class="modal fade" id="ModalRemove" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
		
	  <form method="POST" action="removecart.php">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Remove to cart</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
			<input type="text" id="id_remove" hidden name="removeid">
		<center> Remove <b id="db_prod_name" ></b>? </center>

		
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="btnRemove" class="btn btn-primary">Cunfirm</button>
      </div>
	  	</form>
    </div>
  </div>
</div>

	<!-- Modal CheckOUt-->
	<div class="modal fade" id="ModalCheckOut" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="checkoutForm" method="POST" >
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Check out</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
		<input type="hidden" name="discountname" id="discountname">
          <input type="hidden" id="finalTotalInput"    name="finalTotalDisplay">
          <input type="hidden" id="pos_cart_user_id"  name="pos_cart_user_id">
  
		  <?php 
	$view_query = mysqli_query($connections, "SELECT * FROM pos_cart where pos_cart_user_id=$acc_id");
	  $total_bill = 0;
	  while ($row = mysqli_fetch_assoc($view_query)) {
			$db_cart_user_id= $row["pos_cart_user_id"];
			$db_pos_cart_id = $row["pos_cart_id"]; 
			$db_cart_prod_id  = $row["pos_cart_prod_id"]; 
	  		$db_cart_prodQty  = $row["cart_prodQty"]; 
		  ?>
		 <!---Cart ID---->
		  <input type="hidden" value="<?php echo $db_pos_cart_id?>"  name="pos_cart_id[]">
		   <!---Product ID---->
		  <input type="hidden" value="<?php echo $db_cart_prod_id?>"  name="prod_id[]">
		   <!---Quantity---->
		  <input type="hidden" value="<?php echo $db_cart_prodQty?>"  name="prodqty[]">
		  
		  <?php }?>
		 
		  

		<input type="hidden" value="<?php echo $db_cart_user_id?>"   name="db_cart_user_id" value="0">
		  <input type="hidden" id="discountInput"   name="discount" value="0">

		
		  <input type="hidden" name="db_system_tax" value="<?php echo $db_system_tax?>"><br>
          <input class="form-control" type="text" name="Payment" placeholder="Enter Payment"><br>
          <span class="error"></span>

          <div>
            <label>Final Total:</label>
            <span id="finalTotalDisplay"><?php echo number_format($totalSum, 2, '.', ',') ?></span>
          </div>
        </div>
		
		
		
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="btnPayment" class="btn btn-primary">Confirm</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!--ModalCancel-->
	<!-- Start modal cancel -->
<div class="modal fade" id="ModalCancel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
		
	  <form method="POST" action="removeAll.php">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Warning</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
			<input type="hidden" value="<?php echo $pos_cart_user_id?>" name="pos_cart_user_id">
		REMOVE ALL FROM THE CART

	
      				
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="btnRemoveAll" class="btn btn-primary">Cunfirm</button>
      </div>
	  	</form>
    </div>
  </div>
</div>
<!--End Cancel--->