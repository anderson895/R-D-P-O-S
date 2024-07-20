<div class="modal fade" id="confirmModalAdmin" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmModalLabel">Confirmation</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h4>Enter Admin's Password</h4>
                                            <br>
                                            <input class="form-control" type="Password" id="adminsPassword">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-submit me-2" data-bs-dismiss="modal" id="confirmAdmin">Confirm</button>
                                            <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>

                   </div>
           </div>
      </div>
</div>

<script>$(document).ready(function () {
    // Kapag na-click ang Confirm button
    $("#confirmAdmin").click(function () {
        var session_code = $("#session_code").val();
        var adminsPassword = $("#adminsPassword").val();
        //form
        var acc_code = $("#acc_code").val();
        var acc_id = $("#acc_id").val();
        var fname = $("#fname").val();
        var lname = $("#lname").val();
        var username = $("#username").val();
        var phone = $("#phone").val();
        var email = $("#email").val();
        var selectionAccountType = $("#selectionAccountType").val();
        var password = $("#password").val();

        // Create a FormData object
        var formData = new FormData();

        // Append the image file to the FormData object
        var userImageFile = $("#UserimageUpload")[0].files[0];
        if (userImageFile) {
            formData.append("userImage", userImageFile);
        }

        // Append other form data to the FormData object
        formData.append("session_code", session_code);
        formData.append("adminsPassword", adminsPassword);
        formData.append("acc_code", acc_code);
        formData.append("acc_id", acc_id);
        formData.append("fname", fname);
        formData.append("lname", lname);
        formData.append("username", username);
        formData.append("phone", phone);
        formData.append("email", email);
        formData.append("selectionAccountType", selectionAccountType);
        formData.append("password", password);

        // Gumawa ng AJAX request para i-validate ang admin password
        $.ajax({
            type: "POST",
            url: "edituser/controller/check_password.php",
            data: formData,
            processData: false, // Prevent jQuery from automatically processing the data
            contentType: false, // Ensure that the content type is set to false
            success: function (response) {
                if (response === "match") {
                    // Password match for admin
                    // Ngayon, maaari mong ipasa ang lahat ng data sa editUserProcess.php
                    $.ajax({
                        type: "POST",
                        url: "edituser/controller/editUserProcess.php",
                        data: formData, // Send the FormData object
                        processData: false,
                        contentType: false,
                        success: function (editResponse) {
                            // Dito mo ma-handle ang response mula sa editUserProcess.php
                            console.log(editResponse);

                           alertify.success("Changes successfully saved")
                           $("#adminsPassword").val("");
                        }
                    });
                } else {
                    // Password does not match or admin not found
                    console.log(response);
                    console.log("Password does not match or admin not found");
                    console.log(adminsPassword);
                }
            }
        });
    });
});


</script>
