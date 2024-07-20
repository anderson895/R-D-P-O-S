$(document).ready(function () {
  


    $(document).on('click', '.btnRemove', function() {
        // Get the values from the input fields

        var db_s_id = $(this).attr("data-db_s_id");

   
        console.log(db_s_id)

 // Show confirmation alert
        Swal.fire({
            title: "Are you sure?",
            text: `Remove Stock ID ${db_s_id}`,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, send it!",
            confirmButtonClass: "btn btn-primary",
            cancelButtonClass: "btn btn-secondary ml-1",
            buttonsStyling: false
        }).then(function(result) {
            if (result.value) {
        $.ajax({
            url: 'stock_in/controller/removeStocks.php',
            method: 'POST',
            data: { db_s_id: db_s_id },
            dataType: 'json',
            success: function (response) {
                // Handle the response from the server
           
                console.log(response);
               
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', status, error);
                console.log('XHR:', xhr.responseText); // Log the full response text for debugging
            }
        });


                }
            });
            });

            //swal end
    });
    