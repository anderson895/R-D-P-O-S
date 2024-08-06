<div class="p-4">
<div class="page-header">
    <div class="page-title">
        <h4>Reports</h4>
        <h6>Online Reports</h6>
    </div>
    <div class="row g-2">
        <div class="col-12 col-md-4">
            <input type="text" id="search" class="form-control w-100" placeholder="Search...">
            <input type="text" id="search_monthly" style="display: none;" class="form-control w-100" placeholder="Search...">
            <input type="text" id="search_yearly" style="display: none;" class="form-control w-100" placeholder="Search...">
        </div>
        <div class="col-6 col-md-2">
            <a class="btn btn-added"><i class="bi bi-globe me-2"></i>Online</a>
        </div>
        <div class="col-6 col-md-2">
            <a href="reports-pos.php" class="btn btn-added"><i class="bi bi-cart me-2"></i>POS</a>
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
        <div class="col-6 col-md-2">
            <a href="#" class="btn btn-added "><i class="bi bi-plus-lg me-2"></i>Create</a>
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
                        <thead style="cursor: pointer;" id="tableHead">
                            <tr style="font-size: 14px;">
                                <th>Sales No.</th>
                                <th>Date</th>
                                <th>Daily Sales</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
            <!-- pagination -->
            <div class="row pt-2 d-flex align-items-center">
                <div class="col-12 col-md-4 mb-2 mb-md-0">
                    <div class="pagination" id="pagination"></div>
                </div>
                <div class="col-12 col-md-4 d-flex justify-content-center mb-2 mb-md-0">
                    <div id="info" class="text-muted"></div>
                </div>
                <div class="col-12 col-md-4 d-flex justify-content-end">
                    <select style="border: none; color: gray; background-color: transparent" id="itemsPerPage" class="form-select form-select-sm w-auto">
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
                    <thead id="tableHead_monthly" style="cursor: pointer; background-color: transparent;">
                        <tr style="font-size: 14px;">
                            <th>Sales No.</th>
                            <th>Month</th>
                            <th>Year</th>
                            <th>Monthly Sales</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody_monthly">
                    </tbody>
                </table>
            </div>
            <!-- pagination -->
            <div class="row pt-2 d-flex align-items-center">
                <div class="col-12 col-md-4 mb-2 mb-md-0">
                    <div class="pagination" id="pagination_monthly"></div>
                </div>
                <div class="col-12 col-md-4 d-flex justify-content-center mb-2 mb-md-0">
                    <div id="info_monthly" class="text-muted"></div>
                </div>
                <div class="col-12 col-md-4 d-flex justify-content-end">
                    <select id="itemsPerPage_monthly" class="form-select form-select-sm w-auto" style="border: none; color: gray; background-color: transparent;">
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
                    <thead id="tableHead_yearly" style="cursor: pointer; background-color: transparent;">
                        <tr style="font-size: 14px;">
                            <th>Sales No.</th>
                            <th>Year</th>
                            <th>Yearly Sales</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody_yearly_online"></tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="row pt-2 d-flex align-items-center">
                <div class="col-12 col-md-4 mb-2 mb-md-0">
                    <div class="pagination" id="pagination_yearly_online"></div>
                </div>
                <div class="col-12 col-md-4 d-flex justify-content-center mb-2 mb-md-0">
                    <div id="info_yearly_online" class="text-muted"></div>
                </div>
                <div class="col-12 col-md-4 d-flex justify-content-end">
                    <select id="itemsPerPage_yearly_online" class="form-select form-select-sm w-auto" style="border: none; color: gray; background-color: transparent;">
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