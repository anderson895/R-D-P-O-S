<div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                <h4>Payment Settings</h4>
                <h6>Add new bank payment</h6>
                </div>
            </div>

            <div class="card">
            <input type="text" hidden id="acc_id" value="<?=$acc_id?>" class="form-control">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="paymentName">Bank Name</label>
                                <input type="text" id="paymentName" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="paymentNumber">Bank Number</label>
                                <input type="text" id="paymentNumber" class="form-control">
                            </div>
                        </div>

                        

                       

                        

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="profilePicture">Bank Image</label>
                                <div class="image-upload image-upload-new">
                                    <input type="file" id="profilePicture" class="form-control">
                                    <div class="image-uploads">
                                        <img id="previewImage" src="assets/img/icons/upload.svg" alt="img">
                                        <h4>Drag and drop a file to upload</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                            <label for="PaymentStatus">Status</label>
                              <select class="form-select" name="PaymentStatus" id="PaymentStatus">
                                <option value="0">Active</option>
                                <option value="1">InActive</option>
                              </select>
                            </div>
                        </div>
                       

                        <div class="col-lg-12">
                        <button id="submitBtn" class="btn btn-submit me-2">Submit</button>
                         <a href="banklist.php" class="btn btn-cancel">Bank</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.getElementById("profilePicture").addEventListener("change", function(event) {
        var profilePicture = event.target.files[0];
   

        // Check if the uploaded file is a valid image
        var allowedImageTypes = ["image/jpeg", "image/png", "image/gif", "image/webp"];
        if (!allowedImageTypes.includes(profilePicture.type)) {
           // alert("Please upload a valid image (JPEG, PNG, GIF, or WebP)");
            alertify.error("Please upload a valid image (JPEG, PNG, GIF, or WebP).");
            // Reset the file input to clear the selected file
            event.target.value = "";
        }
    });

    function validateForm() {
        var paymentName = document.getElementById("paymentName").value;
        var paymentNumber = document.getElementById("paymentNumber").value;

        if (paymentName.trim().length < 2) {
            alertify.error("Bank Name must be more than 2 characters");
            return false;
        }

        var paymentNumberRegex = /^\d{5,16}$/;  // Updated regex to allow 5 to 16 digits
        if (!paymentNumberRegex.test(paymentNumber)) {
            alertify.error("Bank Number must be between 5 and 16 digits long");
            return false;
        }

        var profilePicture = document.getElementById("profilePicture").files[0];
        if (!profilePicture) {
            alertify.error("Please upload Bank Image");
            return false;
        }

        // Check if the uploaded file is a valid image
        var allowedImageTypes = ["image/jpeg", "image/png", "image/gif", "image/webp"];
        if (!allowedImageTypes.includes(profilePicture.type)) {
           // alert("Please upload a valid image (JPEG, PNG, GIF, or WebP)");
            alertify.error("Please upload a valid image (JPEG, PNG, GIF, or WebP).");
            return false;
        }

        return true;
    }

    document.getElementById("submitBtn").addEventListener("click", function(event) {
        event.preventDefault(); // Prevent the default form submission

        if (validateForm()) {
            // All validations passed, send an AJAX request
            var acc_id=$("#acc_id").val();
            var paymentName = $("#paymentName").val();
            var paymentNumber = $("#paymentNumber").val();
            var PaymentStatus=$("#PaymentStatus").val();
            var formData = new FormData();
            formData.append("paymentName", paymentName);
            formData.append("paymentNumber", paymentNumber);
            formData.append("PaymentStatus", PaymentStatus);
            formData.append("acc_id", acc_id);
            formData.append("profilePicture", $("#profilePicture")[0].files[0]); // Append the image file

            // Send the AJAX request only if the form is valid
            $.ajax({
                url: "banklist/controller/addPaymentProcess.php", // Replace with the actual PHP script URL
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Handle the success response here
                    alertify.success("Form successfully submitted.");
                    console.log(response);
                    window.location.href = "banklist.php";
                },
                error: function(xhr, status, error) {
                    // Handle the error here
                    alertify.error("An error occurred: " + error);
                    console.log(response);
                }
            });
        }
    });
</script>









    <script src="banklist/javascript/upload_imagetempo.js"></script>

