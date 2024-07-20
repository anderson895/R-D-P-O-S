$(".deleteConfirmation").on("click", function() {
    record_id = $(this).attr('data-record_id');
    acc_id = $(this).attr('data-acc_id');
    //$('#ssid').val(ssid);
    console.log(acc_id);

    Swal.fire({
        title: "Are you sure?",
        text: "Move to archive this record",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, remove it!",
        confirmButtonClass: "btn btn-primary",
        cancelButtonClass: "btn btn-danger ml-1",
        buttonsStyling: false
    }).then(function(result) {
        if (result.value) {
            // Dito mo isasagawa ang AJAX request para sa pag-update ng product
            $.ajax({
                url: 'managestocks/controller/delete_record.php', // Palitan mo ito ng tamang URL
                type: 'POST',
                data: {
                    record_id:record_id,
                    acc_id:acc_id,
                    record_status: 2
                },
                success: function(response) {
                    // Dito mo ilalagay ang mga actions na kailangan mong gawin kapag successful ang update
                    Swal.fire({
                        type: "success",
                        title: "Deleted!",
                        text: "Your record has been moved to archive.",
                        confirmButtonClass: "btn btn-success"
                    }).then(function() {
                        location.reload();
                    });
                },
                error: function(xhr, status, error) {
                    // Dito mo ilalagay ang mga actions para sa error handling
                    Swal.fire({
                        type: "error",
                        title: "Error",
                        text: "An error occurred while deleting the product.",
                        confirmButtonClass: "btn btn-danger"
                    });
                }
            });
        }
    });
});
