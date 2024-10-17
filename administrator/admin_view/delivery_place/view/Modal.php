



<!---Start Modal for edit---->
<div class="modal fade" id="editShipping" tabindex="-1" aria-labelledby="editShipping" aria-hidden="true">
<div class="modal-dialog modal-md">
<div class="modal-content">
<div class="modal-header" style="background-color: rgb(96, 0, 0);">
<input hidden type="text" value="<?=$db_acc_id?>" id='acc_id'>
<h5 class="modal-title" style="color:#fafbfe;">Update Shipping</h5>
<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
<div class="modal-body">
    
<div class="row">
<h4 class="text-center" id="AddressName"></h4>
<div class="form-group">
  <hr>
<h6>Shipping</h6>
<div class="input-group">
<input type="text" value="" id='shipping'>
<input hidden type="text" id='address_id'>

</div>
</div>

</div>
</div>
<div class="modal-footer">
<button type="button" id="savePlace" class="btn btn-submit">Save</button>
<button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
<!---End Modal for edit---->




<!---Start Modal for DeliveryAddress---->
<div class="modal fade" id="addDeliveryAddress" tabindex="-1" aria-labelledby="editShipping" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header" style="background-color: rgb(96, 0, 0);">
        <input hidden type="text" value="<?=$db_acc_id?>" id='acc_id'>
        <h5 class="modal-title text-white">Add New Address</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="text-center mb-3">
          <h4 id="AddressName"></h4>
        </div>

        <div class="form-group">
          <textarea hidden disabled id="complete_address_add" cols="30" rows="10"></textarea>

          <div class="form-floating mb-3">
            <input required type="text" class="form-control" id="searchBarangay_add" placeholder=" " name="searchBarangay_add">
            <label for="searchBarangay_add">Search Barangay</label>
          </div>

          <div id="barangaySuggestions_add" class="suggestions-row"></div>
          <input hidden type="text" id="region_add">
          <input hidden type="text" id="province_add">
          <input hidden type="text" id="city_add">
          <input hidden type="text" id="brgy_add" value="">
        </div>

        <div class="form-group">
          <div class="form-floating mb-3">
            <input type="number" class="form-control" id="Addshipping" placeholder=" " required>
            <label for="Addshipping">Enter Shipping Price</label>
          </div>
        </div>

        <div class="form-group form-check mb-3">
          <input type="checkbox" id="activeStatus" class="form-check-input" checked>
          <label for="activeStatus" class="form-check-label">Active Status</label>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary savePlaceTogler">Save</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!---End Modal for DeliveryAddress---->




