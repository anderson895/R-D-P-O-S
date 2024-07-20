$(document).ready(function() {
    // Variables
    var $supplierName = $("input[name='supplierName']");
    var $email = $("input[name='email']");
    var $phone = $("input[name='phone']");
    var $Address = $("input[name='Address']");

    var $btnSubmit = $('#btnAddSupplier');

    var $errorSupplierName = $("#errorSupplierName");
    var $errorEmail = $("#errorEmail");
    var $errorPhone = $("#errorPhone");
    var $errorAddress = $("#errorAddress");
    var allFieldsValid = true;

    // Function to hide error messages
    function hideErrorMessages() {
        $errorSupplierName.css('display', 'none');
        $errorEmail.css('display', 'none');
        $errorPhone.css('display', 'none');
        $errorAddress.css('display', 'none');
    }

    // Function to validate the form
    function validateForm() {
        hideErrorMessages();
        allFieldsValid = true; // Reset the flag to true initially

        if ($supplierName.val() === "") {
            allFieldsValid = false;
            $errorSupplierName.text("Supplier Name is required.");
            $errorSupplierName.css('display', 'block');
            return;
        } else if ($supplierName.val().length <= 3) {
            allFieldsValid = false;
            $errorSupplierName.text("Supplier Name must be more than 3 characters.");
            $errorSupplierName.css('display', 'block');
            return;
        }

        var emailPattern = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;
        var phoneRegex = /^(09|11)\d{9}$/;

        if ($email.val() === "") {
            allFieldsValid = false;
            $errorEmail.text("Email is required.");
            $errorEmail.css('display', 'block');
            return;
        } else if ($email.val().length <= 3) {
            allFieldsValid = false;
            $errorEmail.text("Email must be more than 3 characters.");
            $errorEmail.css('display', 'block');
            return;
        } else if (!emailPattern.test($email.val())) {
            allFieldsValid = false;
            $errorEmail.text("Invalid email format. Please use a valid @gmail.com address.");
            $errorEmail.css('display', 'block');
            return;
        }

        if ($phone.val() === "") {
            allFieldsValid = false;
            $errorPhone.text("Phone number is required.");
            $errorPhone.css('display', 'block');
            return;
        } else if (!phoneRegex.test($phone.val())) {
            allFieldsValid = false;
            $errorPhone.text("Phone number must start with 09 or 11 and be 11 digits long.");
            $errorPhone.css('display', 'block');
            return;
        }

        if ($Address.val() === "") {
            allFieldsValid = false;
            $errorAddress.text("Description is required.");
            $errorAddress.css('display', 'block');
            return;
        } else if ($Address.val() && $Address.val().length < 10) {
            allFieldsValid = false;
            $errorAddress.text("Description must be at least 10 characters.");
            $errorAddress.css('display', 'block');
            return;
        }

        $btnSubmit.prop('disabled', false);
    }

    // Event listeners for input fields
    $supplierName.on('input', validateForm);
    $email.on('input', validateForm);
    $phone.on('input', validateForm);
    $Address.on('input', validateForm);

});
