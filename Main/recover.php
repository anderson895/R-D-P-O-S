<?php
include("../connection.php");
include("back_forgot.php");

include("controller/maintinance.php");
include("back_cunfirmForgot.php");

?>



    <body>
   
        <div class="body-wrapper" >
            <!-- Begin Header Area -->
            <?php include "include/header.php"; ?>



<link rel="stylesheet" href="../administrator/admin_view/assets/css/bootstrap.min.css">

<link rel="stylesheet" href="../administrator/admin_view/assets/plugins/fontawesome/css/fontawesome.min.css">

<link rel="stylesheet" href="view/Signup/assets/css/style.css">

<body class="account-page">

<div class="main-wrapper">
<div class="account-content">
<div class="login-wrapper">
<div class="login-content">

<div class="container" style="background-color:white; border-radius:15px;"> 
<div class="login-userset ">
<div class="login-logo">

</div>


<div class="login-userheading">
<h3>Create new password</h3>

</div>
<form method="POST">

<div class="form-login">
<div class="form-addons">
                                <div class="form-floating mb-3">
                                    <input type="password" id="newpsw" name="newpsw" class="form-control" placeholder="Enter your new password">
                                    <label for="newpsw">New password</label>
                                    <span class="error text-danger d-block"><?=$newpswErr?></span>
                                </div>
<span class="error text-danger d-block"><?=$newpswErr?></span>
</div>
</div>




<div class="form-login">
<div class="form-addons">
                                <div class="form-floating mb-3">
                                    <input type="password" id="cunfirm_newpsw" name="cunfirm_newpsw" class="form-control" placeholder="Confirm new password">
                                    <label for="cunfirm_newpsw">Confirm new password</label>
                                    <span class="error text-danger d-block"><?=$cunfirm_newpswErr?></span>
                                </div>
<span class="error text-danger d-block"><?=$cunfirm_newpswErr?></span>

</div>
</div>



<div class="text-center" id="loadingSpinner"></div>
<div class="form-login">
<button type="submit" class="btn btn-login"name="btnNewPassword">Submit</button>
</div>
</div>

</form>
</div>
</div>
<div class="login-img">
<img src="../upload_system/<?php echo $db_system_banner  ?>" alt="img">
</div>
</div>
</div>
</div>


</body>

































<script src="../administrator/admin_view/assets/js/jquery-3.6.0.min.js"></script>

<script src="../administrator/admin_view/assets/js/feather.min.js"></script>

<script src="../administrator/admin_view/assets/js/bootstrap.bundle.min.js"></script>

<script src="../administrator/admin_view/assets/js/script.js"></script>



<script src="../administrator/admin_view/assets/js/jquery.slimscroll.min.js"></script>

<script src="../administrator/admin_view/assets/plugins/alertify/alertify.min.js"></script>