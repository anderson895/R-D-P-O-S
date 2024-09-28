<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Create Account</title>
    <style>
        /* Styles for the modal */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body class="account-page">

<div class="main-wrapper">
    <div class="account-content">
        <div class="login-wrapper">
            <div class="login-content">
                <div class="login-userset">
                    <form method="POST" id="accountForm">
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
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-login">
                                    <label>Last Name</label>
                                    <div class="form-addons">
                                        <input type="text" placeholder="Enter your last name" name='lname' id="lname" value="">
                                        <div style="color:red;" id="lnameError"></div>
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
                            </div>
                        </div>

                        <div class="form-login">
                            <label>Email</label>
                            <div class="form-addons">
                                <input required type="email" placeholder="Email" name='email' id="email" value="">
                                <div style="color:red;" id="emailError"></div>
                            </div>
                        </div>

                        <div class="form-login">
                            <label>Contact Number</label>
                            <div class="form-addons">
                                <input required type="number" placeholder="Contact" name='contact' id="contact" value="">
                                <div style="color:red;" id="contactError"></div>
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

                          <!-- Checkbox for Terms and Conditions -->
                        <div class="form-check text-center">
                            <input type="checkbox" id="agreeTermsCheckbox" style="margin: 10px;" required>
                            <label for="agreeTermsCheckbox">I agree to the Terms and Conditions</label>
                        </div>

                        <div class="form-login">
                            <button type="button" class="btn btn-login" id="termsButton">Create Account</button>
                            <div class="text-center" id="loadingSpinner"></div>
                        </div>

                        <input type="checkbox" id="agreeTerms" style="display:none;">
                    </form>

                    <div class="signinform text-center">
                        <h4>Already a user? <a href="login.php" class="hover-a">Sign In</a></h4>
                    </div>

                    <div class="form-sociallink">
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
<div id="termsModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Terms and Conditions</h2>
        <p>By creating an account, you agree to our Terms and Conditions...</p>
        <p><strong>Please agree to proceed:</strong></p>
        <input type="checkbox" id="agreeTermsCheckbox"> I agree to the Terms and Conditions
        <br><br>
        <button id="agreeButton">Agree</button>
    </div>
</div>

<script>
 $("#agreeButton").click(function() {
        if ($("#agreeTermsCheckbox").is(":checked")) {
            $("#agreeTerms").prop("checked", true);
            $("#submitButton").prop("disabled", false); // Enable the submit button
            $("#termsModal").css("display", "none");
            alert("You have agreed to the Terms and Conditions.");
        } else {
            alert("Please agree to the Terms and Conditions to proceed.");
        }
    });

$(document).ready(function() {
    // Show the modal when the button is clicked
    $("#termsButton").click(function() {
        $("#termsModal").css("display", "block");
    });

    // When the user clicks on <span> (x), close the modal
    $(".close").click(function() {
        $("#termsModal").css("display", "none");
    });

    // When the user clicks the "Agree" button
    $("#agreeButton").click(function() {
        if ($("#agreeTermsCheckbox").is(":checked")) {
            $("#agreeTerms").prop("checked", true);
            $("#submitButton").prop("disabled", false); // Enable the submit button
            $("#termsModal").css("display", "none");
            alert("You have agreed to the Terms and Conditions.");
        } else {
            alert("Please agree to the Terms and Conditions to proceed.");
        }
    });

    // Initially disable the submit button
    $("#submitButton").prop("disabled", true);
});
</script>

</body>
</html>
