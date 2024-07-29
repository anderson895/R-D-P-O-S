function fetStoreTable() {
    $.ajax({
        url: '../functions/get_pos_transaction.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            // Ensure response is an array
            let data = Array.isArray(response) ? response : [];
            let currentPage = 1;
            let rowsPerPage = 15; // Default value for rows per page
            let currentSortColumn = null;
            let currentSortDirection = 'asc';

            // Sort data by the latest date first
            data.sort((a, b) => new Date(b.orders_date) - new Date(a.orders_date));

            // Event listener for search input
            $('#search').on('input', function() {
                currentPage = 1;  // Reset to the first page on search
                renderTable();
                setupPagination();
            });

            // Event listener for items per page dropdown
            $('#itemsPerPage').on('change', function() {
                rowsPerPage = parseInt(this.value, 10);
                currentPage = 1;
                renderTable();
                setupPagination();
            });

            function renderTable() {
                const tableBody = $('#tableBody');
                const searchText = $('#search').val().toLowerCase();
                const filteredData = data.filter(item =>
                    item.orders_tcode.toLowerCase().includes(searchText) ||
                    item.orders_discount_name.toLowerCase().includes(searchText) ||
                    item.orders_date.toLowerCase().includes(searchText)
                );

                if (filteredData.length === 0) {
                    tableBody.html('<tr><td colspan="9" style="text-align: center;">No items found.</td></tr>');
                } else {
                    const paginatedData = filteredData.slice((currentPage - 1) * rowsPerPage, currentPage * rowsPerPage);

                    tableBody.empty();
                    paginatedData.forEach(item => {
                        const row = `<tr id="viewPOS" data-pos-id="${item.orders_tcode}" style="font-size: 14px; cursor: pointer">
                                        <td class="orders-tcode">${item.orders_tcode}</td>
                                        <td class="orders-date">${item.orders_date}</td>
                                        <td class="orders-discount">${item.orders_discount}</td>
                                        <td class="orders-discount-name">${item.orders_discount_name}</td>
                                        <td class="orders-tax">${item.orders_tax}</td>
                                        <td class="orders-final">${item.orders_final}</td>
                                        <td class="orders-payment">${item.orders_payment}</td>
                                        <td class="orders-change">${item.orders_change}</td>
                                    </tr>`;
                        
                        tableBody.append(row);
                    });
                }

                // Update info section with total items and items per page
                const totalItems = filteredData.length;
                $('#info').text(`Showing ${Math.min(rowsPerPage, totalItems)} of ${totalItems} items.`);
            }

            function setupPagination() {
                const pagination = $('#pagination');
                const searchText = $('#search').val().toLowerCase();
                const filteredData = data.filter(item =>
                    item.orders_tcode.toLowerCase().includes(searchText) ||
                    item.orders_discount_name.toLowerCase().includes(searchText)
                );

                const pageCount = Math.ceil(filteredData.length / rowsPerPage);
                pagination.empty();

                // Previous Button
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

                // Page Buttons
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

                // Next Button
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
                const tableBody = $('#tableBody');
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
            }

            // Add event listeners to table headers for sorting
            $('#tableHead th').on('click', function() {
                const columnIndex = $(this).index();
                sortTable(columnIndex);
            });

            // Initialize table and pagination
            renderTable();
            setupPagination();
        },
        error: function(xhr, status, error) {
            // Handle error
            $('#result').html('<p>Error: ' + error + '</p>');
        }
    });
}

// Initialize the table on page load
fetStoreTable();

$(document).on('click', '#viewPOS', function() {
    const tcode = $(this).data('pos-id');
    window.location.href = `view_transactions?id=${tcode}`;
});
