
$(".deleteConfirmation").on("click", function() {
    unit_id = $(this).attr('data-unit_id');
    acc_id = $(this).attr('data-acc_id');
    unit_status = $(this).attr('data-unit_status');
    //$('#ssid').val(ssid);
    console.log(unit_status);

    Swal.fire({
        title: "Are you sure?",
        text: "Remove this unit",
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
                url: 'manageunit/controller/delete_unit.php', // Palitan mo ito ng tamang URL
                type: 'POST',
                data: {
                    unit_id:unit_id,
                    acc_id:acc_id,
                    unit_status: 2
                },
                success: function(response) {
                    // Dito mo ilalagay ang mga actions na kailangan mong gawin kapag successful ang update
                    Swal.fire({
                        type: "success",
                        title: "Deleted!",
                        text: "Unit has been deleted.",
                        confirmButtonClass: "btn btn-success"
                    }).then(function() {
                        location.reload();

                      console.log(response)
                    });
                },
                error: function(xhr, status, error) {
                    // Dito mo ilalagay ang mga actions para sa error handling
                    Swal.fire({
                        type: "error",
                        title: "Error",
                        text: "An error occurred while deleting the unit.",
                        confirmButtonClass: "btn btn-danger"
                    });
                }
            });
        }
    });
});
