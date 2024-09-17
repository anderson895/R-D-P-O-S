<div class=" mt-3">
    <div class="row g-2 mb-2">
        <div class="col-6 col-sm-6 col-md-2">
          <a type="button" class="btn btn-secondary btn-sm border w-100">
            <i class="bi bi-clipboard-plus me-2"></i>POS Transaction
          </a>
        </div>
        <div class="col-6 col-sm-6 col-md-2">
          <a href="../pages/transaction_online" type="button" class="btn btn-sm border w-100">
            <i class="bi bi-clipboard-plus me-2"></i>Online Transaction
          </a>
        </div>
        <div class="col-6 col-sm-6 col-md-2">
          <select class="form-select form-select-sm w-100" id="viewSelectPOS">
              <option disabled selected>View As</option>
              <option value="1" >Transaction</option>
              <option value="0">Return</option>
          </select>
        </div>
        <div class="col-6 col-sm-6 col-md-3">
            <select id="itemsPerPage" class="form-select form-select-sm w-100">
                <option disabled selected>Show Entries</option>
                <option value="15">15 items</option>
                <option value="20">20 items</option>
                <option value="100">100 items</option>
            </select>
            <select id="itemsPerPageReturn" style="display: none" class="form-select form-select-sm w-100">
                <option disabled selected>Show Entries</option>
                <option value="15">15 items</option>
                <option value="20">20 items</option>
                <option value="100">100 items</option>
            </select>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
          <input type="text" id="search" class="form-control form-control-sm w-100" placeholder="Search...">
          <input type="text" id="searchReturn" style="display: none" class="form-control form-control-sm w-100" placeholder="Search...">
        </div>
      </div>
    <div>
        <div id="posT">
          <div class="table-responsive">
              <table class="table table-hover">
                <thead style="cursor: pointer;" id="tableHead">
                    <tr style="font-size: 14px;">
                        <th>Transaction Code</th>
                        <th>Purchase Date</th>
                        <th>Tax</th>
                        <th>Discount</th>
                        <th>Total</th>
                        <th>Payment</th>
                        <th>Change</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    
                </tbody>
            </table>
          </div>
        </div>


        <div id="posR" style="display: none">
          <div class="table-responsive">
                <table class="table table-hover">
                  <thead style="cursor: pointer;" id="tableHeadReturn">
                      <tr style="font-size: 14px;">
                          <th>Transaction Code</th>
                          <th>Return Date</th>
                          <th>Return Reason</th>
                          <th>Return Type</th>
                      </tr>
                  </thead>
                  <tbody id="tableBodyReturn">
                      
                  </tbody>
              </table>
            </div>
        </div>
    </div>
    <div class="row d-flex align-items-center">
      <div class="col-12 col-md-6">
        <div class="pagination" id="pagination"></div>
      </div>
      <div class="col-12 col-md-6 d-flex">
        <div id="info" class="text-muted"></div>
      </div>
      <div class="col-12 col-md-6">
        <div class="pagination" style="display: none;" id="paginationReturn"></div>
      </div>
      <div class="col-12 col-md-6 d-flex">
        <div id="infoReturn" style="display: none;" class="text-muted"></div>
      </div>
    </div>
</div>