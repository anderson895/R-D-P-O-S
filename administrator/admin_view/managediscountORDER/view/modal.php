
<div class="modal fade" id="addpayment" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Add new discount </h5>
<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>

<div class="modal-body">
<p class="text-muted">Please follow these instructions:</p>
  <ol class="text-muted">
    <li>Discount Name should have minimum of 1 characters and maximum of 10</li>
    <li>Description should have minimum of 5 characters and maximum of 300</li>
    <li>Discount rate should have minimum of 0 characters and maximum of 100</li>
  </ol>
  <div id="validation-messages" class="text-danger"></div> <!-- Display validation messages here -->
  

  <hr>
<div class="row">

<div class="col-12">
<div class="form-group">
<label>Discount name<span class="manitory">*</span></label>
<input type="text" id="discount_name">
</div>
</div>


<div class="col-12">
  <div class="form-group">
    <label>Description<span class="manitory">*</span></label>
    <textarea id="discount_description" rows="5" cols="50"></textarea>
  </div>
</div>

<div class="col-12">
  <div class="form-group">
    <label>MaximumLimit<span class="manitory">*</span></label>
    <input type="number" class="form-control" id="maxlimit">
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-12">
      <div class="form-group">
        <label for="discount_rate">Discount rate<span class="manitory">*</span></label>
        <div class="input-group">
          <input type="number" class="form-control" id="discount_rate">
          <div class="input-group-append">
            <span class="input-group-text percent-sign">%</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="col-12">
  <div class="form-group">
    <label>Expiration<span class="manitory">*</span></label>
    <input type="date" class="form-control" name="expirationDate" id="expirationDate">
  </div>
</div>






<div class="col-12">
<div class="form-group mb-0">
<label>Status</label>
<select class="select" id="voucherStatus">
<option value="1"> Active</option>
<option value="0"> InActive</option>
</select>
</div>
</div>
</div>
</div>
<div class="modal-footer">
<div id="loadingSpinner"></div>
<button  type="button"  class="btn btn-submit toglerAddDiscount">Confirm</button>
<button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
</div>
</div>
</div>
</div>














<div class="modal fade" id="editDiscount" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Edit Unit </h5>
<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<input hidden type="text" id="discount_id_update">
<div class="modal-body">
<p class="text-muted">Please follow these instructions:</p>
  <ol class="text-muted">
    <li>Discount Name should have minimum of 1 characters and maximum of 10</li>
    <li>Description should have minimum of 5 characters and maximum of 300</li>
    <li>Discount rate should have minimum of 0 characters and maximum of 100</li>
  </ol>
  <div id="validation-messages_for_updateModal" class="text-danger"></div> <!-- Display validation messages here -->
  

<div class="row">

<div class="col-12">
<div class="form-group">
<label>Discount Name<span class="manitory">*</span></label>
<input type="text" id="discount_name_update">
</div>
</div>


<div class="col-12">
  <div class="form-group">
    <label>Description<span class="manitory">*</span></label>
    <textarea id="discount_description_update" rows="5" cols="50"></textarea>
  </div>
</div>

<div class="col-12">
  <div class="form-group">
    <label>MaximumLimit<span class="manitory">*</span></label>
    <input type="number" class="form-control" id="discount_maxlimit_update">
  </div>
</div>

<div class="col-12">
  <div class="form-group">
    <label>Discount Rate<span class="manitory">*</span></label>
    <input type="number" class="form-control" id="discount_rate_update">
  </div>
</div>

<div class="col-12">
  <div class="form-group">
    <label>Expiration<span class="manitory">*</span></label>
    <input type="date" class="form-control" name="expirationDate_update" id="expirationDate_update">
  </div>
</div>


<div class="col-12">
  <div class="form-group mb-0">
    <label>Status</label>
    <select class="form-control" id="discount_status_update_select">
      <option value="1">Active</option>
      <option value="0">Inactive</option>
    </select>
  </div>
</div>

</div>
</div>



<div disabled class="modal-footer">

<button type="button"  class="btn btn-submit toglerEditDiscountProcess">Update</button>
<button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
</div>
</div>
</div>
</div>


