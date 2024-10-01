<?php

include("controller/maintinance.php");


include "include/session_dir.php";

$current_date = date('Y-m-d');


?>

<link rel="stylesheet" href="view/Signup/assets/css/bootstrap.min.css">
<link rel="stylesheet" href="view/Signup/assets/css/style.css">

    <body>
 
        <!-- Begin Body Wrapper -->
        <div class="body-wrapper" >
            <!-- Begin Header Area -->
            <?php 
            
            include "include/header.php";
        
        ?>



















          


<!-- 
<?php
include "view/Signup/signup.php";
?>
 -->































          
            <!-- Quick View | Modal Area End Here -->
        </div>
        
        <!-- Body Wrapper End Here -->
        <!-- jQuery-V1.12.4 -->
        <script src="js/vendor/jquery-1.12.4.min.js"></script>
        <!-- Popper js -->
        <script src="js/vendor/popper.min.js"></script>
        <!-- Bootstrap V4.1.3 Fremwork js -->
        <script src="js/bootstrap.min.js"></script>
        <!-- Ajax Mail js -->
        <script src="js/ajax-mail.js"></script>
        <!-- Meanmenu js -->
        <script src="js/jquery.meanmenu.min.js"></script>
        <!-- Wow.min js -->
        <script src="js/wow.min.js"></script>
        <!-- Slick Carousel js -->
        <script src="js/slick.min.js"></script>
        <!-- Owl Carousel-2 js -->
        <script src="js/owl.carousel.min.js"></script>
        <!-- Magnific popup js -->
        <script src="js/jquery.magnific-popup.min.js"></script>
        <!-- Isotope js -->
        <script src="js/isotope.pkgd.min.js"></script>
        <!-- Imagesloaded js -->
        <script src="js/imagesloaded.pkgd.min.js"></script>
        <!-- Mixitup js -->
        <script src="js/jquery.mixitup.min.js"></script>
        <!-- Countdown -->
        <script src="js/jquery.countdown.min.js"></script>
        <!-- Counterup -->
        <script src="js/jquery.counterup.min.js"></script>
        <!-- Waypoints -->
        <script src="js/waypoints.min.js"></script>
        <!-- Barrating -->
        <script src="js/jquery.barrating.min.js"></script>
        <!-- Jquery-ui -->
        <script src="js/jquery-ui.min.js"></script>
        <!-- Venobox -->
        <script src="js/venobox.min.js"></script>
        <!-- Nice Select js -->
        <script src="js/jquery.nice-select.min.js"></script>
        <!-- ScrollUp js -->
        <script src="js/scrollUp.min.js"></script>
        <!-- Main/Activator js -->
        <script src="js/main.js"></script>







        <script src="../administrator/admin_view/assets/plugins/alertify/alertify.min.js"></script>
        <script src='controller/javascript/searchAjax.js'></script>

<script src='view/view/js/function.js'></script>



<!-- <script src="assets/javascript/registerLen_validation.js"></script> -->
<!-- <script src="assets/javascript/password_creation.js"></script> -->
<script src="assets/javascript/email_validation.js"></script>

<script>
$(document).ready(function() {
    const fnameInput = $('input[name="fname"]');
    const lnameInput = $('input[name="lname"]');
    const usernameInput = $('#username');
    const passwordInput = $('#password');
    const contactInput = $('input[name="contact"]');
    const birthdateInput = $('input[name="bday"]');
    const emailInput = $('#email');
    const confirmPasswordInput = $('#confirmPassword');
    const submitButton = $('#submitButton');

    // Function to validate first name and last name
    function validateName(name) {
    var nameRegex = /^[a-zA-ZñÑ\s]{2,}$/;
    return nameRegex.test(name);
}


    // Function to validate username and password length
    function validateLength(value) {
        return value.length >= 5;
    }

    // Function to validate contact number
    function validateContact(contact) {
        return /^[0-9]{11}$/.test(contact) && contact.startsWith('09');
    }

    // Function to validate the birthdate (valid date and at least 18 years old)
    function validateAge(birthdate) {
    const birthdateDate = new Date(birthdate);
    const currentDate = new Date();

    // Check if the birthdate is a valid date
    const [year, month, day] = birthdate.split('-');
    const validDate = birthdateDate.getFullYear() == year && birthdateDate.getMonth() + 1 == month && birthdateDate.getDate() == day;

    // Check if the year is reasonable (e.g., greater than 1900)
    const yearIsValid = birthdateDate.getFullYear() > 1900 && birthdateDate.getFullYear() <= currentDate.getFullYear();

    if (!validDate || isNaN(birthdateDate.getTime()) || !yearIsValid) {
        return false;
    }

    const age = currentDate.getFullYear() - birthdateDate.getFullYear();
    const monthDiff = currentDate.getMonth() - birthdateDate.getMonth();
    const dayDiff = currentDate.getDate() - birthdateDate.getDate();

    // Check if the person is 18 years or older
    if (age > 18 || (age === 18 && (monthDiff > 0 || (monthDiff === 0 && dayDiff >= 0)))) {
        return true;
    }

    return false;
}


    // Function to validate email address
    function validateEmail(email) {
        const emailRegex = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;
        return emailRegex.test(email);
    }

    // Function to set invalid styling
    function setStyleInvalid(element) {
        element.css('border', '2px solid red');
    }

    // Function to reset styles
    function resetStyles(element) {
        element.css('border', '1px solid #ccc');
    }

    // Real-time validation on input events
    fnameInput.on('input', function () {
        if (validateName($(this).val())) {
            $('#fnameError').text('');
            resetStyles(fnameInput);
        } else {
            $('#fnameError').text('First name must have at least 2 alphabetical characters.');
            setStyleInvalid(fnameInput);
        }
    });

    lnameInput.on('input', function () {
        if (validateName($(this).val())) {
            $('#lnameError').text('');
            resetStyles(lnameInput);
        } else {
            $('#lnameError').text('Last name must have at least 2 alphabetical characters.');
            setStyleInvalid(lnameInput);
        }
    });

    usernameInput.on('input', function () {
        if (validateLength($(this).val())) {
            $('#usernameLengthError').text('');
            resetStyles(usernameInput);
        } else {
            $('#usernameLengthError').text('Username must have at least 5 characters.');
            setStyleInvalid(usernameInput);
        }
    });

    passwordInput.on('input', function () {
        if ($(this).val().length >= 12) {
            $('#passwordError').text('');
            resetStyles(passwordInput);
        } else {
            $('#passwordError').text('Password must have at least 12 characters.');
            setStyleInvalid(passwordInput);
        }
    });

    contactInput.on('input', function () {
        if (validateContact($(this).val())) {
            $('#contactError').text('');
            resetStyles(contactInput);
        } else {
            $('#contactError').text('Contact must be 11 digits and start with "09".');
            setStyleInvalid(contactInput);
        }
    });

    birthdateInput.on('input', function () {
        if (validateAge($(this).val())) {
            $('#birthdateError').text('');
            resetStyles(birthdateInput);
        } else {
            $('#birthdateError').text('Invalid date or Age must be at least 18 years old.');
            setStyleInvalid(birthdateInput);
        }
    });

    emailInput.on('input', function () {
        if (validateEmail($(this).val())) {
            $('#emailError').text('');
            resetStyles(emailInput);
        } else {
            $('#emailError').text('Invalid Gmail address.');
            setStyleInvalid(emailInput);
        }
    });

    confirmPasswordInput.on('input', function () {
        if (passwordInput.val() === $(this).val()) {
            $('#passwordMatchError').text('');
            resetStyles(confirmPasswordInput);
            resetStyles(passwordInput);
        } else {
            $('#passwordMatchError').text('Passwords do not match.');
            setStyleInvalid(confirmPasswordInput);
            setStyleInvalid(passwordInput);
        }
    });

    // Function to handle form submission
    function handleSubmit(event) {
        event.preventDefault(); // Prevent the default form submission

        // Reset any previous error messages and styling
        $('.error').text('');
        resetStyles($('input'));

        let hasError = false;

        // Validate inputs before submission
        if (!validateName(fnameInput.val())) {
            $('#fnameError').text('First name must have at least 2 alphabetical characters.');
            setStyleInvalid(fnameInput);
            hasError = true;
        }

        if (!validateName(lnameInput.val())) {
            $('#lnameError').text('Last name must have at least 2 alphabetical characters.');
            setStyleInvalid(lnameInput);
            hasError = true;
        }

        if (!validateLength(usernameInput.val())) {
            $('#usernameLengthError').text('Username must have at least 5 characters.');
            setStyleInvalid(usernameInput);
            hasError = true;
        }

        if (passwordInput.val().length < 12) {
            $('#passwordError').text('Password must have at least 12 characters.');
            setStyleInvalid(passwordInput);
            hasError = true;
        }

        if (!validateContact(contactInput.val())) {
            $('#contactError').text('Contact must be 11 digits and start with "09".');
            setStyleInvalid(contactInput);
            hasError = true;
        }

        if (!validateAge(birthdateInput.val())) {
            $('#birthdateError').text('Invalid date or Age must be at least 18 years old.');
            setStyleInvalid(birthdateInput);
            hasError = true;
        }

        if (passwordInput.val() !== confirmPasswordInput.val()) {
            $('#passwordMatchError').text('Passwords do not match.');
            setStyleInvalid(passwordInput);
            setStyleInvalid(confirmPasswordInput);
            hasError = true;
        }

        if (!validateEmail(emailInput.val())) {
            $('#emailError').text('Invalid Gmail address.');
            setStyleInvalid(emailInput);
            hasError = true;
        }

        // If there are errors, prevent form submission
        if (hasError) {
            alertify.error("Please correct the errors in the form.");
            return;
        }

        // Gather the data from the form
        const formData = {
            fname: fnameInput.val(),
            lname: lnameInput.val(),
            bday: birthdateInput.val(),
            username: usernameInput.val(),
            email: emailInput.val(),
            contact: contactInput.val(),
            password: passwordInput.val(),
            cpass: confirmPasswordInput.val(),
        };

        // Perform an Ajax POST request to your PHP script
        $.ajax({
            type: "POST",
            url: "controller/register/back_register.php",
            data: formData,
            success: function(response) {
                var result = response.response;
                var last_id = response.last_id;

                if (result === "success") {
                    $.ajax({
                        type: "POST",
                        url: "../mailer.php",
                        data: { db_acc_id: last_id },
                        beforeSend: function() {
                            $("#loadingSpinner").html('<div class="spinner-border text-warning" role="status"><span class="sr-only"></span></div>').show();
                            $("#submitButton").hide();
                        },
                        success: function(response) {
                            alertify.success("Otp successfully sent to " + emailInput.val());
                            setTimeout(function() {
                                window.location.href = "verification_code.php?accid=" + last_id;
                            }, 1000);
                        },
                        error: function(xhr, status, error) {
                            $("#loadingSpinner").hide();
                            $("#submitButton").show();
                            alertify.error("Error in sending OTP: " + error);
                        },
                        complete: function() {
                            $("#loadingSpinner").hide();
                        }
                    });
                } else {
                    alertify.error(result);
                }
            },
            error: function(xhr, status, error) {
                console.error("Submission error: " + error);
            }
        });
    }

    // Add event listener for form submission
    submitButton.on('click', handleSubmit);
});
</script>



</body>
</html>
<!---
<script src='controller/register/js/address_api.js'></script>

<script src="controller/register/js/validation.js"></script> --->

