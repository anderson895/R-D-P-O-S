<?php
include("back_login.php");




include("controller/maintinance.php");


include "include/session_dir.php";


$current_date = date('Y-m-d');

?>



<!doctype html>
<html class="no-js" lang="zxx">

<!-- index-431:41-->

<link rel="stylesheet" href="view/Signup/view/assets/css/bootstrap.min.css">

<link rel="stylesheet" href="view/Signup/view/assets/plugins/fontawesome/css/fontawesome.min.css">

<link rel="stylesheet" href="view/Signup/view/assets/css/style.css">


<body>

    <div class="body-wrapper">
        <?php 
            include "include/header.php";
        
        ?>
      

       

      <div class="main-wrapper" style="background-color:#F7F7F7; min-height: 100vh; display: flex; align-items: center; justify-content: center;">
    <div class="account-content container">
        <div class="row align-items-center justify-content-center">
            <!-- Banner Image (hidden on small screens) -->
            <div class="col-md-6 d-none d-md-block position-relative top-0 end-0 h-100 w-50" style="background-image: url('../upload_system/<?=$db_system_banner?>'); background-size: cover; background-position: center;">
            </div>

            <!-- Login Form -->
            <div class="col-md-5 offset-md-6">
                <div class="login-content p-4 shadow-lg" style="background-color: white; border-radius: 15px; max-width: 400px;">
                    <div class="login-userset text-center">
                        <form method="POST">
                            <!-- Login Heading -->
                            <div class="login-userheading mt-3 mb-4">
                                <h3 class="fw-bold">Sign In</h3>
                                <p class="text-muted">Welcome back! Please enter your details.</p>
                            </div>

                            <!-- Username Field -->
                            <div class="form-login">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="username" placeholder="Enter username" name="email_or_username" required>
                                    <label for="username"><i class="bi bi-person-circle me-2"></i>Username</label>
                                </div>
                            </div>

                            <!-- Password Field -->
                            <div class="form-login">
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="password" placeholder="Enter your password" name="password" required>
                                    <label for="password"><i class="bi bi-lock me-2"></i>Password</label>
                                </div>
                            </div>

                            <!-- Forgot Password Link -->
                            <div class="form-login mb-3 text-end">
                                <a href="forgetpassword.php" class="text-decoration-none text-primary">Forgot Password?</a>
                            </div>

                            <!-- Submit Button -->
                            <div class="form-login mb-4">
                                <button class="btn btn-primary w-100 fw-bold py-2" type="submit" name="btnLogin">Sign In</button>
                            </div>
                        </form>

                        <!-- Signup Link -->
                        <div class="signinform text-center">
                            <p class="text-muted">Don’t have an account? <a href="register.php" class="text-decoration-none text-primary">Sign Up</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Icons CDN (optional for icons) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">




        <script src="view/Signup/view/assets/js/jquery-3.6.0.min.js"></script>

        <script src="view/Signup/view/assets/js/feather.min.js"></script>

        <script src="view/Signup/view/assets/js/bootstrap.bundle.min.js"></script>

        <script src="view/Signup/view/assets/js/script.js"></script>
</body>




<!-- Footer -->




















</html>