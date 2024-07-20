
<div class="modal fade" id="addpayment" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Add Unit </h5>
<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>

<div class="modal-body">
<p class="text-muted">Please follow these instructions:</p>
  <ol class="text-muted">
    <li>Unit Name should have a minimum of 1 characters.</li>
    <li>Description should have a minimum of 5 characters.</li>
  </ol>
  <div id="validation-messages" class="text-danger"></div> <!-- Display validation messages here -->
  

  
<div class="row">

<div class="col-12">
<div class="form-group">
<label>Unit Name<span class="manitory">*</span></label>
<input type="text" id="unit_name">
</div>
</div>


<div class="col-12">
  <div class="form-group">
    <label>Description<span class="manitory">*</span></label>
    <textarea id="unit_description" rows="5" cols="50"></textarea>
  </div>
</div>



<div class="col-12">
<div class="form-group mb-0">
<label>Status</label>
<select class="select" id="unitStatus">
<option value="1"> Active</option>
<option value="0"> InActive</option>
</select>
</div>
</div>
</div>
</div>
<div class="modal-footer">
<button disabled type="button"  class="btn btn-submit toglerAddUnit">Confirm</button>
<button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
</div>
</div>
</div>
</div>














<div class="modal fade" id="editUnit" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Edit Unit </h5>
<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<input hidden type="text" id="unit_id">
<div class="modal-body">
<p class="text-muted">Please follow these instructions:</p>
  <ol class="text-muted">
    <li>Unit Name should have a minimum of 1 characters.</li>
    <li>Description should have a minimum of 5 characters.</li>
  </ol>
  <div id="validation-messages_for_updateModal" class="text-danger"></div> <!-- Display validation messages here -->
  

<div class="row">

<div class="col-12">
<div class="form-group">
<label>Unit Name<span class="manitory">*</span></label>
<input type="text" id="unit_name_update">
</div>
</div>


<div class="col-12">
  <div class="form-group">
    <label>Description<span class="manitory">*</span></label>
    <textarea id="unit_description_update" rows="5" cols="50"></textarea>
  </div>
</div>


<div class="col-12">
  <div class="form-group mb-0">
    <label>Status</label>
    <select class="form-control" id="unit_status_update_select">
      <option value="1">Active</option>
      <option value="0">Inactive</option>
    </select>
  </div>
</div>

</div>
</div>



<div disabled class="modal-footer">
<button type="button"  class="btn btn-submit toglerEditUnitProcess">Update</button>
<button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
</div>
</div>
</div>
</div>


