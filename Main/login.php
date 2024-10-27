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