
$(document).ready(function() {

    $("#profileimage").on("change", function() {
    // Check if a file is selected
    if (this.files.length > 0) {
        // Get the selected file
        var selectedFile = this.files[0];

        // Check if the selected file is an image
        if (selectedFile.type.startsWith("image/")) {
            // Create a URL for the selected image
            var imageUrl = URL.createObjectURL(selectedFile);

            // Change the 'src' attribute of the image with id "profileImg"
            $("#profileImg").attr("src", imageUrl);
        } else {
            alert("Invalid file type. Please select an image file.");
            // Clear the file input
            $(this).val("");
        }
    }
});


$(".toglerSaveDPandInfo").on("click", function() {

var profileImage = $("#profileimage")[0];
var account_id = $("#account_id").val();
var firstname = $("#firstname").val();
var lastname = $("#lastname").val();
var email = $("#email").val();
var phone = $("#phone").val();
var username = $("#username").val();
var oldPasword = $("#oldPasword").val();

var selectionAccountType = $("#selectionAccountType").val();




console.log(selectionAccountType )
//var newpassword = $("#newpassword").val();
//var confirmPassword = $("#confirmPassword").val();


           
    var formData = new FormData();

      // Append the selected file to the FormData object
      formData.append("profileimage", profileImage.files[0]);
      formData.append("account_id", account_id);
      formData.append("firstname", firstname);
      formData.append("lastname", lastname);
      formData.append("email", email);
      formData.append("phone", phone);
      formData.append("username", username);
      formData.append("oldPasword", oldPasword);
      formData.append("selectionAccountType", selectionAccountType);

      // Send the files to the server using AJAX
      $.ajax({
          url: "generalSettings/controller/uploadProfileInfo.php",
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          success: function(response) {
              // Dito mo ilalagay ang mga actions na kailangan mong gawin kapag successful ang update

              Swal.fire({
                  type: "success",
                  title: "Success!",
                  text: "Your Information has been updated.",
                  confirmButtonClass: "btn btn-success"
              }).then(function() {
              //  location.reload();
              //console.log(response)
              alertify.success("Your Information has been saved")
              
              });
          },
          error: function(xhr, status, error) {
              // Dito mo ilalagay ang mga actions para sa error handling
              Swal.fire({
                  type: "error",
                  title: "Error",
                  text: "An error occurred while saving cover photo.",
                  confirmButtonClass: "btn btn-danger"
              });
          }
      });
      
  

});






    $("#backgroundimage").on("change", function() {
        // Check if a file is selected
        if (this.files.length > 0) {
            // Get the selected file
            var selectedFile = this.files[0];

            // Check if the selected file is an image
            if (selectedFile.type.startsWith("image/")) {
                // Create a URL for the selected image
                var imageUrl = URL.createObjectURL(selectedFile);

                // Change the background image of profile-head
                $(".profile-head").css("background-image", "url(" + imageUrl + ")");
            } else {
                alert("Invalid file type. Please select an image file.");
                // Clear the file input
                $(this).val("");
            }
        }
    });
//toglerSaveDPandInfo
    $(".toglerSaveProfile").on("click", function() {
        // Get the file input element
        var fileInput = $("#backgroundimage")[0];
        var account_id = $("#account_id").val();

       
        if (fileInput.files.length > 0) {
           
          var formData = new FormData();

            // Append the selected file to the FormData object
            formData.append("backgroundimage", fileInput.files[0]);
            formData.append("account_id", account_id);

            // Send the files to the server using AJAX
            $.ajax({
                url: "profile/controller/uploadCover.php",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    // Dito mo ilalagay ang mga actions na kailangan mong gawin kapag successful ang update

                    Swal.fire({
                        type: "success",
                        title: "Success!",
                        text: "Your cover has been updated.",
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
                        text: "An error occurred while saving cover photo.",
                        confirmButtonClass: "btn btn-danger"
                    });
                }
            });
            
        } else {
            console.log("No file selected.");
        }
    });
});