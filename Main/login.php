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
                                    <div class="login-userheading">
                                        <h3>Sign In</h3>
                                    </div>
                                    <div class="form-login">
                                        <label>Email</label>
                                        <div class="form-addons">
                                            <input type="text" placeholder="Enter your email or username" name="email_or_username">

                                        </div>
                                    </div>
                                    <div class="form-login">
                                        <label>Password</label>
                                        <div class="pass-group">
                                            <input type="password" class="pass-input" placeholder="Enter your password" name="password">

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
                            <div class="map-frame">
                                <div class="map-container">
                                    <iframe 
                                    class="google-map"
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3855.080174251401!2d120.958328!3d14.8170211!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397ad2815babb8d%3A0x866d22682ef13094!2sR.+De+Leon+Poultry+Supply!5e0!3m2!1sen!2sph!4v1695382058287!5m2!1sen!2sph" 
                                    allowfullscreen="" 
                                    loading="lazy"></iframe>
                                </div>
                            </div>
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