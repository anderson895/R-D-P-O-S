<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="view/Signup/assets/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="view/Signup/assets/js/bootstrap.bundle.min.js"></script>
</head>
<body class="account-page">

<div class="main-wrapper">
    <div class="account-content">
        <div class="login-wrapper">
            <div class="login-content">
                <div class="login-userset">
                    <form method="POST">
                        <div class="login-userheading">
                            <h3>Create an Account</h3>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-login">
                                    <label>First Name</label>
                                    <div class="form-addons">
                                        <input type="text" placeholder="Enter your first name" name='fname' id="fname" value="">
                                        <div style="color:red;" id="fnameError"></div>
                                        <img src="view/Signup/assets/img/icons/users1.svg" alt="img">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-login">
                                    <label>Last Name</label>
                                    <div class="form-addons">
                                        <input type="text" placeholder="Enter your last name" name='lname' id="lname" value="">
                                        <div style="color:red;" id="lnameError"></div>
                                        <img src="view/Signup/assets/img/icons/users1.svg" alt="img">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-login">
                            <label for="birthdate">Birthday</label>
                            <div class="form-addons">
                                <input name='bday' value="2006-01-01" required type="date" id="birthdate">
                                <div style="color:red;" id="birthdateError"></div>
                            </div>
                        </div>

                        <div class="form-login">
                            <label>Username</label>
                            <div class="form-addons">
                                <input required type="text" placeholder="Username" name='username' id="username" value="">
                                <div style="color:red;" id="usernameLengthError"></div>
                                <div style="color:red;" id="usernameError"></div>
                                <img src="view/Signup/assets/img/icons/mail.svg" alt="img">
                            </div>
                        </div>

                        <div class="form-login">
                            <label>Email</label>
                            <div class="form-addons">
                                <input required type="email" placeholder="Email" name='email' id="email" value="">
                                <div style="color:red;" id="emailError"></div>
                                <img src="view/Signup/assets/img/icons/mail.svg" alt="img">
                            </div>
                        </div>

                        <div class="form-login">
                            <label>Contact Number</label>
                            <div class="form-addons">
                                <input required type="number" placeholder="Contact" name='contact' id="contact" value="">
                                <div style="color:red;" id="contactError"></div>
                                <img src="view/Signup/assets/img/icons/mail.svg" alt="img">
                            </div>
                        </div>

                        <div class="form-login">
                            <label>Password</label>
                            <div class="pass-group">
                                <input class="pass-input" name='pass' required type="password" placeholder="Password" id="password" value="">
                            </div>
                        </div>

                        <div class="form-login">
                            <label>Confirm Password</label>
                            <div class="pass-group">
                                <input class="pass-input" name='cpass' required type="password" placeholder="Confirm Password" id="confirmPassword" value="">
                                <div class="error-message" style="color:red;" id="passwordError"></div>
                                <div class="error-message" style="color:red;" id="passwordMatchError"></div>
                            </div>
                        </div>

                        <div class="form-login">
                            <div class="form-check" style="display: flex; align-items: center;">
                                    <input type="checkbox" id="agreeTermsCheckbox" style="width: 16px; height: 16px; margin-right: 5px;" required>
                                    <label for="agreeTermsCheckbox" style="margin: 0;">
                                        <a href="#" id="termsLink" style="text-decoration: underline;">I agree to the Terms and Conditions</a>
                                    </label>
                            </div>





                            <button class="btn btn-login" type="submit" id="submitButton" disabled>Create Account</button>
                            <div class="text-center" id="loadingSpinner"></div>
                        </div>
                    </form>

                    <div class="signinform text-center">
                        <h4>Already a user? <a href="login.php" class="hover-a">Sign In</a></h4>
                    </div>
                </div>
            </div>
            <div class="login-img">
                <div class="container">
                    <img src="../upload_system/<?=$db_system_banner?>" alt="">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Terms and Conditions -->
<div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height: 600px; overflow-y: auto;">
                <h5 class="text-center">Terms and Conditions</h5>
                <p class="text-justify" style="font-size: 12px;">Welcome to R De Leon Poultry Supplies! We appreciate your business and would like to ensure a smooth and transparent transaction. Please read the following terms and conditions carefully before using our Point of Sale (POS) system and online ordering services.</p>
                <p style="font-size: 12px;">
                    1. Returns Policy:<br>
                    a) We accept returns for products purchased within 7 days from the date of purchase.<br>
                    b) Products eligible for return must be unused and in their original packaging.<br>
                    c) Refunds will not be issued for returned products. We only offer replacements under certain conditions.<br><br>

                    2. Refund Policy:<br>
                    a) We do not accept refunds for returned products.<br>
                    b) In case of a return, we will provide a replacement for the damaged or expired product.<br><br>

                    3. Replacement Policy:<br>
                    a) The store will only accept replacement requests for damaged or expired products.<br>
                    b) To initiate a replacement, please contact our customer service within 7 days of receiving the product.<br>
                    c) Replacements will be processed after verification of the damage or expiration.<br><br>

                    4. Data Privacy:<br>
                    a) We are committed to protecting your privacy and adhere to the Data Privacy Act of 2012.<br>
                    b) Any personal information provided by customers will be used solely for the purpose of processing orders and improving our services.<br>
                    c) We do not use customer data for illegal activities or share it with third parties without explicit consent.<br><br>

                    5. Online Ordering:<br>
                    a) By placing an order on our website, you agree to abide by these terms and conditions.<br>
                    b) Customers are responsible for providing accurate and up-to-date information during the ordering process.<br>
                    c) R De Leon Poultry Supplies reserves the right to cancel or refuse any order in case of suspected fraudulent activity.<br><br>

                    6. Changes to Terms and Conditions:<br>
                    a) R De Leon Poultry Supplies reserves the right to modify these terms and conditions at any time without prior notice.<br>
                    b) It is the customer's responsibility to review the terms periodically for any changes.<br><br>

                    7. Contact Information:<br>
                    a) For any inquiries, concerns, or to initiate a return or replacement, please contact our customer service at [provide contact details].<br><br>

                    8. Payment Policies:<br>
                    a) We only accept manual processing payments and do not support automated payment processing at this time.<br>
                    b) Payment can be made via E-Wallet or Bank Transfer.<br>
                    c) Please note that the payment process is not automated within our system.<br>
                    d) Customers are required to provide proof of payment for order processing.<br><br>
                    e) The store shall not be responsible for any taxes or fees associated with the payment (G-cash or Maya). The customer agrees to bear any such taxes or fees and shall provide proof of payment upon request.<br><br>

                    9. E-Wallet Payments:<br>
                    a) If you choose to make payment via E-Wallet, please transfer the specified amount to the provided E-Wallet account.<br>
                    b) After completing the transaction, kindly provide proof of payment via email to [provide email address].<br><br>

                    10. Bank Transfer Payments:<br>
                    a) For Bank Transfer payments, transfer the order amount to the designated bank account.<br>
                    b) After the transfer is complete, send proof of payment to [provide email address].<br><br>

                    11. Proof of Payment:<br>
                    a) Customers must provide a clear and valid proof of payment for order processing.<br>
                    b) Proof of payment should include transaction details such as date, amount, and transaction reference.<br><br>

                    12. Order Processing:<br>
                    a) Orders will be processed upon verification of the provided proof of payment.<br>
                    b) It is the responsibility of the customer to ensure that accurate proof of payment is submitted.<br><br>

                    13. Payment Confirmation:<br>
                    a) Once payment is confirmed, you will receive an order confirmation email, and your order will be processed for shipping.<br><br>

                    14. Failed Payments:<br>
                    a) In case of failed payments or discrepancies, our customer service will contact you to resolve the issue.<br><br>

                    15. Currency:<br>
                    a) All transactions are processed in Philippine Peso (PHP), the official currency of the Philippines.<br><br>
                </p>
                <input type="checkbox" id="agreeTermsCheckboxModal"> I agree to the Terms and Conditions
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-sm" id="agreeButtonModal">Agree</button>
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function() {
    // Show the modal when the Terms link is clicked
    $('#termsLink').click(function(e) {
        e.preventDefault();
        $('#termsModal').modal('show');
    });

    // Enable the "Create Account" button based on checkbox status
    $("#agreeTermsCheckbox").change(function() {
        $("#submitButton").prop("disabled", !this.checked);
    });

    // Handle agree button in the modal
    $('#agreeButtonModal').click(function() {
        $("#agreeTermsCheckbox").prop("checked", true);
        $("#submitButton").prop("disabled", false);
        $('#termsModal').modal('hide');
    });
});
</script>

</body>
</html>
