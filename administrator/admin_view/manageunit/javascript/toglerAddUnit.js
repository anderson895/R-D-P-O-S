
$(document).ready(function() {
    $(".toglerAddUnit").on("click", function() {
        
        // Define db_acc_id and spl_id or obtain their values
        var unit_name = $("#unit_name").val(); // Replace with actual value
        var acc_id = $("#acc_id").val();    // Replace with actual value
        var unitStatus = $("#unitStatus").val();
        var unit_description = $("#unit_description").val();
        
        console.log(unit_name);
        console.log(acc_id);
        console.log(unitStatus);
        console.log(unit_description);

        // AJAX request to add unit
        $.ajax({
            url: 'manageunit/controller/add_unit.php',
            type: 'POST',
            data: {
                unit_name: unit_name,
                unit_description: unit_description,
                unitStatus: unitStatus,
                acc_id: acc_id
            },
            success: function(response) {
                // Actions for successful update
                Swal.fire({
                    type: "success",
                    title: "Success!",
                    text: "Unit Successfully added.",
                    confirmButtonClass: "btn btn-success"
                }).then(function() {   
                  location.reload();

              console.log(response)
                });
            },
            error: function(xhr, status, error) {
                // Error handling actions
                Swal.fire({
                    type: "error",
                    title: "Error",
                    text: "An error occurred while adding the unit.",
                    confirmButtonClass: "btn btn-danger"
                });
                console.log(response)


            }
        });
    });
});