$(document).ready(function () {
    $('#UserimageUpload').change(function () {
        var input = this;
        var imageUploadError = $('#UserimageUploadError');
        var productViews = $('.productviews');

        if (input.files && input.files[0]) {
            var file = input.files[0];
            var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif|\.webp)$/i;


            if (!allowedExtensions.exec(file.name)) {
                // Display an error message if the file is not an image
                imageUploadError.text("Only image files are allowed (jpg, jpeg, png, gif).");
                input.value = '';
            } else {
                // Clear the error message, show the product view, and display the selected image
                imageUploadError.text('');
                productViews.removeAttr('hidden');
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.productviewsimg img').attr('src', e.target.result);
                };
                reader.readAsDataURL(file);
            }
        }
    });




                       $('#submitButton').click(function () {
                                // Kunin ang lahat ng data mula sa mga field
                                var account_id = $('#account_id').val();
                                var fname = $('#fname').val();
                                var lname = $('#lname').val();
                                var username = $('#username').val();
                                var phone = $('#phone').val();
                                var email = $('#email').val();
                                var accountType = $('#selectionAccountType').val();
                                var password = $('#password').val();
                                var confirmPassword = $('#cunfirmpassword').val();
                                
                                var region = $('#region').val();
                                var province = $('#province').val();
                                var city = $('#city').val();
                                var barangay = $('#barangay').val();
                                var streetDescription = $('#streetDescription').val();

                                var userImage = $('#UserimageUpload')[0].files[0];

                                // Gumawa ng FormData object para sa pag-post ng mga file
                                var formData = new FormData();
                                formData.append('account_id', account_id);
                                formData.append('fname', fname);
                                formData.append('lname', lname);
                                formData.append('username', username);
                                formData.append('phone', phone);
                                formData.append('email', email);
                                formData.append('accountType', accountType);
                                formData.append('password', password);
                                formData.append('confirmPassword', confirmPassword);

                                formData.append('region', region);
                                formData.append('province', province);
                                formData.append('city', city);
                                formData.append('barangay', barangay);
                                formData.append('streetDescription', streetDescription);

                                formData.append('userImage', userImage);


                                $("#submitButton").css("display", "none");
                                $("#backBtn").css("display", "none");
                                // Gumawa ng Ajax request
                                $.ajax({
                                    url: 'adduser/controller/addUserProcess.php', // I-update ito sa tamang path ng iyong PHP file
                                    type: 'POST',
                                    data: formData,
                                    contentType: false,
                                    processData: false,
                                    success: function (response) {
                                        // I-handle ang response dito kung kinakailangan
                                      

                                    },
                                    beforeSend: function() {
                                        $("#loadingSpinner").html('<div class="spinner-border text-warning" role="status"><span class="sr-only">Loading...</span></div>').show();
                                      }, 

                                      error: function(xhr, status, error) {
                                        console.error("AJAX Error: " + error);
                                      },
                                      complete: function() {
                                        $("#loadingSpinner").hide();
                                        $("#submitButton").css("display", "block");
                                          $("#backBtn").css("display", "block");
                                          window.location.href = 'userlist.php';
                                      }
                                });
                                
                            });
});