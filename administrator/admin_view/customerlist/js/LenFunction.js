$(document).ready(function() {
    $(".viewAddress").on("click", function() {
        var unit_description = $(this).data("user_complete_address"); // Corrected to 'completeaddress'
        Swal.fire({
            title: 'Customers Address',
            text: unit_description
           
        });
    });
});