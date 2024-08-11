<div class="offcanvas offcanvas-start" tabindex="-1" id="cart" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header">
    <h2 class="offcanvas-title fw-bolder" id="offcanvasExampleLabel">Cart</h2>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div class="row" style="margin-bottom: 200px">
        <?php 
        for ($i = 0; $i < 5; $i++) {
            echo '<div class="col-3 mb-3">
            <div class="border rounded" style="width: 100%; height: 80px;">
                <img style="width: 100%; height: 100%; object-fit: cover" src="../upload_prodImg/65d6f3eaeb499.png" alt="">
            </div>
        </div>
        <div class="col-9 mb-2">
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="d-flex" style="overflow-wrap: break-word; word-break: break-word;">
                        <p class="m-0 p-0 text-muted">Enertone 5000</p>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <p class="m-0 p-0 text-muted">₱100.00</p>
                </div>
                <div class="col-12 pt-2">
                    <div class="d-flex justify-content-between align-items-center flex-row">
                        <div class="input-group border rounded input-group-sm" style="width: 50%">
                            <button class="btn" type="button" id="button-addon1">+</button>
                            <input type="text" style="border: none" class="form-control text-center" value="0">
                            <button class="btn" type="button" id="button-addon1">-</button>
                        </div>
                        <button class="btn">
                            <i class="text-danger bi bi-trash"></i>
                        </button>
                    </div>
                </div>

            </div>
        </div>';
        }
        ?>
    </div>

  </div>
  <div class="border-top p-2" style="position: absolute; bottom: 0; z-index: 100; height: 200px; width: 100%; background-color: white">
        <div class="row mt-3">
            <div class="col-6">
                <h4 class="m-0 p-0">Total</h4>
            </div>
            <div class="col-6">
                <h4 class="text-end fw-bolder text-muted">₱100,000.00</h4>
            </div>
            <div class="col-12">
            <p class="m-0 p-0 text-muted" style="font-size: 12px">Tax and shipping are included at checkout.</p>
            </div>
        </div>
        <button class="btn mt-3 btn-danger mb-2 w-100">Check out</button>
        <button class="btn border-danger text-danger w-100">View All</button>
  </div>
</div>