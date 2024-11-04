<?php
include("../connection.php");
include("back_cunfirmAcc.php");


include("../customer/backend/back_navbar.php");


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $db_system_name ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

 
    <link rel="stylesheet" type="text/css" href="css/style.css">
 
   
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
        media="screen">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	 

	 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <style>

        
        @media (max-width: 576px) {
            body {
                background-image: none;
            }
        }

        .max-height-30 {
            max-height: 60vh;
        }
    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark" style='background-color:#6D0F0F;'>
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="navbar-brand" href="index.php"><img src="../upload_system/<?php echo $db_system_logo ?>" alt="" width="50" height="40"><?php echo $db_system_name ?></a>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="products.php">Products</a>
                </li>
				<li class="nav-item">
                    <a class="nav-link" aria-current="page" href="about.php">About us</a>
                </li>
                
                
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                
            </ul>
        </div>
    </div>
</nav>

    <style>

.banner_section {
    width: 100%;
    float: left;
    background-image: url(../cover/<?= $db_system_banner?>);
    height: 100%;
    background-size: cover; /* I-set ang background-size sa 'cover' */
    padding: 10px 0px 25px 0px;
    background-repeat: no-repeat;
}

      </style>
  <?php
$accid = $_GET['accid'];
$view_product_query = mysqli_query($connections, "SELECT * FROM account WHERE acc_id = '$accid'");
$product_row = mysqli_fetch_assoc($view_product_query);

if ($product_row) {
    $db_acc_id = $product_row["acc_id"];
    $db_acc_email = $product_row["acc_email"];
    $email_parts = explode('@', $db_acc_email); // Ihiwalay ang email address sa pamamagitan ng '@'
    $username = $email_parts[0]; // Kunin ang username
    $domain = $email_parts[1]; // Kunin ang domain

    $username_length = strlen($username); // Kunin ang haba ng username
    $hidden_username = substr_replace($username, '*', 1, $username_length - 2); // Palitan ang mga random na titik sa asterisk

    $masked_email = $hidden_username . '@' . $domain; // Isama ang domain upang mabuo ang natatakpan na email

    $db_acc_otp = $product_row["Otp"];

    $db_acc_status = $product_row["acc_status"];
}

$view_maintinance_query = mysqli_query($connections, "SELECT * FROM maintinance ");
$main_row = mysqli_fetch_assoc($view_maintinance_query);
$system_fb	 = $main_row["system_fb"];

?>
<div class="banner_section layout_padding">
    <div class="container">
        <div id="main_slider" class="carousel slide" data-ride="carousel">
            <form method="POST">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-6 mx-auto"> <!-- Added "mx-auto" class to center the column -->
                            <div class="card text-center login-card">
                                <div class="card-body">
                                    <div class="mb-5">
                                        <h1 class="login-heading">CONFIRM ACCOUNT</h1> <!-- Corrected spelling of "CONFIRM" -->
                                    </div>
                                    <div class="mb-3">
                                        <label style='float:left;'>Enter OTP on your email: <b><?php echo $masked_email?></b></label>
                                        <input type="password" class="form-control" placeholder="Enter One Time Pin" value='<?php echo $EnterOtp?>' name="EnterOtp">
                                        <span class="error"><?php echo $EnterOtpErr?></span>
                                    </div>
                                    
                                    <div class="d-grid gap-2 col-12 mx-auto mb-3">
                                        <button id="btnSendOtp" class="btn btn-success" type="submit" name="btnSendOtp"
                                        <?php if($db_acc_status == 2) { echo "disabled"; } ?>>SEND</button> 
                                    </div>
                                    <div class="mb-3 text-primary">
                                        <?php if($db_acc_status != 2) { ?>
                                            <a id="resendLink" class="nav-link" href="back_resendOtp.php?accid=<?php echo $accid ?>" style="cursor: pointer;">Resend Otp</a>

                                        <?php }else{
                                            echo "
                                            <b style='color:red;'>
                                            Too many Incorrect attempt <br>
                                             Please Contact the <a href='$system_fb'>Administrator</a> to Activate your account
                                             </b>
                                             ";
                                        } ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
// Get the countdown value from the PHP variable
var countdown = <?php echo $countdown; ?>;

// Function to start the countdown
function startCountdown() {
    var countdownElement = document.getElementById('countdown');
    var sendOtpButton = document.getElementById('btnSendOtp');
    var resendLink = document.getElementById('resendLink');

    var timer = setInterval(function() {
        countdownElement.innerHTML = countdown;
        countdown--;

        if (countdown < 0) {
            clearInterval(timer);
            countdownElement.style.display = 'none';
            sendOtpButton.removeAttribute('disabled');
            resendLink.classList.remove('disabled');
            resendLink.setAttribute('href', 'back_resendOtp.php?accid=<?php echo $accid ?>');
        }
    }, 1000);
}

// Call the startCountdown function if countdown is greater than 0
if (countdown > 0) {
    var sendOtpButton = document.getElementById('btnSendOtp');
    var resendLink = document.getElementById('resendLink');

    sendOtpButton.disabled = true;
    resendLink.classList.add('disabled');
    resendLink.removeAttribute('href');
    startCountdown();
}
</script>





  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
 
</body>

</html>
