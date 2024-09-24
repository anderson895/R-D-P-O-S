<div class="page-title">
<h4>Stock list</h4>
<h6>View/Search stocks</h6>
</div>


<div class="container">
    <div class="row mt-5">
        <div class="col-12 col-lg-12 d-flex flex-row" style="justify-content: space-between;">
            <div class="w-50"><input type="text" class="form-control" id="searchInput" placeholder="Search"></div>
            <div>
                <button class="btn btn-primary" data-toggle="modal" data-target="#stock_in">New Stock</button>
                <button class="btn btn-primary" data-toggle="modal" data-target="#export">Export</button>
            </div>
        </div>
        <div class="col-12 col-lg-12 d-flex flex-row mt-3">
            <table class="table table-hover" id="stockTable">
                <thead>
                    <tr>
                        <th scope="col">Invoice Number</th>
                        <th scope="col">Supplier Name</th>
                        <th scope="col">Date Receive</th>
                        <th scope="col">Total Markup</th>
                        <th scope="col">Total Cost</th>
                        <th class="text-center" scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- The table rows will be dynamically loaded using Ajax -->
                </tbody>
            </table>
        </div>
    </div>
</div>









<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        function fetchStockData(search) {
    $.ajax({
        url: 'stock_in/controller/fetch_stock_data.php',
        method: 'POST',
        data: { search: search },
        dataType: 'json',
        success: function(data) {

          console.log(data)

            $('#stockTable tbody').empty();

            $.each(data, function(index, row) {
                var formatted_date = new Date(row.s_stockin_date).toLocaleDateString('en-US');

                var newRow = '<tr class="stock-row">' +
                    '<td>' + row.s_invoice + '</td>' +
                    '<td>' + row.spl_name + '</td>' +
                    '<td>' + formatted_date + '</td>' +
                    '<td>' + Number(row.totalMarkup).toFixed(2) + '</td>' +
                '<td>' + Number(row.totalCost).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + '</td>'

                    '<td class="text-center">' +
                    '<form method="POST" action="add_stock.php">' +
                    '<input type="hidden" name="invoice_no" value="' + row.s_invoice + '">' +
                    '<input type="hidden" name="supplier_code" value="' + row.spl_code + '">' +
                    '<button class="btn btn-sm border"><i class="fas fa-eye"></i> View</button>' +
                    '</form>' +
                   '</td>'+

                    '</tr>';

                $('#stockTable tbody').append(newRow);
            });
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('AJAX Error:', textStatus, errorThrown);
            // Handle the error here (e.g., display an error message to the user)
        }
    });
}


        function updateStockData() {
            var searchText = $('#searchInput').val();
            fetchStockData(searchText);
        }

        // Fetch data initially
        fetchStockData('');

        // Set an interval to fetch data every 10 seconds (adjust as needed)
        var refreshInterval = 2000; // 10 seconds
        setInterval(updateStockData, refreshInterval);

        // Update data when the user types in the search input
        $('#searchInput').on('keyup', function() {
            updateStockData();
        });
    });
</script>
