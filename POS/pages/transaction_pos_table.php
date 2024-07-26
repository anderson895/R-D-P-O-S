<div class=" mt-3">
    <div class="row g-2 mb-2">
        <div class="col-6 col-sm-6 col-md-2">
          <button type="button" class="btn btn-sm border w-100">
            <i class="bi bi-clipboard-plus me-2"></i>POS Transaction
          </button>
        </div>
        <div class="col-6 col-sm-6 col-md-2">
          <button type="button" class="btn btn-sm border w-100">
            <i class="bi bi-clipboard-plus me-2"></i>Online Transaction
          </button>
        </div>
        <div class="col-6 col-sm-6 col-md-2">
          <select id="itemsPerPage" class="form-select form-select-sm w-100">
          <option disabled selected>View As</option>
            <option value="10">Transaction</option>
            <option value="20">Return</option>
          </select>
        </div>
        <div class="col-6 col-sm-6 col-md-3">
            <select id="itemsPerPage" class="form-select form-select-sm w-100">
                <option disabled selected>Show Entries</option>
                <option value="10">10 items</option>
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
                      <th class="store-image" >Transaction Code</th>
                      <th class="store-name" >Purchase Date</th>
                      <th class="store-owner" >Discount</th>
                      <th class="store-address" >Discount Type</th>
                      <th class="store-email" >Tax</th>
                      <th class="store-action" >Total</th>
                      <th class="store-action" >Payment</th>
                      <th class="store-action" >Change</th>
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