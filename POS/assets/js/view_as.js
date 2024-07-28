$(document).ready(function () {
    // Function to handle search for both offline and online transactions
    $('#searchInput').on('input', function () {
        var searchTerm = $(this).val().toLowerCase();

        // Hide/show rows based on search term in offline transactions
        $('#view_transaction .clickable-row').each(function () {
            var transactionCode = $(this).find('#tcode').text().toLowerCase();

            if (transactionCode.includes(searchTerm)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });

        // Hide/show rows based on search term in online transactions
        $('#view_online .clickable-row').each(function () {
            var transactionCode = $(this).find('#tcode').text().toLowerCase();

            if (transactionCode.includes(searchTerm)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
});