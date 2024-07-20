<?php 
include("controller/maintinance.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Terms and Conditions</title>


    <link rel="shortcut icon" type="image/x-icon" href="../../upload_system/<?= $db_system_logo ?>">

<link rel="stylesheet" href="../administrator/admin_view/assets/plugins/scrollbar/scroll.min.css">

<link rel="stylesheet" href="../administrator/admin_view/assets/plugins/alertify/alertify.min.css">

<link rel="stylesheet" href="../administrator/admin_view/assets/css/bootstrap.min.css">

<link rel="stylesheet" href="../administrator/admin_view/assets/css/animate.css">

<link rel="stylesheet" href="../administrator/admin_view/assets/css/dataTables.bootstrap4.min.css">

<link rel="stylesheet" href="../administrator/admin_view/assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="../administrator/admin_view/assets/plugins/fontawesome/css/all.min.css">

<link rel="stylesheet" href="../administrator/admin_view/assets/css/style.css">
  
  </head>
  <body class="body">
  <?php include "view/navigation.php"; ?>

    <div class="container border">
        <div class="container d-block p-5 ">
            <div class="row  ">
                <div class="col-12 col-md-2"></div>
                <div class="col-12 col-md-8">
                    <h5 class="text-center">Terms and Conditions</h5>
                    <p class="text-justify" style="font-size: 12px;">Welcome to R De Leon Poultry Supplies! We appreciate your business and would like to ensure a smooth and transparent transaction. Please read the following terms and conditions carefully before using our Point of Sale (POS) system and online ordering services.</p>
                    <p style="font-size: 12px;">
                        1.	Returns Policy:<br>
                        a)	We accept returns for products purchased within 7 days from the date of purchase.<br>
                        b)	Products eligible for return must be unused and in their original packaging.<br>
                        c)	Refunds will not be issued for returned products. We only offer replacements under certain conditions.<br><br>
                        
                        2.	Refund Policy:<br>
                        a)	We do not accept refunds for returned products.<br>
                        b)	In case of a return, we will provide a replacement for the damaged or expired product.<br><br>
                        
                        3.	Replacement Policy:<br>
                        a)	The store will only accept replacement requests for damaged or expired products.<br>
                        b)	To initiate a replacement, please contact our customer service within 7 days of receiving the product.<br>
                        c)	Replacements will be processed after verification of the damage or expiration.<br><br>
                        
                        4.	Data Privacy:<br>
                        a)	We are committed to protecting your privacy and adhere to the Data Privacy Act of 2012.<br>
                        b)	Any personal information provided by customers will be used solely for the purpose of processing orders and improving our services.<br>
                        c)	We do not use customer data for illegal activities or share it with third parties without explicit consent.<br><br>
                        
                        5.	Online Ordering:<br>
                        a)	By placing an order on our website, you agree to abide by these terms and conditions.<br>
                        b)	Customers are responsible for providing accurate and up-to-date information during the ordering process.<br>
                        c)	R De Leon Poultry Supplies reserves the right to cancel or refuse any order in case of suspected fraudulent activity.<br><br>
                        
                        6.	Changes to Terms and Conditions:<br>
                        a)	R De Leon Poultry Supplies reserves the right to modify these terms and conditions at any time without prior notice.<br>
                        b)	It is the customer's responsibility to review the terms periodically for any changes.<br><br>
                        
                        7.	Contact Information:<br>
                        a)	For any inquiries, concerns, or to initiate a return or replacement, please contact our customer service at [provide contact details].<br><br>
                        
                        8.	Payment Policies:<br>
                        a)	We only accept manual processing payments and do not support automated payment processing at this time.<br>
                        b)	Payment can be made via E-Wallet or Bank Transfer.<br>
                        c)	Please note that the payment process is not automated within our system.<br>
                        d)	Customers are required to provide proof of payment for order processing.<br><br>
                        e.) The store shall not be responsible for any taxes or fees associated with the payment (G-cash or Maya). The customer agrees to bear any such taxes or fees and shall provide proof of payment upon request
                            
                        9.	E-Wallet Payments:<br>
                        a)	If you choose to make payment via E-Wallet, please transfer the specified amount to the provided E-Wallet account.<br>
                        b)	After completing the transaction, kindly provide proof of payment via email to [provide email address].<br><br>
                        10.	Bank Transfer Payments:<br>
                        a)	For Bank Transfer payments, transfer the order amount to the designated bank account.<br>
                        b)	After the transfer is complete, send proof of payment to [provide email address].<br><br>
                        
                        11.	Proof of Payment:<br>
                        a)	Customers must provide a clear and valid proof of payment for order processing.<br>
                        b)	Proof of payment should include transaction details such as date, amount, and transaction reference.<br><br>
                        
                        12.	Order Processing:<br>
                        a)	Orders will be processed upon verification of the provided proof of payment.<br>
                        b)	It is the responsibility of the customer to ensure that accurate proof of payment is submitted.<br><br>
                        
                        13.	Payment Confirmation:<br>
                        a)	Once payment is confirmed, you will receive an order confirmation email, and your order will be processed for shipping. –wala pla tau payment confirmation sa onlline
                        <br><br>
                        14.	Failed Payments:<br>
                        a)	In case of failed payments or discrepancies, our customer service chatting will contact you to resolve the issue.<br><br>
                        
                        15.	Currency:<br>
                        a)	All transactions are processed in Philippine Peso (PHP), the official currency of the Philippines.<br><br>
                        
                    </p>
                    
                    <div class="d-flex flex-row align-items-center">
                        <input id="acceptCheckbox" class="form-check-input" type="checkbox">
                        <input hidden id="accid" type="text" value="<?= $_GET["accid"]; ?>">

                        <p style="font-size: 12px;" class="ml-2 mb-0 ms-2">I hereby acknowledge that I agree with and fully comprehend all the terms and conditions outlined above.</p>    
                    </div>
                    
                    <button id="acceptButton" name="" disabled class="btn btn-primary w-100 mt-2">Agree</button>

                </div>
                <div class="col-12 col-md-2"></div>

            </div>
        </div>

        

    </div>
           <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
           <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>



<script>
  // Use jQuery to select the checkbox and button elements
  var acceptCheckbox = $('#acceptCheckbox');
  var acceptButton = $('#acceptButton');
  var accid=$("#accid").val();

  // Add an event listener to the checkbox
  acceptCheckbox.on('change', function() {
    // Update the disabled attribute of the button based on the checkbox's checked status
    acceptButton.prop('disabled', !acceptCheckbox.is(':checked'));
  });




  $(document).ready(function() {
    var acceptCheckbox = $('#acceptCheckbox');
    var acceptButton = $('#acceptButton');

    acceptCheckbox.on('change', function() {
      acceptButton.prop('disabled', !acceptCheckbox.is(':checked'));
    });

    acceptButton.on('click', function() {
      // Check if the checkbox is checked before performing the AJAX request
      if (acceptCheckbox.is(':checked')) {
        // Perform your AJAX request here
        $.ajax({
          url: 'controller/function/agreeTermAndCondition.php',
          method: 'POST',
          data: { accid:accid },
          success: function(response) {
                        swal({
                            title: "Success!",
                            text: "Account successfully created",
                            icon: "success", // Fix the typo here
                            content: true // Use the "content" option instead of "html"
                        }).then((value) => {
                            if (value) {
                                window.location.href = "../new-customer-website/index.php";
                            } else {
                                window.location.reload();
                            }
                        });
          },

          error: function(error) {
            // Handle the error response
            console.error('AJAX request failed:', error);
          }
        });
      }
    });
  });
</script>