function fetchStoreTable() {
    $.ajax({
        url: '../../POS/functions/get_report_yearly_online.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            let data = Array.isArray(response) ? response : [];
            let currentPage = 1;
            let rowsPerPage = 15;
            let currentSortColumn = null;
            let currentSortDirection = 'asc';

            $('#search_yearly').on('input', function() {
                currentPage = 1;
                renderTable();
                setupPagination();
            });

            $('#itemsPerPage_yearly_online').on('change', function() {
                rowsPerPage = parseInt(this.value, 10);
                currentPage = 1;
                renderTable();
                setupPagination();
            });

            function renderTable() {
                const tableBody = $('#tableBody_yearly_online');
                const searchText = $('#search_yearly').val().toLowerCase();
                const filteredData = data.filter(item => {
                    const year = item.order_year.toLowerCase();
                    const transactionCode = `SLS${String(item.id).padStart(4, '0')}`.toLowerCase();
                    return year.includes(searchText) ||
                           transactionCode.includes(searchText) ||
                           item.yearly_total.toLowerCase().includes(searchText);
                });

                if (filteredData.length === 0) {
                    tableBody.html('<tr><td colspan="3" style="text-align: center;">No items found.</td></tr>');
                } else {
                    const paginatedData = filteredData.slice((currentPage - 1) * rowsPerPage, currentPage * rowsPerPage);

                    tableBody.empty();
                    paginatedData.forEach((item, index) => {
                        const transactionCode = `SLS${String(index + 1).padStart(4, '0')}`;
                        const row = `<tr style="font-size: 14px">
                                        <td class="orders-tcode">${transactionCode}</td>
                                        <td class="orders-date">${item.order_year}</td>
                                        <td class="orders-total">${item.yearly_total}</td>
                                    </tr>`;
                        tableBody.append(row);
                    });
                }

                const totalItems = filteredData.length;
                $('#info_yearly_online').text(`Showing ${Math.min(rowsPerPage, totalItems)} of ${totalItems} items.`);
            }

            function setupPagination() {
                const pagination = $('#pagination_yearly_online');
                const searchText = $('#search_yearly').val().toLowerCase();
                const filteredData = data.filter(item => {
                    const year = item.order_year.toLowerCase();
                    const transactionCode = `SLS${String(item.id).padStart(4, '0')}`.toLowerCase();
                    return year.includes(searchText) ||
                           transactionCode.includes(searchText) ||
                           item.yearly_total.toLowerCase().includes(searchText);
                });

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
                const tableBody = $('#tableBody_yearly_online');
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

            $('#itemsPerPage_yearly_online th').on('click', function() {
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

$(document).ready(function() {
    fetchStoreTable();
});
