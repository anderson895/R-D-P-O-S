

<div class="modal fade" id="requestModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content">
      <div class="modal-header" style="background-color: rgb(96, 0, 0); color: #fafbfe;">
        <h5 class="modal-title">Request stocks</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       
      <div class="form-group" id="checkedValuesInputs" style="max-height: 200px; overflow-y: auto;">
  <label for="prod_nameText">Products:</label>
  <!-- Row for input fields with quantity and plus/minus buttons -->
  <div class="row" id="inputRow">
    <!-- Your content goes here -->
  </div>
</div>


        <div class="form-group">
          <label for="supplierDropdown">Select supplier:</label>
          <select class="form-control" id="supplierDropdown">
            <?php 
            $view_query = mysqli_query($connections, "SELECT * from supplier where spl_status='0' "); 
            while($row = mysqli_fetch_assoc($view_query)){ 
              $spl_code = $row["spl_code"];
              $spl_name = $row["spl_name"];
              $spl_email = $row["spl_email"];
              echo '<option value="'.$spl_email.'">'.$spl_name.'</option>';
            }
            ?>
          </select>
        </div>
        



        <div class="form-group">
          <label for="supplierMessage">Messages :</label>
          <textarea class="form-control" id="supplierMessage" cols="30" rows="10"></textarea>
        </div> 


        <div class="form-group">
          <label for="supplierMessage">Preferred Delivery Date :</label>
          <input type="date" id="preparedDeliveryDate" class="form-control">
        </div> 


      </div>
      <div class="modal-footer justify-content-center">
        <div id="loadingSpinner"></div>
        <button disabled type="button" class="btn btn-submit me-2" id="sendRequestTogler">Send request</button>
        <button style='display:block;' type="button" class="btn btn-secondary" id="btnCancelModal" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
