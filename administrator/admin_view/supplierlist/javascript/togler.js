
$(document).ready(function() {
    $(".viewAddress").on("click", function() {
        var address = $(this).data("completeaddress"); // Corrected to 'completeaddress'
        Swal.fire({
            title: 'Supplier Address',
            text: address
           
        });
    });
});



$(".toglerDeleteSupplier").on("click", function() {
db_acc_id = $(this).attr('data-db_acc_id');
spl_id = $(this).attr('data-spl_id');

//$('#ssid').val(ssid);
console.log(spl_id);

Swal.fire({
    title: "Are you sure?",
    text: "Remove this supplier",
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
            url: 'supplierlist/controller/delete_supplier.php', // Palitan mo ito ng tamang URL
            type: 'POST',
            data: {
                db_acc_id:db_acc_id,
                spl_id:spl_id,
                spl_status: 1
            },
            success: function(response) {
                // Dito mo ilalagay ang mga actions na kailangan mong gawin kapag successful ang update

                Swal.fire({
                    type: "success",
                    title: "Deleted!",
                    text: "supplier has been removed.",
                    confirmButtonClass: "btn btn-success"
                }).then(function() {
                   location.reload();
                // console.log(response)
                
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
