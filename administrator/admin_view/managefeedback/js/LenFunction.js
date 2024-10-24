$(document).ready(function() {
    $(document).on("click", ".viewFeedBack", function (e) {
        var unit_description = $(this).data("r_feedback"); // Corrected to 'completeaddress'
        Swal.fire({
            title: 'Customers Feedback',
            text: unit_description
           
        });
    });

    

    
    // Listen for the checkbox change event
    $(document).on("click", ".btnRequestToAllowed", function (e) {
        var r_id = $(this).attr('data-id');
        
        console.log(r_id);
  
  
        // Show the initial SweetAlert with "Yes" and "Cancel" options
        Swal.fire({
          title: "Are you sure?",
          text: "Are you sure you want to display this customer feedback?",
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
              url: 'managefeedback/controller/post.php',
              type: 'POST',
              data: {
                r_id: r_id,
                SubmitType:"AllowedReviews",
              },
              success: function (response) {
                // Handle the success response
                Swal.fire({
                  type: "success",
                  title: "Action Successful",
                  text: "Feedback has been display",
                  confirmButtonClass: "btn btn-success"
                });
  
                // Log the response inside the success callback
               console.log(response);
               
              },
            });
          } else {
            
          }
        });
      });




      // Listen for the checkbox change event
    $(document).on("click", ".btnRequestToRestrict", function (e) {
        var r_id = $(this).attr('data-id');
        
        console.log(r_id);
  
  
        // Show the initial SweetAlert with "Yes" and "Cancel" options
        Swal.fire({
          title: "Are you sure?",
          text: "Are you sure you want to remove this feedback on the display?",
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
              url: 'managefeedback/controller/post.php',
              type: 'POST',
              data: {
                r_id: r_id,
                SubmitType:"AllowedReviews",
              },
              success: function (response) {
                // Handle the success response
                Swal.fire({
                  type: "success",
                  title: "Action Successful",
                  text: "Feedback remove on the display successful",
                  confirmButtonClass: "btn btn-success"
                });

              },
            });
          } else {
            
          }
        });
      });




});



