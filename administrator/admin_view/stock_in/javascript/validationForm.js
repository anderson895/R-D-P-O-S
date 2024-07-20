$(document).ready(function () {
    // Disable submit button initially
    $('#stock_submit_btn').prop('disabled', true);

    // Add a change event listener to the supplier select
    $('select[name="supplier_code"]').change(function () {
        // Enable or disable submit button based on the selected value
        var supplierCode = $(this).val();
        $('#stock_submit_btn').prop('disabled', supplierCode === 'Select Supplier');
    });

    // Add a click event listener to the submit button
    $('#stock_submit_btn').click(function (e) {
        // Check if the required input fields have values
        var invoiceNo = $('input[name="invoice_no"]').val();
        var stockinDate = $('input[name="stockin_date"]').val();

        // Check if the selected date is today or a future date
        var today = new Date().toISOString().split('T')[0];

        if ($('#stock_submit_btn').prop('disabled') || invoiceNo.trim() === '' || stockinDate < today) {
            // If the submit button is disabled, any field is empty, or the date is past today, prevent the form submission and display an alert
            e.preventDefault();
            alertify.error("Please choose a valid date, including today or a future date");
        } else {
            // If conditions are met, proceed with form submission
            // Optionally, you can hide any error messages here
        }
    });
});
