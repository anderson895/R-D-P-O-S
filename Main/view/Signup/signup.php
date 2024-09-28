
<head>
    

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            <!--<h4>Continue where you left off</h4>-->
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
                            <input type="checkbox" id="agreeTermsCheckbox" style="margin: 10px;" required>
                            <label for="agreeTermsCheckbox"><a style="text-decoration:underline;">I agree to the Terms and Conditions</a></label>
         </div>

            <button class="btn btn-login" type="submit" id="submitButton">Create Account</button>
            <div class="text-center" id="loadingSpinner"></div>
        </div>

       
        
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


<script src="view/Signup/assets/js/jquery-3.6.0.min.js"></script>

<script src="view/Signup/assets/js/feather.min.js"></script>

<script src="view/Signup/assets/js/bootstrap.bundle.min.js"></script>

<script src="view/Signup/assets/js/script.js"></script>


<!-- Modal for Terms and Conditions -->
<div id="termsModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Terms and Conditions</h2>
        <p>By creating an account, you agree to our Terms and Conditions...</p>
        <p><strong>Please agree to proceed:</strong></p>
        <input type="checkbox" id="agreeTermsCheckboxModal"> I agree to the Terms and Conditions
        <br><br>
        <button id="agreeButton">Agree</button>
    </div>
</div>
<script>
$(document).ready(function() {

    $("#submitButton").prop("disabled", !this.checked);
    // Show the modal when the "Create Account" button is clicked

    // Enable the "Create Account" button based on checkbox status
    $("#agreeTermsCheckbox").change(function() {
        $("#submitButton").prop("disabled", !this.checked);
    });

   
});
</script>




</body>
</html>