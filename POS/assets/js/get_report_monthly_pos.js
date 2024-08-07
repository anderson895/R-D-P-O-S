function fetStoreTable() {
    $.ajax({
        url: '../../POS/functions/get_report_monthly_pos.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            // Ensure response is an array
            let data = Array.isArray(response) ? response : [];
            let currentPage = 1;
            let rowsPerPage = 15; // Default value for rows per page
            let currentSortColumn = null;
            let currentSortDirection = 'asc';

            // Convert month number to month name
            const monthNames = [
                "January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"
            ];

            // Event listener for search input
            $('#search_monthly_pos').on('input', function() {
                currentPage = 1;  // Reset to the first page on search
                renderTable();
                setupPagination();
            });

            // Event listener for items per page dropdown
            $('#itemsPerPage_monthly_pos').on('change', function() {
                rowsPerPage = parseInt(this.value, 10);
                currentPage = 1;
                renderTable();
                setupPagination();
            });

            function renderTable() {
                const tableBody = $('#tableBody_monthly_pos');
                const searchText = $('#search_monthly_pos').val().toLowerCase();
                const filteredData = data.filter(item => {
                    const monthName = monthNames[parseInt(item.order_month) - 1].toLowerCase();
                    const year = item.order_year.toLowerCase();
                    const transactionCode = `SLS${String(item.id).padStart(4, '0')}`.toLowerCase();
                    const combinedText = `${monthName} ${year}`;
                    return combinedText.includes(searchText) ||
                           transactionCode.includes(searchText) ||
                           item.monthly_total.toLowerCase().includes(searchText);
                });

                if (filteredData.length === 0) {
                    tableBody.html('<tr><td colspan="4" style="text-align: center;">No items found.</td></tr>');
                } else {
                    const paginatedData = filteredData.slice((currentPage - 1) * rowsPerPage, currentPage * rowsPerPage);

                    tableBody.empty();
                    
                    let counter = 1;

                    paginatedData.forEach(item => {
                        const transactionCode = `SLS${String(counter).padStart(4, '0')}`;
                        const monthName = monthNames[parseInt(item.order_month) - 1];
                        const row = `<tr style="font-size: 14px">
                                        <td class="orders-tcode">${transactionCode}</td>
                                        <td class="orders-date">${monthName}</td>
                                        <td class="orders-date">${item.order_year}</td>
                                        <td class="orders-discount">${item.monthly_total}</td>
                                    </tr>`;
                        
                        tableBody.append(row);
                        counter++;
                    });

                }

                // Update info section with total items and items per page
                const totalItems = filteredData.length;
                $('#info_monthly_pos').text(`Showing ${Math.min(rowsPerPage, totalItems)} of ${totalItems} items.`);
            }

            function setupPagination() {
                const pagination = $('#pagination_monthly_pos');
                const searchText = $('#search_monthly_pos').val().toLowerCase();
                const filteredData = data.filter(item => {
                    const monthName = monthNames[parseInt(item.order_month) - 1].toLowerCase();
                    const year = item.order_year.toLowerCase();
                    const transactionCode = `SLS${String(item.id).padStart(4, '0')}`.toLowerCase();
                    const combinedText = `${monthName} ${year}`;
                    return combinedText.includes(searchText) ||
                           transactionCode.includes(searchText) ||
                           item.monthly_total.toLowerCase().includes(searchText);
                });

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
                const tableBody = $('#tableBody_monthly_pos');
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
            $('#tableHead_monthly_pos th').on('click', function() {
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
