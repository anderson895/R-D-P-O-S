
	
	<?php 
	include "userlist_order/controller/viewQuery.php";	


	 while ($row = mysqli_fetch_assoc($view_query)) {
        $orders_prod_id = $row["orders_prod_id"];
        $orders_subtotal = $row["subtotal"];
    
        
        if (isset($combined_subtotals[$orders_prod_id])) {
        
            $combined_subtotals[$orders_prod_id] += $orders_subtotal;
        } else {
        
            $combined_subtotals[$orders_prod_id] = $orders_subtotal;
        }
    
    
    
        $orders_id = $row["orders_id"];
        $order_transaction_code = $row["order_transaction_code"];
        $orders_nickname = $row["orders_nickname"];
        $orders_email = $row["orders_email"];
        $orders_contact = $row["orders_contact"];
        $orders_paymethod = $row["orders_paymethod"];
        $orders_qty = $row["orders_qty"];
        $db_qty = $row["qty"];
        $orders_voucher_rate = $row["orders_voucher_rate"];
        $orders_address = $row["orders_address"];
        $orders_date = $row["orders_date"];
        $orders_status = $row["orders_status"];
    
        $get_Product_info = mysqli_query($connections, "SELECT * FROM product WHERE prod_id='$orders_prod_id'");
        $product_row = mysqli_fetch_assoc($get_Product_info);
        $prod_name = $product_row["prod_name"];
        $prod_currprice = $product_row["prod_currprice"];
    
	}
	?>





	<!-- Modal -->

	<div class="modal fade exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Warning</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
				
			
				
				<img style="display:none;" id="proofImage" />
					<input hidden type="text" id='customerFullname' class='customerFullname'>
					<input hidden type="text" class='acc_id' name="acc_id" value='<?=$acc_id?>'>
					<input hidden type="text" name="order_transaction_code" class='order_transaction_code' >

					<input hidden type="text" name="orders_status" class='orders_status' >
					<input  hidden type="text" class="form-control mt-2 orders_id" name="orders_id" required>
				
				
					<h5 id="warning" class="text-center"></h5>
					
					
				</div>
				<div class="modal-footer">
					<div class='loadingSpinner' id="loadingSpinner"></div>
					<button type="button" class="btn btn-danger btnAcceptOrder">Yes</button>
					<button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button>
				</div>
			</div>
		</div>
	</div>
</div>







<div class="modal fade" id='declineModal' tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="back_ordering.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Decline</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
					<input hidden type="text" id='customerFullname' class='customerFullname'>
                    <input hidden type="text" class='order_transaction_code' name="order_transaction_code">
                    <input hidden type="text" class='orders_status' name="status">
                    <input hidden type="text" class='acc_id' name="acc_id" value='<?=$acc_id?>'>
                    

                    <h5>Decline <span class='customerfull_name'></span>'s order ?</h5>
                </div>
                <div class="modal-footer">
					<div class='loadingSpinner' id="loadingSpinner"></div>
                    <button type="button" name="btnDecline" class="btn btn-danger btnDecline">Yes</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button>
                </div>
            </form>
        </div>
    </div>
</div>





<div class="modal fade toRecieveModal"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
          
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Warning</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
					<input hidden type="text" class='customerFullname' name="customerFullname">
                    <input hidden type="text" class='order_transaction_code' name="order_transaction_code">
                    <input hidden type="text" class='orders_status' name="status">
                    <input hidden  type="text" class='acc_id' name="acc_id" value='<?=$acc_id?>'>
                    

                    <h3 class='text-center'>Change status to recieve</h3>
                </div>
                <div class="modal-footer">
					<div class='loadingSpinner' id="loadingSpinner"></div>
                    <button type="button" name="btnDecline" class="btn btn-danger btnToRecieve">Yes</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button>
                </div>
         </form>
        </div>
    </div>
</div>



<div class="modal fade completeModal"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="back_ordering.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Warning</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
					<input hidden type="text" class='customerFullname' name="customerFullname">
                    <input hidden  type="text" class='order_transaction_code' name="order_transaction_code">
                    <input hidden  type="text" class='orders_status' name="status">
                    <input hidden type="text" class='acc_id' name="acc_id" value='<?=$acc_id?>'>
                    

                    <h3 class='text-center'>Change status to complete</h3>
                </div>
                <div class="modal-footer">
                    <button type="button"name="btnDecline" class="btn btn-danger btnComplete">Yes</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--completeModal-->




<div class="modal fade removeModal"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="back_ordering.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Warning</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
					<input hidden type="text" class='customerFullname' name="customerFullname">
                    <input hidden  type="text" class='order_transaction_code' name="order_transaction_code">
                    <input hidden  type="text" class='orders_status' name="status">
                    <input hidden type="text" class='acc_id' name="acc_id" value='<?=$acc_id?>'>
                    

                    <h3 class='text-center'>Remove from the display ?</h3>
                </div>
                <div class="modal-footer">
                    <button type="button"name="btnDecline" class="btn btn-danger btnRemoveDisplay">Yes</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button>
                </div>
            </form>
        </div>
    </div>
</div>









<div class="modal fade archiveModal"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="back_ordering.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Warning</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
					<input hidden type="text" class='customerFullname' name="customerFullname">
                    <input hidden  type="text" class='order_transaction_code' name="order_transaction_code">
                    <input hidden  type="text" class='orders_status' name="status">
                    <input hidden type="text" class='acc_id' name="acc_id" value='<?=$acc_id?>'>
                    

                    <h3 class='text-center'>Transaction record move to archive ?</h3>
                </div>
                <div class="modal-footer">
                    <button type="button" name="btnArchive" class="btn btn-danger btnRemoveDisplay">Yes</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button>
                </div>
            </form>
        </div>
    </div>
</div>