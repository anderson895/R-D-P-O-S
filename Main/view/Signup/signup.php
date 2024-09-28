<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="view/Signup/assets/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="view/Signup/assets/js/bootstrap.bundle.min.js"></script>
</head>
<body class="account-page">

<div class="main-wrapper">
    <div class="account-content">
        <div class="login-wrapper">
            <div class="login-content">
                <div class="login-userset">
                    <form method="POST">
                        <div class="login-userheading">
                            <h3>Create an Account</h3>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-login">
                                    <label>First Name</label>
                                    <div class="form-addons">
                                        <input type="text" placeholder="Enter your first name" name='fname' id="fname" value="">
                                        <div style="color:red;" id="fnameError"></div>
                                        <img src="view/Signup/assets/img/icons/users1.svg" alt="img">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-login">
                                    <label>Last Name</label>
                                    <div class="form-addons">
                                        <input type="text" placeholder="Enter your last name" name='lname' id="lname" value="">
                                        <div style="color:red;" id="lnameError"></div>
                                        <img src="view/Signup/assets/img/icons/users1.svg" alt="img">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-login">
                            <label for="birthdate">Birthday</label>
                            <div class="form-addons">
                                <input name='bday' value="2006-01-01" required type="date" id="birthdate">
                                <div style="color:red;" id="birthdateError"></div>
                            </div>
                        </div>

                        <div class="form-login">
                            <label>Username</label>
                            <div class="form-addons">
                                <input required type="text" placeholder="Username" name='username' id="username" value="">
                                <div style="color:red;" id="usernameLengthError"></div>
                                <div style="color:red;" id="usernameError"></div>
                                <img src="view/Signup/assets/img/icons/mail.svg" alt="img">
                            </div>
                        </div>

                        <div class="form-login">
                            <label>Email</label>
                            <div class="form-addons">
                                <input required type="email" placeholder="Email" name='email' id="email" value="">
                                <div style="color:red;" id="emailError"></div>
                                <img src="view/Signup/assets/img/icons/mail.svg" alt="img">
                            </div>
                        </div>

                        <div class="form-login">
                            <label>Contact Number</label>
                            <div class="form-addons">
                                <input required type="number" placeholder="Contact" name='contact' id="contact" value="">
                                <div style="color:red;" id="contactError"></div>
                                <img src="view/Signup/assets/img/icons/mail.svg" alt="img">
                            </div>
                        </div>

                        <div class="form-login">
                            <label>Password</label>
                            <div class="pass-group">
                                <input class="pass-input" name='pass' required type="password" placeholder="Password" id="password" value="">
                            </div>
                        </div>

                        <div class="form-login">
                            <label>Confirm Password</label>
                            <div class="pass-group">
                                <input class="pass-input" name='cpass' required type="password" placeholder="Confirm Password" id="confirmPassword" value="">
                                <div class="error-message" style="color:red;" id="passwordError"></div>
                                <div class="error-message" style="color:red;" id="passwordMatchError"></div>
                            </div>
                        </div>

                        <div class="form-login">
                            <div class="form-check text-center">
                                <input type="checkbox" id="agreeTermsCheckbox" style="width: 16px; height: 16px; margin-right: 5px;" required>
                                <label for="agreeTermsCheckbox">
                                    <a href="#" id="termsLink" style="text-decoration: underline;">I agree to the Terms and Conditions</a>
                                </label>
                            </div>




                            <button class="btn btn-login" type="submit" id="submitButton" disabled>Create Account</button>
                            <div class="text-center" id="loadingSpinner"></div>
                        </div>
                    </form>

                    <div class="signinform text-center">
                        <h4>Already a user? <a href="login.php" class="hover-a">Sign In</a></h4>
                    </div>
                </div>
            </div>
            <div class="login-img">
                <div class="container">
                    <img src="../upload_system/<?=$db_system_banner?>" alt="">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Terms and Conditions -->
<div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>By creating an account, you agree to our Terms and Conditions...</p>
                <p><strong>Please agree to proceed:</strong></p>
                <input type="checkbox" id="agreeTermsCheckboxModal"> I agree to the Terms and Conditions
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="agreeButtonModal">Agree</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Show the modal when the Terms link is clicked
    $('#termsLink').click(function(e) {
        e.preventDefault();
        $('#termsModal').modal('show');
    });

    // Enable the "Create Account" button based on checkbox status
    $("#agreeTermsCheckbox").change(function() {
        $("#submitButton").prop("disabled", !this.checked);
    });

    // Handle agree button in the modal
    $('#agreeButtonModal').click(function() {
        $("#agreeTermsCheckbox").prop("checked", true);
        $("#submitButton").prop("disabled", false);
        $('#termsModal').modal('hide');
    });
});
</script>

</body>
</html>
