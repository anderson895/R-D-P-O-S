

    $(".toglerEditUnit").on("click", function() {
        
       // Define db_acc_id and spl_id or obtain their values
        var unit_id = $(this).data("unit_id");  // Replace with actual value
        var unit_name = $(this).data("unit_name");     // Replace with actual value
        var unit_description = $(this).data("unit_description");  
        var unit_status = $(this).data("unit_status");  

        $("#unit_name_update").val(unit_name);
        $("#unit_description_update").val(unit_description);
        $("#unit_status_update").val(unit_status);
        $("#unit_status_update_select").val(unit_status);
        $("#unit_id").val(unit_id);

        console.log(unit_id)

    });


    $(".toglerEditUnitProcess").on("click", function() {

        
        var unit_name_update =$("#unit_name_update").val()
        var unit_description_update =$("#unit_description_update").val()
        var unit_status_update_select =$("#unit_status_update_select").val()
        var acc_id =$("#acc_id").val()
        var unit_id =$("#unit_id").val()


        console.log(acc_id)

    $.ajax({
            url: 'manageunit/controller/update_unitProcess.php',
            type: 'POST',
            data: {
                unit_name_update: unit_name_update,
                unit_description_update: unit_description_update,
                unit_status_update_select: unit_status_update_select,
                unit_id:unit_id,
                acc_id: acc_id
            },
            success: function(response) {
                // Actions for successful update
                Swal.fire({
                    type: "success",
                    title: "Success!",
                    text: "Unit update successful.",
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
