



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





<!---Start Modal for edit---->
<div class="modal fade" id="addDeliveryAddress" tabindex="-1" aria-labelledby="editShipping" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header" style="background-color: rgb(96, 0, 0);">
        <input hidden type="text" value="<?=$db_acc_id?>" id='acc_id'>
        <h5 class="modal-title" style="color:#fafbfe;">Add new address</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <h4 class="text-center" id="AddressName"></h4>
        </div>
      
  <!--      <div class="row">
          <div class="form-group">
            <label>Region</label>
            <select class="select" id="region" name="address_name" required ></select>
          </div>
          <div class="form-group">
            <label>Province</label>
            <select class="select" id="province" name="province" required></select>
        
          </div>
          <div class="form-group">
            <label>City</label>
            <select class="select" id="city" name="city" required></select>
           
          </div>
          <div class="form-group">
            <label>Barangay</label>
            <select class="select" id="barangay" name="barangay" required></select>
          </div>
        </div>--->

        <div class="form-group m-0 bg-light rounded">
                        <textarea style="display:none;" disabled id="complete_address_add" cols="30" rows="10"></textarea>
                        <div class="search-container">
                            <input required type="text" class="form-control" id="searchBarangay_add" placeholder="Search brgy.." name="searchBarangay_add">
                        </div>
                        <div id="barangaySuggestions_add" class="suggestions-row ml-4"></div>
                        <input hidden type="text" id="region_add">
                        <input hidden type="text" id="province_add">
                        <input hidden type="text" id="city_add">
                        <input hidden type="text" id="brgy_add" value="">
                     
        </div>

        

        <div class="row">
          <div class="form-group">
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="Addshipping" placeholder=" " required>
                <label for="Addshipping">Enter shipping price</label>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="form-group">
              <label for="">Active Status</label>
              <input type="checkbox" id="activeStatus" class="check" checked="">
              <label for="activeStatus" class="checktoggle"></label>
          </div>
        </div>
        <!--<div class="row">-->
        <!--  <div class="form-group">-->
        <!--      <label for="">Allowed Cash on delivery</label>-->
        <!--      <input type="checkbox" id="deliveryAllowed" class="check" checked="">-->
        <!--      <label for="deliveryAllowed" class="checktoggle"></label>-->
             
        <!--  </div>-->
        <!--</div>-->
        <!--<div class="row">-->
        <!--  <div class="form-group">-->
        <!--      <label for="">Allowed Payment first</label>-->
        <!--      <input type="checkbox" id="paymentfirstAllowed" class="check" checked="">-->
        <!--      <label for="paymentfirstAllowed" class="checktoggle">-->
           
        <!--  </div>-->
        <!--</div>-->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-submit savePlaceTogler">Save</button>
        <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!---End Modal for edit---->



