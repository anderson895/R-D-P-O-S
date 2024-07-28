<div class=" mt-3">
    <div class="row g-2 mb-2">
        <div class="col-6 col-sm-6 col-md-2">
          <a href="../pages/transaction_pos"  type="button" class="btn btn-sm border w-100">
            <i class="bi bi-clipboard-plus me-2"></i>POS Transaction
          </a>
        </div>
        <div class="col-6 col-sm-6 col-md-2">
          <a type="button" class="btn btn-secondary btn-sm border w-100">
            <i class="bi bi-clipboard-plus me-2"></i>Online Transaction
          </a>
        </div>
        <div class="col-6 col-sm-6 col-md-2">
          <select class="form-select form-select-sm w-100">
          <option disabled selected>View As</option>
            <option value="10">Transaction</option>
            <option value="20">Return</option>
          </select>
        </div>
        <div class="col-6 col-sm-6 col-md-3">
            <select id="itemsPerPage" class="form-select form-select-sm w-100">
                <option disabled selected>Show Entries</option>
                <option value="15">15 items</option>
                <option value="20">20 items</option>
                <option value="100">100 items</option>
            </select>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
          <input type="text" id="search" class="form-control form-control-sm w-100" placeholder="Search...">
        </div>
      </div>
    <div>
        <div class="table-responsive">
            <table class="table table-hover">
              <thead id="tableHead">
                  <tr style="font-size: 14px;">
                      <th>Transaction Code</th>
                      <th>Ordered Date</th>
                      <th>Delivery Date</th>
                      <th>Status</th>
                      <th>Subtotal</th>
                      <th>VAT</th>
                      <th>Shipping Fee</th>
                      <th>Total</th>
                  </tr>
              </thead>
              <tbody id="tableBody">
                  
              </tbody>
          </table>
        </div>
    </div>
    <div class="row d-flex align-items-center">
      <div class="col-12 col-md-6">
        <div class="pagination" id="pagination"></div>
      </div>
      <div class="col-12 col-md-6 d-flex">
        <div id="info" class="text-muted"></div>
      </div>
    </div>
</div>