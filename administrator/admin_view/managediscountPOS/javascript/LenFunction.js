$(document).ready(function() {
    $(".viewDescription").on("click", function() {
        var unit_description = $(this).data("unit_description"); // Corrected to 'completeaddress'
        Swal.fire({
            title: 'Unit description',
            text: unit_description
           
        });
    });
});