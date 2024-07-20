$(document).ready(function() {
    function updateDiscountName() {
        var selectedVoucher = $("#discount-select option:selected").text();
        $("#discountnameTxt").text(selectedVoucher);
        $("#discountnameTxt").parent().removeAttr('hidden'); // Show the voucher name element
    }

    $('.placeOrder').click(function() {
        var selectedDiscountName = $('#discount-select option:selected').text();
        var selectedDiscountRate = $('#discount-select option:selected').val() * 100;

        if (selectedDiscountName === 'Select Discount Voucher') {
            selectedDiscountName = '';
            selectedDiscountRate = '';
        }

        $('#discount-name-placeOrder').val(selectedDiscountName);
        $('#discount-rate-placeOrder').val(selectedDiscountRate);

        var orderTotal = $("#total_amount").text();
        $('#orderTotal').val(orderTotal);

        updateDiscountName();
    });

    const payMethodSelect = $("select[name='paymethod']");
    const proofAttachment = $("#proofAttachment");
    const attachmentInput = $("#paymentAttachment");
    const confirmButton = $("#btnCunfirmOrder");
    const form = $("form");


    // I-set ang initial state depende sa default na pagkakapili ng user.
    checkConfirmationStatus();

    payMethodSelect.change(checkConfirmationStatus);
    attachmentInput.change(checkConfirmationStatus);

    function checkConfirmationStatus() {
        const selectedPaymentMethod = payMethodSelect.val();
        const hasAttachment = attachmentInput[0].files.length > 0;

        if (selectedPaymentMethod === "") {

            
            confirmButton.prop("disabled", true);
            proofAttachment.hide();
            attachmentInput.prop("required", false);
        } else if (selectedPaymentMethod === "Cash on Delivery") {
            confirmButton.prop("disabled", false);  // You may want to enable the button for COD.
            proofAttachment.hide();
            attachmentInput.prop("required", false);
        } else {
            if (hasAttachment) {
                confirmButton.prop("disabled", false);
            } else {
                confirmButton.prop("disabled", true);
            }
            proofAttachment.show();
            attachmentInput.prop("required", hasAttachment);
        }
    }

    // Add an event listener to the file input
attachmentInput.on('change', function() {
    if (this.files.length > 0) {
        // Kapag may attachment, i-enable ang "Confirm" button
        confirmButton.prop("disabled", false);
    } else {
        // Kapag walang attachment, i-disable ang "Confirm" button
        confirmButton.prop("disabled", true);
    }
});


    payMethodSelect.change(function() {
        if (payMethodSelect.val() === "") {
            // If "Payment option" is selected, disable the Confirm button and hide the proofAttachment section.
            confirmButton.prop("disabled", true);
            proofAttachment.hide();
            attachmentInput.prop("required", false);
        } else if (payMethodSelect.val() === "Cash on Delivery") {
            // If "Cash on Delivery" is selected, enable the Confirm button and hide the proofAttachment section.
            confirmButton.prop("disabled", false);
            proofAttachment.hide();
            attachmentInput.prop("required", false);
        } else {
            // For other payment methods, enable the Confirm button, show the proofAttachment section, and make the attachment input required.
            confirmButton.prop("disabled", true);
            proofAttachment.show();

            const dropdown = $("#BankEwallet");
            const imageContainer = $("#paymentImage");
            const paymentNumber = $("#paymentNumber");

            const selectedOption = dropdown.find("option:selected");
            const selectedImage = selectedOption.data("image");
            const selectedNumber = selectedOption.data("number");

            imageContainer.css("background-image", `url('../upload_system/${selectedImage}')`);

            

            paymentNumber.text("Payment Number: " + selectedNumber);

            imageContainer.show();
            paymentNumber.show();
            attachmentInput.prop("required", true);
        }
    });

        // Add an event listener to the file input
    // Add an event listener to the file input
attachmentInput.on('change', function() {
    const files = this.files;
    if (files.length > 0) {
        const allowedExtensions = ['jpg', 'jpeg', 'png', 'webp']; // Add more if needed
        const fileExtension = files[0].name.split('.').pop().toLowerCase();
        
        if (allowedExtensions.includes(fileExtension)) {
            // If a valid image file is attached, enable the "Confirm" button
            confirmButton.prop("disabled", false);

            
            // Show the "proofAttachment" section
          
        } else {
            // If an invalid file is attached, disable the "Confirm" button
            confirmButton.prop("disabled", true);
            // Hide the "proofAttachment" section
            alertify.error("Upload image format only.");
            
            // Clear the file input (optional)
            this.value = ''; // This will clear the file input to prevent submitting non-image files.
        }
    } else {
        // If no file is attached, disable the "Confirm" button
        confirmButton.prop("disabled", true);
        // Hide the "proofAttachment" section
        proofAttachment.hide();
    }
});

});
