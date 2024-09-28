<?php 
include("controller/maintinance.php");

include "include/session_dir.php";

// Redirect if no GET parameters
if (empty($_GET)) {
    header("Location: register.php");
    exit;
}

// Get account ID from the URL safely
$accid = htmlspecialchars($_GET['accid'], ENT_QUOTES, 'UTF-8');

// Use prepared statement to prevent SQL injection
$stmt = $connections->prepare("SELECT * FROM account WHERE acc_id = ?");
$stmt->bind_param("s", $accid);
$stmt->execute();
$product_row = $stmt->get_result()->fetch_assoc();

// Check if account was found
if ($product_row) {
    $db_acc_id = $product_row["acc_id"];
    $db_acc_email = $product_row["acc_email"];
    $email_parts = explode('@', $db_acc_email);
    $username = $email_parts[0];
    $domain = $email_parts[1];

    $username_length = strlen($username);
    $hidden_username = substr_replace($username, '*', 1, $username_length - 2);
    $masked_email = $hidden_username . '@' . $domain;

    $db_acc_otp = $product_row["Otp"];
    $db_acc_status = $product_row["acc_status"];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify OTP</title>
    <link rel="stylesheet" href="assets/css/verification.css">
    <link rel="stylesheet" href="view/confirmOTP/css/style.css">
    <link rel="stylesheet" href="../administrator/admin_view/assets/plugins/alertify/alertify.min.css">
    
    
    <style>
        .error {
            color: red;
        }
        #btnSendOtp.disabled {
            background-color: #ccc;
            color: #fff;
            cursor: not-allowed;
        }
        #btnSendOtp.enabled {
            color: #fff;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="body-wrapper">
    <?php include "include/header.php"; ?>
    
    <main class="cd__main">
        <br><br><br><br>
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 col-lg-4" style="min-width: 500px;">
                <div class="card bg-white mb-5 mt-5 border-0" style="box-shadow: 0 12px 15px rgba(0, 0, 0, 0.02);">
                    <div class="card-body p-5 text-center">
                        <form method="POST">
                            <input type="hidden" value="<?= htmlspecialchars($accid, ENT_QUOTES, 'UTF-8'); ?>" name="accid" id="accid">
                            <h4>Verify</h4>
                            <p>Your OTP code was sent to <?= htmlspecialchars($masked_email, ENT_QUOTES, 'UTF-8'); ?></p>

                            <div class="otp-field mb-4">
                                <input name="code1" type="number" min="0" max="9" required />
                                <input name="code2" type="number" min="0" max="9" required disabled />
                                <input name="code3" type="number" min="0" max="9" required disabled />
                                <input name="code4" type="number" min="0" max="9" required disabled />
                            </div>

                            <div>
                                <input id="otpExpiration" type="hidden" value="<?= htmlspecialchars($product_row['otp_expiration'], ENT_QUOTES, 'UTF-8'); ?>">
                                <p id="countDownText"></p>
                            </div>

                            <button id="btnSendOtp" <?= $db_acc_status == 2 ? "disabled" : ""; ?> type="submit" name="btnSendOtp" class="btn btn-primary mb-3 mt-3">
                                Confirm
                            </button>
                        </form>
                        <div class="text-center" id="loadingSpinner"></div>
                        <div id="resendDiv">
                            <center><span class="error" id="errorCount"><?= isset($EnterOtpErr) ? htmlspecialchars($EnterOtpErr, ENT_QUOTES, 'UTF-8') : ''; ?></span></center>
                            <p class="resend text-muted mb-0">
                                Didn't receive code? <a id="resendLink" style="color: green; text-decoration: underline;">Request again</a>

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../administrator/admin_view/assets/plugins/alertify/alertify.min.js"></script>
    <script>
    const inputs = document.querySelectorAll(".otp-field > input");
    const button = document.querySelector("#btnSendOtp");

    window.addEventListener("load", () => inputs[0].focus());
    button.disabled = true;

    inputs.forEach((input, index) => {
        input.addEventListener("keyup", (e) => {
            if (input.value.length > 1) {
                input.value = input.value.slice(0, 1);
            }

            if (e.key === "Backspace" && index > 0) {
                inputs[index - 1].focus();
            } else if (input.value.length === 1 && index < inputs.length - 1) {
                inputs[index + 1].removeAttribute("disabled");
                inputs[index + 1].focus();
            }

            button.disabled = [...inputs].some(input => !input.value);
        });
    });

    $(document).ready(function() {
        var otpExpirationString = $("#otpExpiration").val();
        var otpExpirationDate = new Date(otpExpirationString);
        var countdownDuration = 0; // Variable to store countdown seconds

        function updateCountdown() {
            var now = new Date();
            var timeDifference = otpExpirationDate - now;

            if (timeDifference > 0) {
                var seconds = Math.floor(timeDifference / 1000);
                countdownDuration = seconds; // Store seconds for the countdown
                $("#countDownText").text(seconds + " seconds remaining");
            } else {
                $("#countDownText").text("OTP has expired");
                $("#btnSendOtp").prop("disabled", false);
            }
        }

        updateCountdown();
        setInterval(updateCountdown, 1000);

        $("#resendLink").click(function(e) {
            e.preventDefault();
            var formData = { db_acc_id: $("input[name='accid']").val() };

            $.ajax({
                type: "POST",
                url: "back_resendOtp.php",
                data: formData,
                success: function(response) {
                    console.log(response)
                    if (response.result === "success") {
                        $("#resendLink").css("display", "none");
                        $("#loadingSpinner").html('<div class="spinner-border text-warning" role="status"><span class="sr-only"></span></div>').show();
                        $.ajax({
                            type: "POST",
                            url: "../mailer.php",
                            data: formData,
                            success: function() {
                                alertify.success("OTP resent successfully.");
                            },
                            error: function(xhr, status, error) {
                                console.error("AJAX Error in mailer.php: " + error);
                            },
                            complete: function() {
                                $("#loadingSpinner").hide();
                                $("#resendLink").css("display", "block");
                                $("#resendDiv").css("display", "block");
                                setTimeout(function() {
                                    window.location.reload();
                                }, 1000);
                            }
                        });
                    } else {
                        $("#errorCount").text('Just wait for ' + response.remaining + ' minute' + (response.remaining > 1 ? 's' : '') + '.');

                    }
                },
                error: function() {
                    console.error("An error occurred while submitting the data.");
                }
            });
        });

        // Countdown logic for incorrect OTP attempts
        function startCountdown(seconds) {
            let countdown = seconds;

            $("#countDownText").text(countdown + " seconds");
            const interval = setInterval(function() {
                countdown--;
                $("#countDownText").text(countdown + " seconds");
                
                if (countdown <= 0) {
                    clearInterval(interval);
                    button.disabled = false;
                    $("#resendLink").show(); // Show the resend link again
                }
            }, 1000);
        }
    });
    </script>

<?php
include("../connection.php");


date_default_timezone_set('Asia/Manila');

// Get the current date and time
$currentDateTime = date('Y-m-d H:i:s');
// Ensure accid is provided in the request
if (!isset($_GET['accid'])) {
    exit("Account ID is missing.");
}

$accid = $_GET['accid'];
$EnterOtp = '';
$EnterOtpErr = '';
$incorrectAttempts = 0; 
$countdown = 0;

$limit1 = 4; // 4 attempts - 30 seconds lock
$limit2 = 8; // 8 attempts - 1 hour lock
$limit3 = 16; // 16 attempts - 2 hours lock

// Fetch account data
$view_product_query = mysqli_query($connections, "SELECT * FROM account WHERE acc_id = '$accid'");
$product_row = mysqli_fetch_assoc($view_product_query);

if ($product_row) {
    $db_acc_id = $product_row["acc_id"];
    $db_acc_email = $product_row["acc_email"];
    $db_acc_otp = $product_row["Otp"];
    $incorrectAttempts = $product_row["incorrect_attempts"]; 
    $otp_expiration = $product_row["otp_expiration"];
}

if (isset($_POST['btnSendOtp'])) {
    $code1 = $_POST['code1'];
    $code2 = $_POST['code2'];
    $code3 = $_POST['code3'];
    $code4 = $_POST['code4'];
    $EnterOtp = $code1 . $code2 . $code3 . $code4;

    if (strtotime($otp_expiration) >= time()) {
        if ($EnterOtp == $db_acc_otp) {
            mysqli_query($connections, "UPDATE account SET Otp='0', incorrect_attempts='0' WHERE acc_id='$db_acc_id'");
            echo '<script> document.location.href = "terms-and-condition.php?accid=' . $accid . '"; </script>';
            
            date_default_timezone_set('Asia/Manila');
           

            $logQuery = "INSERT INTO users_log(act_account_id, act_activity, act_date, act_table, act_collumn_id) 
            VALUES('$db_acc_id', 'Successfully verified their account', '$currentDateTime', 'account', '$db_acc_id')";
            mysqli_query($connections, $logQuery);
        } else {
            $incorrectAttempts++;
            mysqli_query($connections, "UPDATE account SET incorrect_attempts='$incorrectAttempts' WHERE acc_id='$db_acc_id'");

            if ($incorrectAttempts >= $limit1 && $incorrectAttempts < $limit2) {
                $countdown = 30; 
                $EnterOtpErr = 'Incorrect OTP. Please wait for <span id="countdown">' . $countdown . '</span> seconds before trying again.';
            } elseif ($incorrectAttempts >= $limit2 && $incorrectAttempts < $limit3) {
                $countdown = 60; 
                $EnterOtpErr = 'Incorrect OTP. Please wait for <span id="countdown">' . gmdate("H:i:s", $countdown) . '</span> before trying again.';
            } elseif ($incorrectAttempts >= $limit3) {
                $countdown = 7200; 
                $EnterOtpErr = 'Incorrect OTP. Please wait for <span id="countdown">' . gmdate("H:i:s", $countdown) . '</span> before trying again.';
                mysqli_query($connections, "UPDATE account SET acc_status='2' WHERE acc_id='$db_acc_id'");

                $logQuery = "INSERT INTO users_log(act_account_id, act_activity, act_date, act_table, act_collumn_id) 
                VALUES('$db_acc_id', 'Too many incorrect OTP attempts causing temporary block', '$currentDateTime', 'account', '$db_acc_id')";
                mysqli_query($connections, $logQuery);
            } else {
                $countdown = 0; 
                $EnterOtpErr = 'Incorrect OTP';
            }

            echo "<script>startCountdown($countdown);</script>";
            echo "<script>alertify.error('$EnterOtpErr');</script>";
        }
    } else {
        $EnterOtpErr = "OTP has expired. Please request a new one.";
        echo "<script>alertify.error('$EnterOtpErr');</script>";
    }
}
?>
 <link rel="stylesheet" href="../administrator/admin_view/assets/plugins/alertify/alertify.min.css">

 <script src="../administrator/admin_view/assets/plugins/alertify/alertify.min.js"></script>
<script>
// JavaScript countdown function
function startCountdown(seconds) {
    let countdownElement = document.getElementById('countdown');
    let remainingTime = seconds;

    let interval = setInterval(() => {
        if (remainingTime <= 0) {
            clearInterval(interval);
            countdownElement.innerHTML = "0"; // Reset countdown display
            document.getElementById('btnSendOtp').style.display = 'block'; // Show button again
            document.getElementById('resendLink').style.display = 'block'; // Show resend link
        } else {
            countdownElement.innerHTML = remainingTime;
            remainingTime--;
        }
    }, 1000);
}
</script>

</body>
</html>
