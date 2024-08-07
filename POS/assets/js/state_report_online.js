$(document).ready(function() {
    $('.dropdown-item').on('click', function(e) {
        e.preventDefault();

        var target = $(this).data('target');

        // Hide all content divs
        $('#search, #storeTable, #search_monthly, #store_monthly, #search_yearly, #store_yearly').hide();

        // Show the relevant divs based on the selected target
        if (target === 'daily') {
            $('#search, #storeTable').show();
        } else if (target === 'monthly') {
            $('#search_monthly, #store_monthly').show();
        } else if (target === 'yearly') {
            $('#search_yearly, #store_yearly').show();
        }
    });
});