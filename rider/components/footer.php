</main>

<div class="modal" tabindex="-1" role="dialog" id="changeOrderStatusModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-check-square"></i> Change Order Status to "Delivered"</h5>
            </div>
            <form id="frmChangeOrderStatus">
                <input type="hidden" name="requestType" value="UpgradeOrderStatus">
                <input type="hidden" name="orderId" id="changeOrderStatusModalOrderId" value="">
                <div class="modal-body">
                    <h6>Are you sure that you want to change the Order Status to Delivered?</h6>
                    <div class="input-container-label-top mt-3">
                        <label>Upload a proof of delivery</label>
                        <input type="file" class="form-control" id="proofOfDel" name="proofOfDel" accept="image/*" required>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        <span class="btn-text">Yes</span>
                    </button>
                    <button type="reset" class="btn btn-secondary btnCloseModal" id="btnCloseModal" data-dismiss="modal">No</button>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="modal" tabindex="-1" role="dialog" id="UnsuccessOrderStatusModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-check-square"></i> Change Order Status to "Unsuccessful"</h5>
            </div>
            <form id="frmUnsuccessfulOrderStatus">
                <input type="hidden" name="requestType" value="UnsuccessOrderStatus">
                <input type="hidden" name="orderId" id="UnsuccessOrderStatusModalOrderId" value="">
                <div class="modal-body">
                    <h6>Are you sure that you want to change the Order Status to Unsuccessful?</h6>
                    <div class="input-container-label-top mt-3">
                        <label>Unsuccessful Reason</label>
                        <select class="form-select" name="unsuccessfulReason" id="unsuccessfulReason">
                            <option value="">-- Select a reason --</option>
                            <option value="Payment Issue">Payment Issue</option>
                            <option value="Bad Weather">Bad Weather</option>
                            <option value="Customer Unavailable">Customer Unavailable</option>
                            <option value="Incorrect Address">Incorrect Address</option>
                            <option value="Wrong Contact Information">Wrong Contact Information</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        <span class="btn-text">Yes</span>
                    </button>
                    <button type="reset" class="btn btn-secondary btnCloseModal" id="btnCloseModal" data-dismiss="modal">No</button>
                </div>
            </form>
        </div>
    </div>
</div>



<script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/app.js"></script>
</body>

</html>