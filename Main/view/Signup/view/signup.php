<?php

include("../controller/general/maintinance.php");
include "../controller/general/session_dir.php";
include "../controller/signup/back_register.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<meta name="description" content="POS - Bootstrap Admin Template">
<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
<meta name="author" content="Dreamguys - Bootstrap Admin Template">
<meta name="robots" content="noindex, nofollow">
<title>Login</title>

<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.jpg">

<link rel="stylesheet" href="assets/css/bootstrap.min.css">

<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

<link rel="stylesheet" href="assets/css/style.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="account-page">

<div class="main-wrapper">
<div class="account-content">
<div class="login-wrapper">
<div class="login-content">
<div class="login-userset">
<div class="login-logo">
<img src="assets/img/logo.png" alt="img">
</div>
<form action="address_form.php" method="GET">
<div class="login-userheading">
<h3>Create an Account</h3>
<h4>Continue where you left off</h4>
</div>
<div class="form-login">
<label>First Name</label>
<div class="form-addons">
<input type="text" placeholder="Enter your first name" name="fname">
<div style="color:red;" id="fnameError"></div>
<img src="assets/img/icons/users1.svg" alt="img">
</div>
</div>
<div class="form-login">
<label>Last Name</label>
<div class="form-addons">
<input type="text" placeholder="Enter your last name" name="lname">
<div style="color:red;" id="lnameError"></div>
<img src="assets/img/icons/users1.svg" alt="img">
</div>
</div>

<div class="form-login">
<label for="birthdate" >Birthday</label>
<div class="form-addons">
<input name="bday" value="<?php echo $current_date; ?>" required type="date" id="birthdate" min="<?php echo $max_birthdate; ?>" max="<?php echo $min_birthdate; ?>">
<img src="assets/img/icons/mail.svg" alt="img">
</div>
</div>

<div class="form-login">
<label>Username</label>
<div class="form-addons">
<input required type="text" placeholder="Username" name="username" id="username">
<div  style="color:red;" id="usernameLengthError"></div>
<div style="color:red;" id="usernameError"></div>
<img src="assets/img/icons/mail.svg" alt="img">
</div>
</div>

<div class="form-login">
<label>Email</label>
<div class="form-addons">
<input required type="email" placeholder="Gmail" name="email" id="email">
<div style="color:red;" id="emailError"></div>
<img src="assets/img/icons/mail.svg" alt="img">
</div>
</div>

<div class="form-login">
<label>Contact</label>
<div class="form-addons">
<input required type="text" pattern="[0-9]{11}" placeholder="Contact" name="contact" title="Please input 11 digit number">
<img src="assets/img/icons/mail.svg" alt="img">
</div>
</div>

<div class="form-login">
<label>Password</label>
<div class="pass-group">
<input class="pass-input" name="pass" required type="password" placeholder="Password" id="password">
<span class="fas toggle-password fa-eye-slash"></span>
</div>
</div>
<div class="form-login">
<label>Cunfirm Password</label>
<div class="pass-group">
<input class="pass-input" name="cpass" required type="password" placeholder="Confirm Password" id="confirmPassword">
<span class="fas toggle-password fa-eye-slash"></span>
</div>
</div>

<div class="form-login">
<button class="btn btn-login" type="submit" id="submitButton">NEXT</button>
</div>
<div class="error-message"  style="color:red;" id="passwordError"></div>
<div class="error-message" id="errorText"></div>
</form>

<div class="signinform text-center">
<h4>Already a user? <a href="../signin.php" class="hover-a">Sign In</a></h4>
</div>
<div class="form-setlogin">
<h4>Or sign up with</h4>
</div>
<div class="form-sociallink">
<ul>
<li>
<a href="javascript:void(0);">
<img src="assets/img/icons/google.png" class="me-2" alt="google">
Sign Up using Google
</a>
</li>
<li>
 <a href="javascript:void(0);">
<img src="assets/img/icons/facebook.png" class="me-2" alt="google">
Sign Up using Facebook
</a>
</li>
</ul>
</div>
</div>
</div>
<div class="login-img">
<img src="assets/img/login.jpg" alt="img">
</div>
</div>
</div>
</div>


<script src="assets/js/jquery-3.6.0.min.js"></script>

<script src="assets/js/feather.min.js"></script>

<script src="assets/js/bootstrap.bundle.min.js"></script>

<script src="assets/js/script.js"></script>


<!---start script block--->
<script src="assets/rdpos_js/registerLen_validation.js"></script>
<script src="assets/rdpos_js/password_creation.js"></script>
<script src="assets/rdpos_js/email_validation.js"></script>
<!---end script block--->

</body>
</html>