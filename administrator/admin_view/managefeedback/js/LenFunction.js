$(document).ready(function() {
    $(document).on("click", ".viewFeedBack", function (e) {
        var unit_description = $(this).data("r_feedback"); // Corrected to 'completeaddress'
        Swal.fire({
            title: 'Customers Feedback',
            text: unit_description
           
        });
    });
});



