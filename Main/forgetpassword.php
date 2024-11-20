<?php
include("back_login.php");


include("controller/maintinance.php");


//include "back_forgot.php";


include "include/session_dir.php";

$current_date = date('Y-m-d');

?>











<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<meta name="description" content="POS - Bootstrap Admin Template">
<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
<meta name="author" content="Dreamguys - Bootstrap Admin Template">
<meta name="robots" content="noindex, nofollow">
<title><?php echo htmlspecialchars($db_system_name); ?></title>

<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.jpg">

<link rel="stylesheet" href="../administrator/admin_view/assets/css/bootstrap.min.css">

<link rel="stylesheet" href="../administrator/admin_view/assets/plugins/fontawesome/css/fontawesome.min.css">

<link rel="stylesheet" href="view/Signup/assets/css/style.css">


<body>
   
   <div class="body-wrapper" >
   <?php 
       // include "view/navigation.php";
       include "include/header.php";
   
   ?>
<div class="main-wrapper">
<div class="account-content py-5 bg-light">
    <div class="login-wrapper d-flex justify-content-center align-items-start min-vh-100 pt-4"> <!-- Changed align-items-center to align-items-start and added pt-4 to move the content higher -->
        <div class="login-content">
            <div class="container bg-white p-4 rounded-4 shadow-sm">
                <div class="login-userset">
                    <!-- Optional Logo Section -->

                    <!-- User Heading -->
                    <div class="login-userheading text-center mb-4">
                        <h3 class="fw-bold">Forgot Password?</h3>
                        <p class="text-muted">Please enter the email address associated with your account.</p>
                    </div>

                    <!-- Email Field -->
                    <div class="form-login">
                        <div class="form-floating mb-3">
                            <input 
                                type="email" 
                                class="form-control" 
                                id="email" 
                                placeholder="Enter your email address" 
                                required>
                            <label for="email" class="text-secondary">
                                <i class="bi bi-envelope me-2"></i>Email address
                            </label>
                        </div>
                    </div>

                    <!-- Loading Spinner -->
                    <div class="text-center my-3" id="loadingSpinner">
                        <!-- Spinner will appear dynamically -->
                    </div>

                    <!-- Submit Button -->
                    <div class="form-login">
                        <button class="btn btn-primary w-100 fw-bold py-2" id="btnForgotPass">Submit</button> <!-- Used btn-primary for consistent button style -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</div>








</body>
</html>


<script src="../administrator/admin_view/assets/js/jquery-3.6.0.min.js"></script>

<script src="../administrator/admin_view/assets/js/feather.min.js"></script>

<script src="../administrator/admin_view/assets/js/bootstrap.bundle.min.js"></script>

<script src="../administrator/admin_view/assets/js/script.js"></script>



<script src="../administrator/admin_view/assets/js/jquery.slimscroll.min.js"></script>

<script src="../administrator/admin_view/assets/plugins/alertify/alertify.min.js"></script>

<script>
$(document).ready(function() {
    $("#btnForgotPass").on("click", function() {
        var email = $("#email").val(); // Get the email entered by the user

        // Email format validation using a regular expression
        var gmailRegex = /@gmail\.com$/;
        if (!gmailRegex.test(email)) {
            // Alert the user or perform error handling if the email format is incorrect
            alertify.error("Please enter a valid Gmail address (example@gmail.com).");
            return; // Stop further execution if email format is incorrect
        }

        // If the email format is correct, proceed with the AJAX request
        $.ajax({
            type: "POST",
            url: "back_forgot.php", // Your PHP file to handle the email
            data: { email: email }, // Send the email as a POST parameter

            success: function(response) {

                var response = JSON.parse(response);

                var result = response.result;
                var db_acc_id=response.db_acc_id;
                var remaining=response.remaining;

               
                console.log(response); 
             
                if (result == "Email is not registered!") {
                    alertify.error("Email is not registered!");
                } else if (result == "Email is required!") {
                    alertify.error("Email is required!");
                } else if(result=="waiting"){
                         alertify.error(remaining);
                }else{
                    $("#btnForgotPass").css("display", "none");

                    $.ajax({
                    type: "POST",
                    url: "../forgetmailer.php", // Your PHP file to handle the email
                    data: { db_acc_id: db_acc_id }, // Send the email as a POST parameter

                    beforeSend: function() {
                                $("#loadingSpinner").html('<div class="spinner-border text-warning" role="status"><span class="sr-only">Loading...</span></div>').show();
                            },


                    success: function(response) {
                        
                       console.log("forgetmailer response");
                       alertify.success("Otp sent successful ");
                    },
                    error: function(xhr, status, error) {
                        // Handle errors in the AJAX request
                        console.error(error);
                    },
                    complete: function() {

                      

                    $("#loadingSpinner").hide();
                    $("#btnForgotPass").css("display", "block");
                               setTimeout(function() {
                               window.location.href = "cunfirmforgot.php?accid=" + db_acc_id;
                                }, 1000); // 1000 milliseconds (1 second)

                    }
                                        
                });







                }
            },
            error: function(xhr, status, error) {
                // Handle errors in the AJAX request
                console.error(error);
            }
        });
    });
});
</script>