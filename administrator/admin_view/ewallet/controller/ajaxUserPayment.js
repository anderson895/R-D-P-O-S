
$(document).ready(function () {
    $(".RemoveToDisplayPayment").on("click", function () {

        var acc_id = $('#acc_id').val();
        var payment_id = $(this).data('payment_id'); // Get acc_id from the clicked element
      
        var message = "Remove this E-wallet and its automatically disable";
      
        // Show the initial SweetAlert with "Yes" and "Cancel" options
        Swal.fire({
          title: "Are you sure?",
          text: message,
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes",
          cancelButtonText: "Cancel",
          confirmButtonClass: "btn btn-primary",
          cancelButtonClass: "btn btn-danger ml-1",
          buttonsStyling: false,
        }).then(function (result) {
          if (result.value) {
            // If the user clicks "Yes," proceed with the AJAX request
            $.ajax({
              url: 'ewallet/controller/RemoveToDisplayEwallet.php',
              type: 'POST',
              data: {
                acc_id: acc_id,
                payment_status:2,
                payment_id: payment_id,
              },
              success: function (response) {
                // Handle the success response
                Swal.fire({
                  type: "success",
                  title: "Action Successful",
                  text: "E-wallet has been removed",
                  confirmButtonClass: "btn btn-success",
                }).then(function (result) {

                 //console.log(response);
               location.reload();

                });
                
              },
              error: function (xhr, status, error) {
                // Handle the error response
                Swal.fire({
                  type: "error",
                  title: "Error",
                  text: "An error occurred while enabling/disabling the e wallet.",
                  confirmButtonClass: "btn btn-danger",
                });

                console.log(response)
              },
            });
          } else {
            // If the user clicks "Cancel," handle any necessary actions (e.g., toggle the checkbox state)
            // You might want to perform some action here
          }
        });
      });
      



    // Listen for the checkbox change event
    $(".check").on("change", function () {
      var checkbox = $(this);
      var acc_id = $('#acc_id').val();

      if (checkbox.is(":checked")) {
        // Checkbox is checked, show "Enable" message
        var message = "Are you sure you want to enable this ewallet?";
      } else {
        // Checkbox is unchecked, show "Disable" message
        var message = "Are you sure you want to disable this ewallet ?";
      }

      // Traverse the DOM to find the associated acc_id
      var payment_id = checkbox.val();

      // Show the initial SweetAlert with "Yes" and "Cancel" options
      Swal.fire({
        title: "Are you sure?",
        text: message,
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes",
        cancelButtonText: "Cancel",
        confirmButtonClass: "btn btn-primary",
        cancelButtonClass: "btn btn-danger ml-1",
        buttonsStyling: false,
      }).then(function (result) {
        if (result.value) {
          // If the user clicks "Yes," proceed with the AJAX request
          $.ajax({
            url: 'ewallet/controller/changeEwalletStatus.php',
            type: 'POST',
            data: {
              acc_id: acc_id,
              payment_id: payment_id,
              payment_status: checkbox.is(":checked") ? 0 : 1
            },
            success: function (response) {
              // Handle the success response
              Swal.fire({
                type: "success",
                title: "Action Successful",
                text: "E-wallet has been " + (checkbox.is(":checked") ? "enabled" : "disabled") + ".",
                confirmButtonClass: "btn btn-success"
              });

              // Log the response inside the success callback
             console.log(response);
             alertify.success("Changes successfully saved.");
            },
            error: function (xhr, status, error) {
              // Handle the error response
              Swal.fire({
                type: "error",
                title: "Error",
                text: "An error occurred while enabling/disabling the E-wallet.",
                confirmButtonClass: "btn btn-danger"
              });
            }
          });
        } else {
          // If the user clicks "Cancel," handle any necessary actions (e.g., toggle the checkbox state)
          checkbox.prop('checked', !checkbox.prop('checked'));
        }
      });
    });
  });