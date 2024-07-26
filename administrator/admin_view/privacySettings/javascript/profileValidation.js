$(document).ready(function() {
    $(".toglerSaveDPandInfo").on("click", function(event) {
        event.preventDefault();

        var newPsw = $('#newPsw').val(); // new password
        var confirmPsw = $('#confirmPsw').val(); // confirm password
        var oldPasword = $('#oldPasword').val(); // old password
        var accountId = $('#account_id').val(); // Account ID

        // Clear any previous error messages
        $('#error-message').text('');
        $('#success-message').text('');

        // Validate that the new password is not empty
        if (newPsw === '') {
            $('#error-message').text('New password cannot be empty.');
            return;
        }

        // Validate that the new password does not exceed 50 characters
        if (newPsw.length > 50) {
            $('#error-message').text('New password cannot exceed 50 characters.');
            return;
        }

        // Validate that new password and confirm password match
        if (newPsw !== confirmPsw) {
            $('#error-message').text('New password and confirm password do not match.');
            return;
        }

        // AJAX request to check the old password
        $.ajax({
            url: 'privacySettings/controller/check_oldpassword.php',
            type: 'GET',
            data: {
                account_id: accountId,
                Oldpassword: oldPasword
            },
            success: function(response) {
                if (response === '') {
                    // Old password is correct, proceed with password change logic
                    $.ajax({
                        url: 'privacySettings/controller/update_password.php',
                        type: 'POST',
                        data: {
                            account_id: accountId,
                            newPassword: newPsw
                        },
                        success: function(response) {
                            $('#success-message').text(response);
                        },
                        error: function() {
                            $('#error-message').text('An error occurred while updating the password.');
                        }
                    });
                } else {
                    // Old password is incorrect, display an error message
                    $('#error-message').text('Incorrect old password.');
                }
            },
            error: function() {
                $('#error-message').text('An error occurred while checking the old password.');
            }
        });
    });
});
