
$(document).ready(function () {
    $(".RemoveToDisplayUser").on("click", function () {
        var session_id = $('#session_id').val();
        var acc_id = $(this).data('acc-id'); // Get acc_id from the clicked element
      
        var message = "Remove this account to display and its automatically disable";
      
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
              url: 'userlist/controller/RemoveToDisplayUser.php',
              type: 'POST',
              data: {
                acc_id: acc_id,
                acc_display_status:1,
                session_id: session_id,
              },
              success: function (response) {
                // Handle the success response
                Swal.fire({
                  type: "success",
                  title: "Action Successful",
                  text: "Account has been removed",
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
                  text: "An error occurred while enabling/disabling the account.",
                  confirmButtonClass: "btn btn-danger",
                });
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
      var session_id = $('#session_id').val();

      if (checkbox.is(":checked")) {
        // Checkbox is checked, show "Enable" message
        var message = "Are you sure you want to enable this account?";
      } else {
        // Checkbox is unchecked, show "Disable" message
        var message = "Are you sure you want to disable this account?";
      }

      // Traverse the DOM to find the associated acc_id
      var acc_id = checkbox.val();

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
            url: 'userlist/controller/changeUserStatus_user.php',
            type: 'POST',
            data: {
              acc_id: acc_id,
              session_id: session_id,
              acc_status: checkbox.is(":checked") ? 0 : 2
            },
            success: function (response) {
              // Handle the success response
              Swal.fire({
                type: "success",
                title: "Action Successful",
                text: "Account has been " + (checkbox.is(":checked") ? "enabled" : "disabled") + ".",
                confirmButtonClass: "btn btn-success"
              });

              // Log the response inside the success callback
             // console.log(response);
             
            },
            error: function (xhr, status, error) {
              // Handle the error response
              Swal.fire({
                type: "error",
                title: "Error",
                text: "An error occurred while enabling/disabling the account.",
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