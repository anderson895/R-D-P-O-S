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
      

       

        <div class="main-wrapper" style="background-color:#F7F7F7; ">
            <div class="account-content">
            <div class="login-wrapper d-flex align-items-center justify-content-center vh-100">
    <div class="login-content">
        <div class="container p-4" style="background-color: white; border-radius: 15px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
            <div class="text-center mb-4">
                <h3 class="mb-3">Sign In</h3>
            </div>

            <form method="POST">
                 <!-- Username Field -->
                            <div class="form-login">
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control" id="username" placeholder="Enter username" name="email_or_username" required>
                                    <label for="username">Username</label>
                                </div>
                            </div>

                            <!-- Password Field -->
                            <div class="form-login">
                                <div class="form-floating mb-4">
                                    <input type="password" class="form-control" id="password" placeholder="Enter your password" name="password" required>
                                    <label for="password">Password</label>
                                </div>
                            </div>

                            <!-- Forgot Password Link -->
                            <div class="form-login mb-3 text-end">
                                    <a href="forgetpassword.php" class="text-decoration-none text-primary">Forgot Password?</a>
                            </div>

                            <!-- Submit Button -->
                            <div class="form-login mb-4">
                                <button class="btn btn-login w-100 fw-bold py-2" type="submit" name="btnLogin">Sign In</button>
                            </div>
            </form>

            <div class="text-center">
                <h6>Don’t have an account? <a href="register.php" class="text-decoration-none">Sign Up</a></h6>
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