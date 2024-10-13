$(document).ready(function() {
    $(".viewFeedBack").on("click", function() {
        var unit_description = $(this).data("r_feedback"); // Corrected to 'completeaddress'
        Swal.fire({
            title: 'Customers Feedback',
            text: unit_description
           
        });
    });
});