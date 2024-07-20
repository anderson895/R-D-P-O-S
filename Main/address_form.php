<?php
//include "controller/register/back_register.php";

if(empty($_POST)){
    header("Location: register.php");
    exit; // or die; to stop script execution
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register-Customer</title>
    <link rel="icon" href="assets/images/logos.png" type="image/x-icon">
    
   <!--- <link rel="stylesheet" href="assets/css/address_form.css">--->

    
    <link rel="stylesheet" href="view/Signup/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="view/Signup/assets/css/style.css">

    
<link rel="stylesheet" href="css/material-design-iconic-font.min.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/fontawesome-stars.css">
<link rel="stylesheet" href="css/meanmenu.css">
<link rel="stylesheet" href="css/owl.carousel.min.css">
<link rel="stylesheet" href="css/slick.css">
<link rel="stylesheet" href="css/animate.css">
<link rel="stylesheet" href="css/jquery-ui.min.css">
<link rel="stylesheet" href="css/venobox.css">
<link rel="stylesheet" href="css/nice-select.css">
<link rel="stylesheet" href="css/magnific-popup.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">


<link rel="stylesheet" href="../administrator/admin_view/assets/plugins/alertify/alertify.min.css">
<link rel="stylesheet" href="view/Signup/assets/css/style.css">

<link rel="stylesheet" href="../administrator/admin_view/assets/plugins/scrollbar/scroll.min.css">

</head>
<style>
    a {
        text-decoration: none;
    }
</style>


<body>
<?php 
include("controller/maintinance.php");
?>



<div class="body-wrapper" >
           
              <?php include "view/navigation.php"; ?>




<body class="account-page">

<div class="main-wrapper" style="background-color:#F7F7F7;">
<div class="account-content">
<div class="login-wrapper">
<div class="login-content">

<div class="container" style="background-color:white; border-radius:15px;"> 

<div class="login-userset">


<div class="div-main">
    <div class="div-login">
        <form method="POST">
            <div>
                <input type="hidden" name="fname" value="<?php echo $_POST['fname'];?>">
                <input type="hidden" name="lname" value="<?php echo $_POST['lname'];?>">
                <input type="hidden" name="bday" value="<?php echo $_POST['bday'];?>">
                <input type="hidden" name="username" value="<?php echo $_POST['username'];?>">
                <input type="hidden" id="email" name="email" value="<?php echo $_POST['email'];?>">
                <input type="hidden" name="contact" value="<?php echo $_POST['contact'];?>">
                <input type="hidden" name="password" value="<?php echo $_POST['pass'];?>">
                <input type="hidden" name="cpass" value="<?php echo $_POST['cpass'];?>">
            </div>
            <br><br><br>
            <div class="container">
                <div class="login-userheading">
                    <h2>Address Information</h2>
                </div>
            </div>

                
            
            <div class="container">
                
                <!-- region -->
                <div class="input-container">
                    <div class="div1">
                        <label for="region">Region</label>
                    </div>

                    <div class="div2">
                        <select name="region" id="region">
                            <!-- insert api response here -->
                            <option value="">Select Region</option>
                        </select>
                    </div>
                </div>

                <!-- Province -->
                <div class="input-container">
                    <div class="div1">
                        <label for="province">Province</label>
                    </div>

                    <div class="div2">
                        <select name="province" id="province">
                            <!-- insert api response here -->
                            <option value="">Select Province</option>
                        </select>
                    </div>
                </div>

                <!-- City -->
                <div class="input-container">
                    <div class="div1">
                        <label for="city">City</label>
                    </div>

                    <div class="div2">
                        <select name="city" id="city">
                            <!-- insert api response here -->
                            <option value="">Select City</option>
                        </select>
                    </div>
                </div>

                <!-- Barangay -->
                <div class="input-container">
                    <div class="div1">
                        <label for="barangay">Barangay</label>
                    </div>

                    <div class="div2">
                        <select name="barangay" id="barangay">
                            <!-- insert api response here -->
                            <option value="">Select Barangay</option>
                        </select>
                    </div>
                </div>
                <br>
                <input required type="text" name="streetDescription" id="streetDescription" placeholder="Subdivision-Street-Block-Lot" name="address">


                <div class="form-login">
                     <div class="text-center" id="loadingSpinner"></div>
                    <button disabled class="btn btn-login"  type="button" name="btn_register" id="btnRegister">REGISTER</button>
                </div>

                <div class="form-login">
                <a href='register.php' id="btnBack" class="btn btn-login">BACK</a>

                </div>
               
                
            </div>

            

        </form>



    </div>
    </div>
    
    </div>
    
<div class="form-sociallink">
</div>
</div>
</div>
<div class="login-img">
<img src="../upload_system/<?php echo $db_system_banner  ?>" alt="img">
</div>
</div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="../administrator/admin_view/assets/js/jquery.slimscroll.min.js"></script>

<script src="../administrator/admin_view/assets/plugins/alertify/alertify.min.js"></script>

<script>
$(document).ready(function() {
    $("#btnRegister").click(function(e) {
        e.preventDefault(); // Prevent the default form submission

        var email =$("#email").val();

        // Gather the data from the form
        var formData = {
            fname: $("input[name='fname']").val(),
            lname: $("input[name='lname']").val(),
            bday: $("input[name='bday']").val(),
            username: $("input[name='username']").val(),
            email: $("input[name='email']").val(),
            contact: $("input[name='contact']").val(),
            password: $("input[name='password']").val(),
            cpass: $("input[name='cpass']").val(),
            region: $("#region").val(),
            province: $("#province").val(),
            city: $("#city").val(),
            barangay: $("#barangay").val(),
            streetDescription: $("#streetDescription").val()
        };

        // Perform an Ajax POST request to your PHP script
        $.ajax({
            type: "POST",
            url: "controller/register/back_register.php", // Replace with the actual PHP script's URL
            data: formData,
            success: function(response) {

               // var response = JSON.parse(response);

                //var db_acc_id = response.response;
                var result = response.response;
                var last_id = response.last_id;

               // console.log(db_acc_id);

               
                // Only if the previous Ajax request was successful, send an email
                $("#btnRegister").css("display", "none");
                

                if(result=="success"){
                    console.log(last_id);

                $.ajax({
                    type: "POST",
                    url: "../mailer.php",
                    data: { db_acc_id: last_id },
                    beforeSend: function() {
                        $("#loadingSpinner").html('<div class="spinner-border text-warning" role="status"><span class="sr-only">Loading...</span></div>').show();
                    },
                    success: function(response) {
                    
                        console.log(response)
                        // Display success message
                        alertify.success("Otp successfully sent to "+email);
                        setTimeout(function() {
                        window.location.href = "verification_code.php?accid=" + last_id;
                        }, 1000); // 1000 milliseconds (1 second)

                    },
                    error: function(xhr, status, error) {
                        $("#loadingSpinner").hide();
                        $("#btnRegister").css("display", "block");
                        console.error("AJAX Error in mailer.php: " + error);
                    },
                    complete: function() {
                   
                     //  $("#loadingSpinner").hide();
                    }
                  
                });

                }else{
                    alertify.error(result);
                }

            },
            error: function() {
                // Handle errors, e.g., show an error message
                console.error("An error occurred while submitting the data.");
            }
        });
    });
});
</script>







<script>
$(document).ready(function () {
    // Function to check if all required fields are filled and highlight empty fields
    function validateForm() {
        var region = $("#region");
        var province = $("#province");
        var city = $("#city");
        var barangay = $("#barangay");
        var streetDescription = $("#streetDescription");

        // Remove any existing inline styles
        region.removeAttr("style");
        province.removeAttr("style");
        city.removeAttr("style");
        barangay.removeAttr("style");
        streetDescription.removeAttr("style");

        // Enable the button if all fields are filled, otherwise disable it
        if (region.val() !== "" && province.val() !== "" && city.val() !== "" && barangay.val() !== "" && streetDescription.val() !== "") {
            $("#btnRegister").prop("disabled", false);
        } else {
            $("#btnRegister").prop("disabled", true);

            // Highlight empty fields with inline CSS
            if (region.val() === "") {
                region.css("border", "1px solid red");
            }
            if (province.val() === "") {
                province.css("border", "1px solid red");
            }
            if (city.val() === "") {
                city.css("border", "1px solid red");
            }
            if (barangay.val() === "") {
                barangay.css("border", "1px solid red");
            }
            if (streetDescription.val() === "") {
                streetDescription.css("border", "1px solid red");
            }
        }
    }

    // Attach change event listeners to the select elements and input
    $("#region, #province, #city, #barangay, #streetDescription").on("change keyup", validateForm);

    // Trigger the validation on page load
    validateForm();
});
</script>








<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.js"></script>

<!--<script type="text/javascript" src="https://f001.backblazeb2.com/file/buonzz-assets/jquery.ph-locations.js"></script>--->
<script src="controller/register/js/validation.js"></script>
<script type="text/javascript"></script>
<script src="controller/register/js/address_api.js"></script>


</body>
</html>

<script>


 // When the "BACK" button is clicked
$("#btnBack").click(function(e) {
    e.preventDefault(); // Prevent the default form submission

    // Get the values of hidden inputs
    var fname = $("input[name='fname']").val();
    var lname = $("input[name='lname']").val();
    var bday = $("input[name='bday']").val();
    var username = $("input[name='username']").val();
    var email = $("input[name='email']").val();
    var contact = $("input[name='contact']").val();
    var password = $("input[name='password']").val();
    var cpass = $("input[name='cpass']").val();

    // Get the selected values from the select elements
    var region = $("#region").val();
    var province = $("#province").val();
    var city = $("#city").val();
    var barangay = $("#barangay").val();
    var streetDescription = $("#streetDescription").val();

    // Create an object to store the form data including selections
    var formData = {
        fname: fname,
        lname: lname,
        bday: bday,
        username: username,
        email: email,
        contact: contact,
        password: password,
        cpass: cpass,
        region: region,
        province: province,
        city: city,
        barangay: barangay,
        streetDescription:streetDescription
    };

    // JSON encode the form data
    var formDataJSON = JSON.stringify(formData);

    // Store the form data in localStorage
    localStorage.setItem('formData', formDataJSON);

    // Redirect to register.php
    window.location.href = "register.php";
});


    // Retrieve data from local storage
    var formData = JSON.parse(localStorage.getItem('formData'));


if (formData) {
 
    console.log(formData);

    if (formData.streetDescription) {
        document.getElementById('streetDescription').value = formData.streetDescription;
    }
} else {
    
    console.log('Local storage is empty.');
}
</script>



                