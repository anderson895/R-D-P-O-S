<!-- Confirmation Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmModalLabel">Confirmation</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to remove all items?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="confirmRemoveAll">Confirm</button>
                                        </div>
                                    </div>
                                </div>
</div>



<!---Start Single Remove---->
<div class="modal fade" id="modalRemoveConfirm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Remove from the cart</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
    

        <form action="singleRemove.php" method="POST">
          <input type="hidden" id="db_prod_id" name="remove_id">
          <center>Remove <b><span id='db_prod_nameDisplay'></span></b> From the cart?</center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="confirmremove" class="btn btn-danger">Confirm</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!---End Single Remove---->



<!--start PickUp or Deliver Modal -->
<div class="modal fade" id="PickUpOrDelivery" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Payment Options</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST">
          <div class="mb-3">
            <!-- Row for horizontal arrangement -->
            <div class="row">
              <div class="col">
                <button type="button" class="form-control btn btn-primary" style="width:100%;" data-bs-toggle="modal" data-bs-target="#addEwallet">E-wallet</button>
              </div>
              <div class="col">
                <button type="button" class="form-control btn btn-primary" style="width:100%;" data-bs-toggle="modal" data-bs-target="#addBank">Bank Transfer</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End  PickUp or Deliver Modal -->