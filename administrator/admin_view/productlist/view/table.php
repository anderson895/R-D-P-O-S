<div class="table-responsive">
    <input hidden type="text" value="<?=$acc_id?>" id="acc_id">

    <table class="table">
        <thead>
            <tr>
                <th>Status</th>
                <th>Product Name</th>
                <th>Product Code</th>
                <th>Category</th>
                <th>Current price</th>
                <th>ml</th>
                <th>g</th>
                <th>mg</th>
                <th>Unit Type</th>
                <th>Stocks</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    <!-- Add this div for pagination -->
    <div id="paginationContainer" class="text-center mt-4">
        <button id="prevBtn" class="btn btn-primary">Previous</button>
        <button id="nextBtn" class="btn btn-primary">Next</button>
    </div>
    
    <div class="text-secondary"><?php 
    $sql_active_inactive = "SELECT COUNT(*) as total_active_inactive FROM product WHERE prod_status = '0' OR prod_status = '1'";
$result_active_inactive = mysqli_query($connections, $sql_active_inactive);

if ($result_active_inactive) {
    $row_active_inactive = mysqli_fetch_assoc($result_active_inactive);
    $total_active_inactive = $row_active_inactive['total_active_inactive'];
    echo "Total Products: " . $total_active_inactive . "<br>";
} else {
    echo "Error: " . mysqli_error($connections);
}
    ?></div>
    
    
    <div class="text-secondary">
    <?php
    $sql_active = "SELECT COUNT(*) as total_active FROM product WHERE prod_status = '0'";
    $result_active = mysqli_query($connections, $sql_active);
    
    if ($result_active) {
        $row_active = mysqli_fetch_assoc($result_active);
        $total_active = $row_active['total_active'];
        echo "Total Active Products: " . $total_active . "<br>";
    } else {
        echo "Error: " . mysqli_error($connections);
    }
    ?>    
    </div>
</div>

<script>
    $(document).ready(function () {
        var currentPage = 1;
        var itemsPerPage = 5;

        // Function to update the table
        function updateTable() {
            $.ajax({
                url: 'productlist/controller/fetch_data.php',
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    // Clear existing table rows
                    $('tbody').empty();

                    // Get the search input value
                    var searchValue = $('#searchInput').val().toLowerCase();

                    // Filter data based on search input
                    var filteredData = data.filter(function (item) {
                        return (
                            item.prod_name.toLowerCase().includes(searchValue) ||
                            item.prod_code.toLowerCase().includes(searchValue) ||
                            item.category_name.toLowerCase().includes(searchValue)
                           
                        );
                    });

                    // Calculate pagination boundaries
                    var startIndex = (currentPage - 1) * itemsPerPage;
                    var endIndex = startIndex + itemsPerPage;
                    var currentDataPage = filteredData.slice(startIndex, endIndex);

                    // Append new data to the table
                    $.each(currentDataPage, function (index, item) {

                        item.prod_currprice = parseFloat(item.prod_currprice);
                        
                        

                        console.log(item)
                        // Append the new row
                        $('tbody').append(`
                            <tr>
                            <td>
                                <div class="status-toggle d-flex justify-content-between align-items-center">
                                    <input ${item.prod_status === "0" ? "checked" : ""} type="checkbox" id="user${index + 1}" class="check" value='${item.prod_id}' />
                                    <label for="user${index + 1}" class="checktoggle">checkbox</label>
                                </div>
                            </td>
                            <td class="productimgname">
                                <a href="product-details.php?target_id=${item.prod_code}" class="product-img">
                                    <img src="../../upload_prodImg/${item.prod_image}" alt="product" />
                                </a>
                                <a href="product-details.php?target_id=${item.prod_code}">${item.prod_name}</a>
                            </td>
                            <td>${item.prod_code}</td>
                            <td>${item.category_name}</td>
                           <td>${Number(item.prod_currprice).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>

                            <td>${item.prod_ml}</td>
                            <td>${item.prod_g}</td>
                            <td>${item.prod_mg}</td>
                            <td>${item.unit_type}</td>
                            <td>${item.prod_stocks}</td>
                            <td>
                                <a class="me-3 togler_view" href="product-details.php?target_id=${item.prod_code}">
                                    <img src="assets/img/icons/eye.svg" alt="img" />
                                </a>
                                <a class="me-3" href="editproduct.php?editTarget=${item.prod_code}">
                                    <img src="assets/img/icons/edit.svg" alt="img" />
                                </a>
                                <a class="deleteConfirmation" data-prod_id="${item.prod_id}" data-prod_code="${item.prod_code}" data-acc_id="${item.acc_id}">
                                    <img src="assets/img/icons/delete.svg" alt="img" />
                                </a>
                            </td>
                            </tr>
                        `);
                    });

                    updatePaginationButtons(filteredData.length);
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching data: ' + status);
                }
            });
        }

        // Function to update pagination buttons
        function updatePaginationButtons(totalItems) {
            var totalPages = Math.ceil(totalItems / itemsPerPage);

            // Enable or disable Next and Previous buttons based on the current page
            $('#prevBtn').prop('disabled', currentPage === 1);
            $('#nextBtn').prop('disabled', currentPage === totalPages);

            // Update click events for Next and Previous buttons
            $('#prevBtn').off('click').on('click', function () {
                if (currentPage > 1) {
                    currentPage--;
                    updateTable();
                }
            });

            $('#nextBtn').off('click').on('click', function () {
                if (currentPage < totalPages) {
                    currentPage++;
                    updateTable();
                }
            });
        }

        // Call the updateTable function initially
        updateTable();

        // Set an interval to update the table every 30 seconds (adjust as needed)
        setInterval(updateTable, 2000);
    });
</script>

<script src="productlist/javascript/toglerDeleteConfirmation.js"></script>