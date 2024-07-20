function validateGmail(gmail) {
    var pattern = /^[a-zA-Z0-9._%+-]+@gmail\.com$/i;
    return pattern.test(gmail);
}


// Function to validate Full Name format
function validateFullName(fullname) {
    var pattern = /^[a-zA-Z\s]{5,}$/;
    return pattern.test(fullname);
}

// Function to validate Phone Number format
function validatePhoneNumber(phoneNumber) {
    var pattern = /^09\d{9}$/;
    return pattern.test(phoneNumber);
}

// Event listener for input changes
$('#gmail, #fullname, #phoneNumber').on('input', function() {
    var gmail = $('#gmail').val();
    var fullname = $('#fullname').val();
    var phoneNumber = $('#phoneNumber').val();
    var errorDiv = $('#errorDiv');
    errorDiv.empty(); // Clear previous error messages
        $('#ConfirmSelectAddress').prop('disabled', false);
        $('#ConfirmPinAddress').prop('disabled', false);
    // Perform validation and display errors
    if (!validateGmail(gmail)) {
        errorDiv.append("Invalid Gmail format. It should end with @gmail.com<br>");
        $('#ConfirmSelectAddress').prop('disabled', true);
        $('#ConfirmPinAddress').prop('disabled', true);
    }
    if (!validateFullName(fullname)) {
        errorDiv.append("Full Name should have at least 5 letters and no numbers<br>");
        $('#ConfirmSelectAddress').prop('disabled', true);
        $('#ConfirmPinAddress').prop('disabled', true);
    }
    if (!validatePhoneNumber(phoneNumber)) {
        errorDiv.append("Invalid Phone Number format. It should start with 09 and have 11 digits<br>");
        $('#ConfirmSelectAddress').prop('disabled', true);
        $('#ConfirmPinAddress').prop('disabled', true);
    }
});  



//start validation for edit form

$('#edit_Fullname, #edit_email, #edit_Contact').on('input', function() {
    var gmail = $('#edit_email').val();
    var fullname = $('#edit_Fullname').val();
    var phoneNumber = $('#edit_Contact').val();
    var EditFormerrorDiv = $('#EditFormerrorDiv');
    EditFormerrorDiv.empty(); // Clear previous error messages
        $('#saveButton').prop('disabled', false);
       
    // Perform validation and display errors
    if (!validateGmail(gmail)) {
        EditFormerrorDiv.append("Invalid Gmail format. It should end with @gmail.com<br>");
        $('#saveButton').prop('disabled', true);
     
    }
    if (!validateFullName(fullname)) {
        EditFormerrorDiv.append("Full Name should have at least 5 letters and no numbers<br>");
        $('#saveButton').prop('disabled', true);
      
    }
    if (!validatePhoneNumber(phoneNumber)) {
        EditFormerrorDiv.append("Invalid Phone Number format. It should start with 09 and have 11 digits<br>");
        $('#saveButton').prop('disabled', true);
       
    }
});  
//end validation for edit form