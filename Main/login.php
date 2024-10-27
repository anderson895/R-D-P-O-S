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
        <div class="login-wrapper">
            <div class="login-content">
                <div class="container" style="background-color:white; border-radius:15px;">
                    <div class="login-userset">
                        <form method="POST">
                            <div class="login-userheading mt-3">
                                <h3>Sign In</h3>
                            </div>

                            <!-- Username Field -->
                            <div class="form-login">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="username" placeholder="Enter username" name="email_or_username" required>
                                    <label for="username">Username</label>
                                </div>
                            </div>

                            <!-- Password Field -->
                            <div class="form-login">
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="password" placeholder="Enter your password" name="password" required>
                                    <label for="password">Password</label>
                                </div>
                            </div>

                            <div class="form-login">
                                <div class="alreadyuser">
                                    <h4><a href="forgetpassword.php" class="hover-a">Forgot Password?</a></h4>
                                </div>
                            </div>

                            <div class="form-login">
                                <button class="btn btn-login" type="submit" name="btnLogin">Sign In</button>
                            </div>
                        </form>

                        <div class="signinform text-center">
                            <h4>Don’t have an account? <a href="register.php" class="hover-a">Sign Up</a></h4>
                        </div>
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




        <script src="view/Signup/view/assets/js/jquery-3.6.0.min.js"></script>

        <script src="view/Signup/view/assets/js/feather.min.js"></script>

        <script src="view/Signup/view/assets/js/bootstrap.bundle.min.js"></script>

        <script src="view/Signup/view/assets/js/script.js"></script>
</body>




<!-- Footer -->




















</html>