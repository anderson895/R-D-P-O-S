<?php
include("../connection.php");

include("controller/maintinance.php");
include("back_cunfirmForgot.php");





?>




   
    <?php
$accid=$_GET['accid'];
$view_product_query = mysqli_query($connections, "SELECT * FROM account WHERE acc_id = '$accid'");
$product_row = mysqli_fetch_assoc($view_product_query);

if ($product_row) {
    $db_acc_id  = $product_row["acc_id"];
    $db_acc_email= $product_row["acc_email"];
    $db_acc_otp= $product_row["Otp"];

    $db_acc_email = $product_row["acc_email"];
    $email_parts = explode('@', $db_acc_email); // Ihiwalay ang email address sa pamamagitan ng '@'
    $username = $email_parts[0]; // Kunin ang username
    $domain = $email_parts[1]; // Kunin ang domain

    $username_length = strlen($username); // Kunin ang haba ng username
    $hidden_username = substr_replace($username, '*', 1, $username_length - 2); // Palitan ang mga random na titik sa asterisk

    $masked_email = $hidden_username . '@' . $domain; // Isama ang domain upang mabuo ang natatakpan na email

    $db_acc_status = $product_row["acc_status"];
}
?>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



<style>
    a {
        text-decoration: none;
    }

    .error{
        color:red;
       
    }


    /* Add a style for the disabled button */
#btnSendOtp.disabled {
    background-color: #ccc; /* Change this to the desired color for disabled state */
    color: #fff;
    cursor: not-allowed;
}

/* Add a style for the button during verification process */
#btnSendOtp.disabled.verifying {
    background-color: #FFA500; /* Change this to the desired color during verification */
}
/* Add a style for the enabled button */
#btnSendOtp.enabled {
   
    color: #fff;
    cursor: pointer;
}


</style>
<link rel="stylesheet" href="assets/css/verification.css">

<link rel="stylesheet" href="view/confirmOTP/css/style.css">

<body>
<div class="body-wrapper" >
            <!-- Begin Header Area -->
            <?php include "include/header.php"; ?>



   
<br><br><br><br>
<main class="cd__main">
    

    <div class="row justify-content-center">
    
        <div class="col-12 col-md-6 col-lg-4" style="min-width: 500px;">
          <div class="card bg-white mb-5 mt-5 border-0" style="box-shadow: 0 12px 15px rgba(0, 0, 0, 0.02);">
            <div class="card-body p-5 text-center">
            <form method="POST">
            <input hidden type="text" value="<?=$_GET["accid"];?>" name="accid" id="accid">
              <h4>Verify</h4>
              <p>Your otp code was sent to <?php echo $masked_email?></p>
    
             <input hidden type="text" value="<?=$db_acc_email?>" name="email" id="email">
              <div class="otp-field mb-4">
                 <input name="code1" type="number" min="0" max="9" required />
                 <input name="code2" type="number" min="0" max="9" required disabled />
                 <input name="code3" type="number" min="0" max="9" required disabled />
                 <input name="code4" type="number" min="0" max="9" required disabled />
              </div>
    
              <button  id="btnSendOtp" <?php if($db_acc_status == 2) { echo "disabled"; } ?> type="submit" name="btnSendOtp" class="btn btn-primary mb-3">
                Confirm
              </button>
              </form>
              <div class="text-center" id="loadingSpinner"></div>
    
              
              <div id="resendDiv">
              <center><span class="error" id="errorCount"><?php echo $EnterOtpErr?></span></center>
              <center><span class="error" id="countRemaining"></span></center>
              <p class="resend text-muted mb-0" >
    
                Didn't receive code? <a id="resendLink" style="color:green;">Request again</a>
              </p>
              </div>
            </div>
          </div>
        </div>
       
      </div>
    
        </main>
   

        <script src="view/confirmOTP/js/script.js"></script>


<script src="assets/javascript/verify_code_validation.js"></script>



<script>
$(document).ready(function() {
    $("#resendLink").on("click", function() {
        var email = $("#email").val(); // Get the email entered by the user
        
        // If the email format is correct, proceed with the AJAX request
        $.ajax({
            type: "POST",
            url: "back_forgot.php", // Your PHP file to handle the email
            data: { email: email }, // Send the email as a POST parameter

            success: function(response) {
                // Parse the response assuming it's JSON
                var responseData = JSON.parse(response);

                // Access data if the response is in the expected format
                var result = responseData.result;
                var db_acc_id = responseData.db_acc_id;
                var remaining = responseData.remaining;
                
                console.log(result);


                if(result=="success"){

                    if (result == "Email is not registered!") {
                    alertify.error("Email is not registered!");
                } else if (result == "Email is required!") {
                    alertify.error("Email is required!");
                } else {
                    
                                $("#resendDiv").css("display", "none");

                                $.ajax({
                                type: "POST",
                                url: "../forgetmailer.php", // Your PHP file to handle the email
                                data: { db_acc_id: db_acc_id }, // Send the email as a POST parameter

                                beforeSend: function() {
                                            $("#loadingSpinner").html('<div class="spinner-border text-warning" role="status"><span class="sr-only">Loading...</span></div>').show();
                                        },


                                success: function(response) {
                                console.log(response);
                                },
                                error: function(xhr, status, error) {
                                    // Handle errors in the AJAX request
                                    console.error(error);
                                },
                                complete: function() {

                                alertify.success("Otp sent successful ");

                                $("#loadingSpinner").hide();
                                $("#resendDiv").css("display", "block");
                                      

                                }
                                                    
                            });
                    }

                }else{

                    $("#countRemaining").text(remaining)

                    
                    
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



<script>
    

// Get the countdown value from the PHP variable
var countdown = <?= $countdown; ?>;

// Function to start the countdown
function startCountdown() {
    var countdownElement = document.getElementById('countdown');
    var sendOtpButton = document.getElementById('btnSendOtp');
    var resendLink = document.getElementById('resendLink');
    var errorCount = document.getElementById('errorCount'); // Get the errorCount element

    var timer = setInterval(function() {
        countdownElement.innerHTML = countdown;
        countdown--;

        if (countdown < 0) {
            clearInterval(timer);
            countdownElement.style.display = 'none';
            sendOtpButton.removeAttribute('disabled');
            sendOtpButton.classList.remove('disabled');

            
            sendOtpButton.innerHTML = 'VERIFY';
            resendLink.classList.remove('disabled');
            resendLink.setAttribute('href', 'back_forgot.php?accid=<?= $accid ?>');

            // Change the text of the errorCount element
            errorCount.innerHTML = 'Enter correct OTP.';

        }
    }, 1000);
}

// Call the startCountdown function if countdown is greater than 0
if (countdown > 0) {
    var sendOtpButton = document.getElementById('btnSendOtp');
    var resendLink = document.getElementById('resendLink');

    sendOtpButton.disabled = true;
    sendOtpButton.classList.add('disabled');
    sendOtpButton.innerHTML = 'VERIFICATION IN PROGRESS...';
    resendLink.classList.add('disabled');
    resendLink.removeAttribute('href');

    startCountdown();
} else {
    var errorCount = document.getElementById('errorCount');
    errorCount.innerHTML = 'Enter correct OTP.';
    var sendOtpButton = document.getElementById('btnSendOtp');
    sendOtpButton.classList.remove('disabled');
    sendOtpButton.classList.add('enabled');
    sendOtpButton.innerHTML = 'VERIFY';
    errorCount.style.display = 'block'; // Show the errorCount element
}
</script>



<script src="../administrator/admin_view/assets/js/jquery.slimscroll.min.js"></script>

<script src="../administrator/admin_view/assets/plugins/alertify/alertify.min.js"></script>

</html>
