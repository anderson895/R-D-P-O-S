

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">[Payment] Transaction</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              
                    <select id="BankEwallet" name="paymethod" class="form-control mt-2" title="Select payment option" required>
                        <option value="">Payment option</option>
                        <option value="Pay on store">Pay on store</option>
                     
                        <?php
                        $view_product_query = mysqli_query($connections, "SELECT * FROM mode_of_payment where payment_status='1'");
                        while ($category_row = mysqli_fetch_assoc($view_product_query)) {
                            $payment_id  = $category_row["payment_id"];
                            $payment_name = $category_row["payment_name"];
                            $payment_number = $category_row["payment_number"];
                            $payment_image = $category_row["payment_image"];
                            $payment_status = $category_row["payment_status"];
                            ?>
                            <option data-image="<?= $payment_image ?>" data-number="<?= $payment_number ?>" value="<?= $payment_name ?>"><?= $payment_name ?></option>
                        <?php }?>
                    </select>

             

                    
                    <input hidden type="text" value="<?= $db_system_tax ?>" name="orders_tax" id="db_system_tax">

                    <div class="form-group mt-2 text-center" id="proofAttachment" style="display: none;">
    
                    <div id="paymentImage" class="payment-image"></div>
                    <div id="paymentNumber" class="mt-2"></div>
                    <label for="attachment">Attach Proof of Payment:</label>
                    <input type="file" name="attachment" id="paymentAttachment" class="form-control" accept="image/*">

                </div>
                
                <div id="loadingSpinner" class="text-center" style="display: none;">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="border: none;">
                <button disabled type="button" name="btnCunfirm" id="btnCunfirmOrder" class="btn btn-danger">Confirm</button>
                <button type="button" id="no" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">No</button>
            </div>
        </div>
    </div>
</div>