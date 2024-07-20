// $(document).ready(function () {
//     const fnameInput = $('input[name="fname"]');
//     const lnameInput = $('input[name="lname"]');
//     const usernameInput = $('#username');
//     const passwordInput = $('#password');
//     const contactInput = $('input[name="contact"]');
//     const birthdateInput = $('input[name="bday"]');
//     const emailInput = $('#email');
//     const confirmPasswordInput = $('#confirmPassword');
//     const submitButton = $('#submitButton');

//     // Function to validate first name and last name
//     function validateName(name) {
//         return /^[a-zA-Z ]{2,}$/.test(name);
//     }

//     // Function to validate username and password length
//     function validateLength(value) {
//         return value.length >= 5;
//     }

//     // Function to validate contact number
//     function validateContact(contact) {
//         return /^[0-9]{11}$/.test(contact) && contact.startsWith('09');
//     }

//     // Function to validate age (not less than 11 years)
//     function validateAge(birthdate) {
//         const birthdateDate = new Date(birthdate);
//         const currentDate = new Date();
//         const age = currentDate.getFullYear() - birthdateDate.getFullYear();
//         return age >= 11;
//     }

//     // Function to validate email address
//     function validateEmail(email) {
//         const emailRegex = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;
//         return emailRegex.test(email);
//     }

//     // Function to handle form submission
//     function handleSubmit(event) {
//         // Reset any previous error messages and styling
//         $('.error').text('');
//         resetStyles();

//         let hasError = false;

//         if (!validateName(fnameInput.val())) {
//             $('#fnameError').text('First name must have at least 2 alphabetical characters.');
//             alertify.error("First name must have at least 2 alphabetical characters")
//             setStyleInvalid(fnameInput);
//             hasError = true;
//         }

//         if (!validateName(lnameInput.val())) {
//             $('#lnameError').text('Last name must have at least 2 alphabetical characters.');
//             alertify.error("Last name must have at least 2 alphabetical characters")
//             setStyleInvalid(lnameInput);
//             hasError = true;
//         }

//         if (!validateLength(usernameInput.val())) {
//             $('#usernameLengthError').text('Username must have at least 5 characters.');
//             alertify.error("Username must have at least 5 characters")
//             setStyleInvalid(usernameInput);
//             hasError = true;
//         }

//         if (!validateLength(passwordInput.val())) {
//             $('#passwordError').text('Password must have at least 5 characters.');
//             alertify.error("Password must have at least 5 characters")
//             setStyleInvalid(passwordInput);
//             hasError = true;
//         }

//         if (!validateContact(contactInput.val())) {
//             $('#contactError').text('Contact must be 11 digits and start with "09".');
//             alertify.error("Contact must be 11 digits and start with 09.")
//             setStyleInvalid(contactInput);
//             hasError = true;
//         }

//         if (!validateAge(birthdateInput.val())) {
//             $('#birthdateError').text('Age must be at least 11 years old.');
//             alertify.error("Age must be at least 11 years old")
//             setStyleInvalid(birthdateInput);
//             hasError = true;
//         }

//         // Check if the password fields match
//         const password1 = passwordInput.val();
//         const password2 = confirmPasswordInput.val();

//         if (password1 !== password2) {
//             $('#passwordMatchError').text('Passwords do not match.');
//             alertify.error("Passwords do not match")
//             setStyleInvalid(passwordInput);
//             setStyleInvalid(confirmPasswordInput);
//             hasError = true;
//         }

//         if (!validateEmail(emailInput.val())) {
//             $('#emailError').text('Invalid Gmail address.');
//             alertify.error("Invalid Gmail address")
//             setStyleInvalid(emailInput);
//             hasError = true;
//         }

//         // If there are errors, prevent form submission
//         if (hasError) {
//             event.preventDefault();
//         }
//     }

//     // Function to set invalid styling
//     function setStyleInvalid(element) {
//         element.css('border', '2px solid red');
//     }

//     // Function to reset styles
//     function resetStyles() {
//         $('input').css('border', '1px solid #ccc');
//     }

//     // Add event listeners for input fields using jQuery
//     fnameInput.on('input', function () {
//         $('#fnameError').text('');
//         fnameInput.css('border', '1px solid #ccc');
//     });

//     lnameInput.on('input', function () {
//         $('#lnameError').text('');
//         lnameInput.css('border', '1px solid #ccc');
//     });

//     usernameInput.on('input', function () {
//         $('#usernameLengthError').text('');
//         usernameInput.css('border', '1px solid #ccc');
//     });

//     passwordInput.on('input', function () {
//         $('#passwordError').text('');
//         passwordInput.css('border', '1px solid #ccc');
//     });

//     contactInput.on('input', function () {
//         $('#contactError').text('');
//         contactInput.css('border', '1px solid #ccc');
//     });

//     birthdateInput.on('input', function () {
//         $('#birthdateError').text('');
//         birthdateInput.css('border', '1px solid #ccc');
//     });

//     emailInput.on('input', function () {
//         $('#emailError').text('');
//         emailInput.css('border', '1px solid #ccc');
//     });

//     // Add event listener for form submission using jQuery
//     submitButton.on('click', handleSubmit);
// });
