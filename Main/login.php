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
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="username" placeholder="Enter username" name="email_or_username" required>
                    <label for="username">Username</label>
                </div>

                <!-- Password Field -->
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="password" placeholder="Enter your password" name="password" required>
                    <label for="password">Password</label>
                </div>

                <div class="mb-3 text-end">
                    <a href="forgetpassword.php" class="text-decoration-none">Forgot Password?</a>
                </div>

                <div class="mb-4">
                    <button class="btn btn-login" type="submit" name="btnLogin">Sign In</button>
                </div>
            </form>

            <div class="text-center">
                <h6>Don’t have an account? <a href="register.php" class="text-decoration-none">Sign Up</a></h6>
            </div>
        </div>
    </div>
    <div class="login-img d-none d-md-block">
        <img src="../upload_system/<?=$db_system_banner?>" alt="Login Image" class="img-fluid" style="max-height: 100vh; object-fit: cover;">
    </div>
</div>

            </div>
        </div>




        <script src="view/Signup/view/assets/js/jquery-3.6.0.min.js"></script>

        <script src="view/Signup/view/assets/js/feather.min.js"></script>

        <script src="view/Signup/view/assets/js/bootstrap.bundle.min.js"></script>

        <script src="view/Signup/view/assets/js/script.js"></script>
</body>




<!-- Footer -->




















</html>