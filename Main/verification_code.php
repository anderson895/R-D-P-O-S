<?php 
include("controller/maintinance.php");
include("back_cunfirmAcc.php");
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
    <!-- Include Alertify.js CSS and JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/alertify.js/1.13.1/alertify.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alertify.js/1.13.1/alertify.min.js"></script>

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
                                <p hidden id="countDownText"></p>
                            </div>

                            <button id="btnSendOtp" <?= $db_acc_status == 2 ? "disabled" : ""; ?> type="submit" name="btnSendOtp" class="btn btn-primary mb-3 mt-3">
                                Confirm
                            </button>
                        </form>
                        <div class="text-center" id="loadingSpinner"></div>
                        <div id="resendDiv">
                            <center><span class="error" id="errorCount"><?= isset($EnterOtpErr) ? htmlspecialchars($EnterOtpErr, ENT_QUOTES, 'UTF-8') : ''; ?></span></center>
                            <p class="resend text-muted mb-0">
                                Didn't receive code? <a id="resendLink" style="color:green;">Request again</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
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

            function updateCountdown() {
                var now = new Date();
                var timeDifference = otpExpirationDate - now;

                if (timeDifference > 0) {
                    var seconds = Math.floor(timeDifference / 1000);
                    $("#countDownText").text(seconds + " seconds");
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
                        if (response.result === "success") {
                            $("#resendLink").css("display", "none");
                            $("#loadingSpinner").html('<div class="spinner-border text-warning" role="status"><span class="sr-only"></span></div>').show();
                            $.ajax({
                                type: "POST",
                                url: "../mailer.php",
                                data: formData,
                                success: function() {
                                    alert("OTP resent successfully.");
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
                            $("#errorCount").text(response.remaining);
                        }
                    },
                    error: function() {
                        console.error("An error occurred while submitting the data.");
                    }
                });
            });
        });
    </script>
</body>
</html>
