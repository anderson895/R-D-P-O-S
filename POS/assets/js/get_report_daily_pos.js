function fetStoreTable() {
    $.ajax({
        url: '../../POS/functions/get_report_daily_pos.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            let data = Array.isArray(response) ? response : [];
            let currentPage = 1;
            let rowsPerPage = 15;
            let currentSortColumn = null;
            let currentSortDirection = 'asc';

            // Sort data by the latest date first
            data.sort((a, b) => new Date(b.orders_date) - new Date(a.orders_date));

            $('#searchpos').on('input', function() {
                currentPage = 1;
                renderTable();
                setupPagination();
            });

            $('#itemsPerPagepos').on('change', function() {
                rowsPerPage = parseInt(this.value, 10);
                currentPage = 1;
                renderTable();
                setupPagination();
            });

            function renderTable() {
                const tableBody = $('#tableBodypos');
                const searchText = $('#searchpos').val().toLowerCase();
                const filteredData = data.filter(item =>
                    item.order_date.toLowerCase().includes(searchText) ||
                    item.daily_total.toLowerCase().includes(searchText)
                );

                if (filteredData.length === 0) {
                    tableBody.html('<tr><td colspan="9" style="text-align: center;">No items found.</td></tr>');
                } else {
                    const paginatedData = filteredData.slice((currentPage - 1) * rowsPerPage, currentPage * rowsPerPage);

                    tableBody.empty();
                    
                    let counter = 1;

                    paginatedData.forEach(item => {
                        const transactionCode = `SLS${String(counter).padStart(4, '0')}`;
                        const row = `<tr id="selectDate" data-order_date="${item.order_date}" data-sid="${transactionCode}" data-daily_sales="${item.daily_total}" style="cursor: pointer; font-size: 14px">
                                        <td class="orders-tcode">${transactionCode}</td>
                                        <td class="orders-date">${item.order_date}</td>
                                        <td class="orders-discount">${item.daily_total}</td>
                                    </tr>`;

                        tableBody.append(row);
                        counter++;
                    });
                }

                const totalItems = filteredData.length;
                $('#infopos').text(`Showing ${Math.min(rowsPerPage, totalItems)} of ${totalItems} items.`);
            }

            function setupPagination() {
                const pagination = $('#paginationpos');
                const searchText = $('#searchpos').val().toLowerCase();
                const filteredData = data.filter(item =>
                    item.order_date.toLowerCase().includes(searchText) ||
                    item.daily_total.toLowerCase().includes(searchText)
                );

                const pageCount = Math.ceil(filteredData.length / rowsPerPage);
                pagination.empty();

                const prevButton = $('<button>Previous</button>')
                    .addClass('pagination-button btn')
                    .prop('disabled', currentPage === 1)
                    .on('click', function() {
                        if (currentPage > 1) {
                            currentPage--;
                            renderTable();
                            setupPagination();
                        }
                    });
                pagination.append(prevButton);

                let startPage = Math.max(1, currentPage - 2);
                let endPage = Math.min(pageCount, startPage + 4);

                if (endPage - startPage < 4) {
                    startPage = Math.max(1, endPage - 4);
                }

                for (let i = startPage; i <= endPage; i++) {
                    const button = $('<button></button>')
                        .text(i)
                        .addClass('pagination-button btn')
                        .toggleClass('active border-danger btn-danger', i === currentPage)
                        .on('click', function() {
                            currentPage = i;
                            renderTable();
                            setupPagination();
                        });
                    pagination.append(button);
                }

                const nextButton = $('<button>Next</button>')
                    .addClass('pagination-button btn')
                    .prop('disabled', currentPage === pageCount)
                    .on('click', function() {
                        if (currentPage < pageCount) {
                            currentPage++;
                            renderTable();
                            setupPagination();
                        }
                    });
                pagination.append(nextButton);
            }

            function sortTable(columnIndex) {
                const tableBody = $('#tableBodypos');
                const rows = Array.from(tableBody.find('tr'));
                const sortDirection = currentSortColumn === columnIndex && currentSortDirection === 'asc' ? 'desc' : 'asc';
                currentSortColumn = columnIndex;
                currentSortDirection = sortDirection;

                rows.sort((a, b) => {
                    const aText = $(a).find('td').eq(columnIndex).text();
                    const bText = $(b).find('td').eq(columnIndex).text();
                    return (aText > bText ? 1 : -1) * (sortDirection === 'asc' ? 1 : -1);
                });

                tableBody.empty();
                rows.forEach(row => tableBody.append(row));

                updateSortingIcons(columnIndex, sortDirection);
            }

            function updateSortingIcons(columnIndex, sortDirection) {
                $('#tableHeadpos th').each(function(index) {
                    const header = $(this);
                    header.removeClass('asc desc');
                    header.find('.sort-icon').remove();

                    if (index === columnIndex) {
                        header.addClass(sortDirection);
                        const icon = $('<i>').addClass(`sort-icon fas fa-sort-${sortDirection === 'asc' ? 'up' : 'down'}`);
                        header.append(icon);
                    }
                });
            }

            $('#tableHeadpos th').on('click', function() {
                const columnIndex = $(this).index();
                sortTable(columnIndex);
            });

            renderTable();
            setupPagination();
        },
        error: function(xhr, status, error) {
            $('#result').html('<p>Error: ' + error + '</p>');
        }
    });
}

// Initialize the table on page load
fetStoreTable();


$(document).ready(function() {
    const $tableBody = $('#DailySalesPOS');
    let currentPage = 1;
    let itemsPerPage = 15;
    let salesData = [];

    // Handle the click event on rows of the main table
    $('#tableBodypos').on('click', 'tr', function() {
        const sid = $(this).data('sid');
        const date = $(this).data('order_date');
        const dailySales = $(this).data('daily_sales');

        $.ajax({
            url: '../../POS/functions/get_date_sale.php',
            type: 'POST',
            data: { 
                order_date: date,
                sid: sid,
                daily_sales: dailySales
            },
            dataType: 'json',
            success: function(response) {
                $('#storeTable, #header_reports').hide();
                $('#viewDailySales').show();

                $('#salesNo').text("Sales No.: " + response.salesInfo.sales_id);
                $('#salesDate').text("Date.: " + response.salesInfo.received_order_date);
                $('#salesSummary').text("Sales Summary.: " + response.salesInfo.dailySales);

                $('#salesNoDaily').text("Sales No.: " + response.salesInfo.sales_id);
                $('#salesDateDaily').text("Date.: " + response.salesInfo.received_order_date);
                $('#salesSummaryDaily').text("₱" + response.salesInfo.dailySales);

                salesData = response.data;
                renderTable();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('AJAX error:', textStatus, errorThrown);
            }
        });
    });

    // Render table with pagination and sorting
    function renderTable() {
        $tableBody.empty();

        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = Math.min(startIndex + itemsPerPage, salesData.length);

        for (let i = startIndex; i < endIndex; i++) {
            const item = salesData[i];
            const row = $('<tr></tr>')
                .append('<td>' + item.t_code + '</td>')
                .append('<td>' + item.date + '</td>')
                .append('<td>' + item.subtotal + '</td>')
                .append('<td>' + item.discount + '</td>')
                .append('<td>' + item.tax + '</td>')
                .append('<td>' + item.sales + '</td>')
                .append('<td>' + item.payment + '</td>')
                .append('<td>' + item.change + '</td>');
        
            // Append to the first table body
            $tableBody.append(row);
        
            // Clone the row to append to the second table body
            $("#printDailyTable").append(row.clone());
        }
        

        updatePagination();
        updateItemCount();
    }

    // Update pagination controls
    function updatePagination() {
        const totalPages = Math.ceil(salesData.length / itemsPerPage);
        let paginationHtml = '';

        // Previous Button
        if (currentPage > 1) {
            $('#prevPage').prop('disabled', false);
        } else {
            $('#prevPage').prop('disabled', true);
        }

        // Next Button
        if (currentPage < totalPages) {
            $('#nextPage').prop('disabled', false);
        } else {
            $('#nextPage').prop('disabled', true);
        }

        // Page Number Buttons
        for (let i = 1; i <= totalPages; i++) {
            const isActive = i === currentPage ? ' btn-danger' : '';
            paginationHtml += `<button class="btn btn-sm ${isActive}" data-page="${i}">${i}</button> `;
        }

        $('#pageNumbers').html(paginationHtml);

        // Attach click event for page buttons
        $('.page-btn').on('click', function() {
            currentPage = $(this).data('page');
            renderTable();
        });
    }

    // Update item count display
    function updateItemCount() {
        const startIndex = (currentPage - 1) * itemsPerPage + 1;
        const endIndex = Math.min(currentPage * itemsPerPage, salesData.length);
        $('#infoDailySales').text(`Showing ${startIndex} to ${endIndex} of ${salesData.length} entries`);
    }

    // Handle previous and next page buttons
    $('#prevPage').on('click', function() {
        if (currentPage > 1) {
            currentPage--;
            renderTable();
        }
    });

    $('#nextPage').on('click', function() {
        const totalPages = Math.ceil(salesData.length / itemsPerPage);
        if (currentPage < totalPages) {
            currentPage++;
            renderTable();
        }
    });

    // Handle items per page change
    $('#itemsPerPageDailySales').on('change', function() {
        itemsPerPage = parseInt($(this).val());
        currentPage = 1; // Reset to first page
        renderTable();
    });
});

$('#backViewDaily').on('click', function(){
    $('#storeTable, #header_reports').show()
    $('#viewDailySales').hide()
});


$('#printBtn').on('click', function(){
    // Trigger the print dialog
    window.print();
    
});


