<?php
include("back_login.php");
include("controller/maintinance.php");
include "include/session_dir.php";
$current_date = date('Y-m-d');
?>
<!doctype html>
<html lang="zxx">
<head>
    <link rel="stylesheet" href="view/Signup/view/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="view/Signup/view/assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="view/Signup/view/assets/css/style.css">
    <style>
        .login-img img {
            max-width: 100%;
            height: auto;
            border-radius: 15px;
        }
        .btn-login {
            background-color: #007bff; /* Bootstrap primary color */
            color: white;
        }
        .btn-login:hover {
            background-color: #0056b3; /* Darker shade for hover */
        }
        .body-wrapper {
            padding: 50px 0; /* Add some padding for better spacing */
        }
    </style>
</head>
<body>
    <div class="body-wrapper">
        <?php include "include/header.php"; ?>

        <div class="main-wrapper" style="background-color:#F7F7F7;">
            <div class="account-content">
                <div class="login-wrapper">
                    <div class="login-content">
                        <div class="container p-4" style="background-color:white; border-radius:15px;">
                            <div class="login-userset">
                                <form method="POST">
                                    <div class="login-userheading text-center mb-4">
                                        <h3>Sign In</h3>
                                    </div>

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

                                    <div class="form-login mb-3 text-end">
                                        <a href="forgetpassword.php" class="hover-a">Forgot Password?</a>
                                    </div>

                                    <div class="form-login mb-3">
                                        <button class="btn btn-login w-100" type="submit" name="btnLogin">Sign In</button>
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
                            <img src="../upload_system/<?=$db_system_banner?>" alt="Banner Image" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="view/Signup/view/assets/js/jquery-3.6.0.min.js"></script>
        <script src="view/Signup/view/assets/js/feather.min.js"></script>
        <script src="view/Signup/view/assets/js/bootstrap.bundle.min.js"></script>
        <script src="view/Signup/view/assets/js/script.js"></script>
    </div>
</body>
</html>
