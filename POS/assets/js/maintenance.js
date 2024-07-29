$(document).ready(function() {
    $("#btnSave").click(function (e) { 
        e.preventDefault();
        
        // Show the password confirmation modal
        $('#passwordModal').modal('show');
    });

    $("#confirmPasswordBtn").click(function() {
        var confirmPassword = $('#confirmPassword').val();
        var accId = $('#acc_id').val(); 

        if (!confirmPassword) {
            alert('Please enter your password to confirm.');
            return;
        }

        // Verify the password
        $.ajax({
            url: '../functions/verify_password.php', 
            type: 'POST',
            data: { acc_id: accId, password: confirmPassword },
            success: function(response) {
            

                if (response.trim() === 'verified') { 
                    var form = $('#accountProfileForm')[0];
                    if (!form) {
                        console.error('Form not found');
                        return;
                    }

                    var formData = new FormData(form);

                    // Submit the form data
                    $.ajax({
                        url: '../functions/maintinance_profile.php', 
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            // Handle success response
                            console.log('Form submitted successfully');
                            console.log(response);
                            $('#passwordModal').modal('hide');
                            location.reload();
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            // Handle error response
                            console.log('Error submitting form');
                            console.log(textStatus, errorThrown);
                        }
                    });
                } else {
                    // alertify.error('Password verification failed. Please try again.');
                    alertify.error("Incorrect Password.");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Handle error response
                console.log('Error verifying password');
                console.log(textStatus, errorThrown);
            }
        });
    });



    $(document).ready(function() {
        $("#btnUpdatePass").click(function (e) { 
            e.preventDefault();
            
            var oldPassword = $('#opsw').val();
            var newPassword = $('#npsw').val();
            var confirmPassword = $('#cpsw').val();
            var acc_id = $('#acc_id').val();
    
            if (!oldPassword || !newPassword || !confirmPassword) {
                alertify.alert('Missing Fields', 'Please fill in all fields.');
                
                return;
            }
    
            if (newPassword !== confirmPassword) {
                alertify.error('New password and confirm password do not match.');
                return;
            }
    
            $.ajax({
                url: '../functions/verify_password.php',
                type: 'POST',
                data: { password: oldPassword, acc_id: acc_id },
                success: function(response) {
                    console.log('Password verification response:', response);
    
                    if (response.trim() === 'verified') {
                        var form = $('#accountPrivacyForm')[0];
                        var formData = new FormData(form);
    
                        $.ajax({
                            url: '../functions/update_password.php',
                            type: 'POST',
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                console.log('Update password response:', response);
    
                                if (response.trim() === 'PasswordUpdated') {
                                    alertify.success("Password updated successfully");
                                } else {
                                    alertify.alert('Update Failed', response);
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.log('Error updating password');
                                console.log(textStatus, errorThrown);
                            }
                        });
                    } else {
                        //alertify.alert('Verification Failed', 'Old password verification failed. Please try again.');
                        alertify.error("Incorrect old password.");
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('Error verifying old password');
                    console.log(textStatus, errorThrown);
                }
            });
        });
    });
    
    
    
});
