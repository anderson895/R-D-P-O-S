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
                        <input type="file" class="form-control" id="proofOfDel" name="proofOfDel" important>
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