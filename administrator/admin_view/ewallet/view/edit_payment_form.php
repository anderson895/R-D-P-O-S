
<?php 
$payment_id=$_GET["payment_id"];


$get_record = mysqli_query ($connections,"SELECT *
FROM mode_of_payment
WHERE payment_id = '$payment_id' ");
		$row = mysqli_fetch_assoc($get_record);
		$payment_id = $row["payment_id"];
         $payment_code = $row["payment_code"];
         $payment_name = $row["payment_name"];
         $payment_number = $row["payment_number"];
         $payment_image = $row["payment_image"];
         $payment_status = $row["payment_status"];
         
         date_default_timezone_set('Asia/Manila');
         $currentDateTime = date('Y-m-d g:i:s A');     
?>
<div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                <h4>Payment Settings</h4>
                <h6>Edit e-wallet</h6>
                </div>
            </div>

            <div class="card">
            <input type="text" hidden id="acc_id" value="<?=$acc_id?>" class="form-control">
            <input type="text" hidden id="payment_id" value="<?=$payment_id?>" class="form-control">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="paymentName">E wallet Name</label>
                                <input type="text" id="paymentName" value="<?= $payment_name?>" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="paymentNumber">E wallet Number</label>
                                <input type="text" id="paymentNumber" value="<?= $payment_number?>" class="form-control">
                            </div>
                        </div>

                        

                       

                        
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="profilePicture">Ewallet image</label>
                                <div class="image-upload image-upload-new">
                                    <input type="file" id="profilePicture" class="form-control">
                                    <div class="image-uploads">
                                        <img id="previewImage" src="../../upload_system/<?=$payment_image?>" alt="img" style="max-width: 100%; max-height: 100%;">
                                        <h4>Drag and drop a file to upload</h4>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                            <label for="PaymentStatus">Status</label>
                              <select class="form-select" name="PaymentStatus" id="PaymentStatus" >
                                <option <?php if($payment_status=='0'){ echo "selected";} ?> value="0">Active</option>
                                <option <?php if($payment_status=='1'){ echo "selected";} ?> value="1">InActive</option>
                              </select>
                            </div>
                        </div>
                       

                        <div class="col-lg-12">
                        <button id="submitBtn" class="btn btn-submit me-2">Submit</button>
                         <a href="ewalletlist.php" class="btn btn-cancel">Back</a>
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
    var profilePicture = document.getElementById("profilePicture").files[0];

    if (paymentName.trim().length < 2) {
        alertify.error("E-wallet Name must be more than 2 characters");
        return false;
    }

    var paymentNumberRegex = /^09\d{9}$/;
    if (!paymentNumberRegex.test(paymentNumber)) {
        alertify.error("E-wallet Number must start with '09' and be 11 digits long");
        return false;
    }

    // Check if a profile picture is attached and validate if it's an image
    if (profilePicture) {
        var allowedImageTypes = ["image/jpeg", "image/png", "image/gif", "image/webp"];
        if (!allowedImageTypes.includes(profilePicture.type)) {
            alertify.error("Please upload a valid image (JPEG, PNG, GIF, or WebP).");
            return false;
        }
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
            var payment_id=$("#payment_id").val();
            var formData = new FormData();
            formData.append("payment_id", payment_id);
            formData.append("paymentName", paymentName);
            formData.append("paymentNumber", paymentNumber);
            formData.append("PaymentStatus", PaymentStatus);
            formData.append("acc_id", acc_id);
            formData.append("profilePicture", $("#profilePicture")[0].files[0]); // Append the image file

            // Send the AJAX request only if the form is valid
            $.ajax({
                url: "ewallet/controller/editPaymentProcess.php", // Replace with the actual PHP script URL
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Handle the success response here
                    alertify.success("Successfully saved.");
                    console.log(response);
               //     window.location.href = "ewalletlist.php";
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









    <script src="ewallet/javascript/upload_imagetempo.js"></script>

