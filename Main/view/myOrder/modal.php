
	
	<?php 
	include "view/myOrder/viewQuery.php";	
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

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Warning</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="orders_status" id="orders_status">
					<input type="hidden" class="form-control mt-2" id="orders_id" name="orders_id" required>
				
					<h5 id="warning"></h5>
					
				</div>
				<div class="modal-footer">
					<button type="button" id="cancelBtn" class="btn btn-danger">Yes</button>
					<button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal modTrash -->
<div class="modal fade" id="modTrash" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="back_ordering.php" method="POST">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Archive</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<input type="hidden" id="orders_id_remove"  name="order_id">
					<input type="hidden" id="value2"  name="value2">
					<input type="hidden" id="orders_status_rem" name="orders_status_rem" required>
					
					<h5>Move to archive this record?</h5>
				</div>
				<div class="modal-footer">
					<button type="submit" name="btnRemove" class="btn btn-danger">Yes</button>
					<button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>