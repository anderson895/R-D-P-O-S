
$(document).ready(function () {
    // $(".RemoveToDisplayUser").on("click", function () {
      $(document).on("click", ".RemoveToDisplayUser", function() {
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
    // $(".check").on("change", function () {

          $(document).on("change", ".check", function() {
          var checkbox = $(this);
          var session_id = $('#session_id').val();
          var acc_id = checkbox.val(); // Traverse the DOM to find the associated acc_id

          // Determine the message based on the checkbox state
          var message = checkbox.is(":checked") 
              ? "Are you sure you want to enable this account?" 
              : "Are you sure you want to disable this account?";

          // Show the initial SweetAlert with "Yes" and "Cancel" options
          Swal.fire({
              title: "Are you sure?",
              text: message,
              icon: "warning", // Changed from 'type' to 'icon' for SweetAlert2
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Yes",
              cancelButtonText: "Cancel",
              confirmButtonClass: "btn btn-primary",
              cancelButtonClass: "btn btn-danger ml-1",
              buttonsStyling: false,
          }).then(function(result) {
              if (result.isConfirmed) { // Changed from result.value to result.isConfirmed
                  // If the user clicks "Yes," proceed with the AJAX request
                  $.ajax({
                      url: 'userlist/controller/changeUserStatus_user.php',
                      type: 'POST',
                      data: {
                          acc_id: acc_id,
                          session_id: session_id,
                          acc_status: checkbox.is(":checked") ? 0 : 2
                      },
                      success: function(response) {
                          // Handle the success response
                          Swal.fire({
                              icon: "success", // Changed from 'type' to 'icon'
                              title: "Action Successful",
                              text: "Account has been " + (checkbox.is(":checked") ? "enabled" : "disabled") + ".",
                              confirmButtonClass: "btn btn-success"
                          });
                      },
                      error: function(xhr, status, error) {
                          // Handle the error response
                          Swal.fire({
                              icon: "error", // Changed from 'type' to 'icon'
                              title: "Error",
                              text: "An error occurred while enabling/disabling the account.",
                              confirmButtonClass: "btn btn-danger"
                          });
                      }
                  });
              } else {
                  // If the user clicks "Cancel," revert the checkbox state
                  checkbox.prop('checked', !checkbox.prop('checked'));
              }
          });
      });

  });