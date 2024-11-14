<div class="p-4">
<div class="page-header">
    <div class="page-title">
        <h4>Walkin Reports</h4>
        <h6>Views/Reports</h6>
    </div>
    <div class="row g-2">
        <div class="col-12 col-md-2">
            <input type="text" id="searchpos" class="form-control w-100" placeholder="Search...">
            <input type="text" id="search_monthly_pos" style="display: none;" class="form-control w-100" placeholder="Search...">
            <input type="text" id="search_yearly_pos" style="display: none;" class="form-control w-100" placeholder="Search...">
        </div>
        <div class="col-6 col-md-2">
            <a href="reports.php" class="btn btn-added"><i class="bi bi-globe me-2"></i>Online</a>
        </div>
        <div class="col-6 col-md-2">
            <a class="btn btn-added"><i class="bi bi-cart me-2"></i>POS</a>
        </div>
        <div class="col-6 col-md-2">
            <div class="btn-group w-100">
                <button type="button" class="btn btn-added dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    View As
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" data-target="daily">Daily</a></li>
                    <li><a class="dropdown-item" href="#" data-target="monthly">Monthly</a></li>
                    <li><a class="dropdown-item" href="#" data-target="yearly">Yearly</a></li>
                </ul>
            </div>
        </div>
        <div class="col-6 col-md-3 d-flex flex-row">
            <a class="btn btn-added w-50 me-2" data-bs-toggle="modal" data-bs-target="#createReport"><i class="bi bi-arrow-up-right-square-fill me-2"></i>CSV</a>
            <a class="btn btn-added w-50" data-bs-toggle="modal" data-bs-target="#createReportPDF"><i class="bi bi-arrow-up-right-square-fill me-2"></i>PDF</a>
        </div>
    </div>
</div>

    
    <!-- Daily -->
    <div id="storeTable" style="background-color: white;">
        <div class="mt-3 border rounded p-2">
            <div>
                <div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead style="cursor: pointer;" id="tableHeadpos">
                            <tr style="font-size: 14px;">
                                <th>Sales No.</th>
                                <th>Date</th>
                                <th>Daily Sales</th>
                            </tr>
                        </thead>
                        <tbody id="tableBodypos">
                            
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
            <!-- pagination -->
            <div class="row pt-2 d-flex align-items-center">
                <div class="col-12 col-md-4 mb-2 mb-md-0">
                    <div class="pagination" id="paginationpos"></div>
                </div>
                <div class="col-12 col-md-4 d-flex justify-content-center mb-2 mb-md-0">
                    <div id="infopos" class="text-muted"></div>
                </div>
                <div class="col-12 col-md-4 d-flex justify-content-end">
                    <select style="border: none; color: gray; background-color: transparent" id="itemsPerPagepos" class="form-select form-select-sm w-auto">
                        <option disabled selected>Show Items</option>
                        <option value="15">15 items</option>
                        <option value="20">20 items</option>
                        <option value="100">100 items</option>
                    </select>
                </div>
            </div>

        </div>
    </div>
    <!-- Monthly -->
    <div id="store_monthly" style="background-color: white; display: none">
        <div class="mt-3 border rounded p-2">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead id="tableHead_monthly_pos" style="cursor: pointer; background-color: transparent;">
                        <tr style="font-size: 14px;">
                            <th>Sales No.</th>
                            <th>Month</th>
                            <th>Year</th>
                            <th>Monthly Sales</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody_monthly_pos">
                    </tbody>
                </table>
            </div>
            <!-- pagination -->
            <div class="row pt-2 d-flex align-items-center">
                <div class="col-12 col-md-4 mb-2 mb-md-0">
                    <div class="pagination" id="pagination_monthly_pos"></div>
                </div>
                <div class="col-12 col-md-4 d-flex justify-content-center mb-2 mb-md-0">
                    <div id="info_monthly_pos" class="text-muted"></div>
                </div>
                <div class="col-12 col-md-4 d-flex justify-content-end">
                    <select id="itemsPerPage_monthly_pos" class="form-select form-select-sm w-auto" style="border: none; color: gray; background-color: transparent;">
                        <option disabled selected>Show Items</option>
                        <option value="15">15 items</option>
                        <option value="20">20 items</option>
                        <option value="100">100 items</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Yearly -->
    <div id="store_yearly" style="background-color: white; display: none">
    <div class="mt-3 border rounded p-2">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead id="tableHead_yearly_pos" style="cursor: pointer; background-color: transparent;">
                    <tr style="font-size: 14px;">
                        <th>Sales No.</th>
                        <th>Year</th>
                        <th>Yearly Sales</th>
                    </tr>
                </thead>
                <tbody id="tableBody_yearly_pos">
                </tbody>
            </table>
        </div>
        <!-- pagination -->
        <div class="row pt-2 d-flex align-items-center">
            <div class="col-12 col-md-4 mb-2 mb-md-0">
                <div class="pagination" id="pagination_yearly_pos"></div>
            </div>
            <div class="col-12 col-md-4 d-flex justify-content-center mb-2 mb-md-0">
                <div id="info_yearly_pos" class="text-muted"></div>
            </div>
            <div class="col-12 col-md-4 d-flex justify-content-end">
                <select id="itemsPerPage_yearly_pos" class="form-select form-select-sm w-auto" style="border: none; color: gray; background-color: transparent;">
                    <option disabled selected>Show Items</option>
                    <option value="15">15 items</option>
                    <option value="20">20 items</option>
                    <option value="100">100 items</option>
                </select>
            </div>
        </div>
    </div>
</div>


</div>



<!-- Modal -->
<div class="modal mt-5 fade" id="createReport" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Export CSV Reports</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row g-2">
            <div class="col-12 col-md-6 d-none">
                <label for="select_report" class="form-label">Select Export Type</label>
                <select name="" id="select_report" class="form-select">
                    <option value="excel">Excel</option>
                    <option value="pdf">PDF</option>
                    <option value="analytics">Analytics</option>
                </select>
            </div>
            <div class="col-12 col-md-12">
                <label for="select_type" class="form-label">Select Report Type</label>
                <select name="" id="select_type" class="form-select">
                    <option value="daily">Daily</option>
                    <option value="monthly">Monthly</option>
                    <option value="yearly">Yearly</option>
                </select>
            </div>
        </div>
        <!-- daily -->
        <div id="daily_reports" class="mt-2">
          <div class="mb-3">
            <label for="startDate" class="form-label">Start Date</label>
            <input type="date" class="form-control" id="startDate" required>
          </div>
          <div class="mb-3">
            <label for="endDate" class="form-label">End Date</label>
            <input type="date" class="form-control" id="endDate" required>
          </div>
        </div>
        <!-- monthly -->
        <div id="monthly_reports" class="mt-2" style="display: none">
          <div class="mb-3">
            <label for="startMonthYear" class="form-label">Start Month and Year</label>
            <input type="month" class="form-control" id="startMonthYear" required>
          </div>
          <div class="mb-3">
            <label for="endMonthYear" class="form-label">End Month and Year</label>
            <input type="month" class="form-control" id="endMonthYear" required>
          </div>
        </div>
        <!-- yearly -->
        <div id="yearly_reports" class="mt-2" style="display: none">
          <div class="mb-3">
            <label for="startYear" class="form-label">Start Year</label>
            <input type="number" class="form-control" id="startYear" min="2020" max="2100" required>
          </div>
          <div class="mb-3">
            <label for="endYear" class="form-label">End Year</label>
            <input type="number" class="form-control" id="endYear" min="2020" max="2100" required>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-sm btn-primary" id="proceed_loader" disabled style="display: none">
            <div class="spinner-grow spinner-grow-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </button>
        <button type="button" class="btn btn-sm btn-primary" id="proceed_excel_walkin">Export Excel</button>
        <button type="button" class="btn btn-sm btn-primary" id="proceed_pdf" style="display: none;">Export PDF</button>
        <button type="button" class="btn btn-sm btn-primary" id="proceed_analytics" style="display: none;">Export Analytics</button>
      </div>
    </div>
  </div>
</div>


<div class="modal mt-5 fade" id="createReportPDF" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Export PDF Reports</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row g-2">
            <div class="col-12 col-md-6">
                <label for="" class="form-label">Select Export Type</label>
                <select name="" id="" class="form-select">
                    <option value="orders">Orders</option>
                    <option value="inventory">Inventory</option>
                    <option value="supplier">Supplier</option>
                    <option value="category">Category</option>
                    <option value="accounts">Accounts</option>
                </select>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-sm btn-primary" id="proceed_loader" disabled style="display: none">
            <div class="spinner-grow spinner-grow-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </button>
        <button type="button" class="btn btn-sm btn-primary" id="">Export PDF</button>
      </div>
    </div>
  </div>
</div>