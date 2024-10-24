<div class="modal" tabindex="-1" role="dialog" id="changeOrderStatusModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-arrow-repeat"></i> Change Order Status</h5>
            </div>
            <form id="frmChangeOrderStatus">
                <input type="hidden" name="requestType" value="UpgradeOrderStatus">
                <input type="hidden" name="orderId" id="changeOrderStatusModalOrderId" value="">

              
                <div class="modal-body">
                    <h6>Are you sure that you want to change the Order Status?</h6>
                </div>
                <!--Start new added Input -->
                <div class="form-floating estimatedDeliveryFloating">
                    <input type="date" class="form-control" id="estimatedDelivery" name="estimatedDelivery" placeholder="Estimated Delivery Date">
                    <label for="estimatedDelivery">Estimated Delivery Date</label>
                </div>

                <!-- End new added Input -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Yes</button>
                    <button type="reset" class="btn btn-secondary btnCloseModal" id="btnCloseModal" data-dismiss="modal">No</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="changeOrderStatusModalToDelivered">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-arrow-repeat"></i> Change Order Status to "Delivered"</h5>
            </div>
            <form id="frmChangeOrderStatusToDelivered">
                <input type="hidden" name="deliveredItem" value="True">
                <input type="hidden" name="requestType" value="UpgradeOrderStatus">
                <input type="hidden" name="orderId" id="changeOrderStatusModalOrderIdDelivered" value="">
                <div class="modal-body">
                    <h6>Are you sure that you want to change the Order Status?</h6>
                    <div class="input-container-label-top mt-3">
                        <label>Upload a proof of delivery</label>
                        <input type="file" class="form-control" id="proofOfDel" name="proofOfDel" accept="image/*" required>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Yes</button>
                    <button type="reset" class="btn btn-secondary btnCloseModal" id="btnCloseModal" data-dismiss="modal">No</button>
                </div>
            </form>
        </div>
    </div>
</div>




<div class="modal" tabindex="-1" role="dialog" id="rejectOrderModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-bag-x-fill"></i> Reject Order</h5>
            </div>
            <form id="frmRejectOrder">
                <input type="hidden" name="requestType" value="RejectOrder">
                <input type="hidden" name="orderId" id="rejectOrderId" value="">
                <div class="modal-body">
                    <h6>Select Reason for rejection</h6>
                    
                    <select class="form-control" name="rejectReason" id="rejectReason">
                        <option value="" disabled selected>Select a reason</option>
                        <option value="Out of Stock">Out of Stock</option>
                        <option value="Invalid Pricing">Invalid Payment</option>
                        <option value="Other">Other</option>
                    </select>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Yes</button>
                    <button type="reset" class="btn btn-secondary btnCloseModal" id="btnCloseModal" data-dismiss="modal">No</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" tabindex="-1" role="dialog" id="ReasonModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-bag-x-fill"></i> Unsuccessful Reason
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="frmRejectOrder">
                <div class="modal-body">
                    <h6>Reason for rejection</h6>
                    <p id="reasonTxt"></p>
                    <h6>Date Unsuccessful</h6>
                    <p id="dateUnsucessTxt"></p>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary btnCloseModal" id="btnCloseModal" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>



<script src="../admin_view/assets/plugins/alertify/alertify.min.js"></script>
<script src="../admin_view/assets/plugins/sweetalert/sweetalert2.all.min.js"></script>

<script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="javascript/app.js"></script>
</body>

</html>