document.addEventListener('DOMContentLoaded', function () {
    const fnameInput = document.querySelector('input[name="fname"]');
    const lnameInput = document.querySelector('input[name="lname"]');
    const usernameInput = document.querySelector('#username');
    const passwordInput = document.querySelector('#password');
    const submitButton = document.querySelector('#submitButton');

    // Function to validate first name and last name
    function validateName(name) {
        return /^[a-zA-Z ]{2,}$/.test(name);
    }

    // Function to validate username and password length
    function validateLength(value) {
        return value.length >= 5;
    }

    // Function to handle form submission
    function handleSubmit(event) {
        if (!validateName(fnameInput.value) || !validateName(lnameInput.value) || !validateLength(usernameInput.value) || !validateLength(passwordInput.value)) {
            var errorText = document.querySelector('#errorText');
            errorText.textContent = 'Please Enter valid Data before Next.';
            errorText.style.color = 'red';
            
            event.preventDefault(); // Prevent form submission
        }
    }

    // Add event listeners for input fields
    fnameInput.addEventListener('input', function () {
        if (!validateName(fnameInput.value)) {
            document.querySelector('#fnameError').textContent = 'First name must have at least 2 alphabetical characters.';
        } else {
            document.querySelector('#fnameError').textContent = '';
        }
    });

    lnameInput.addEventListener('input', function () {
        if (!validateName(lnameInput.value)) {
            document.querySelector('#lnameError').textContent = 'Last name must have at least 2 alphabetical characters.';
        } else {
            document.querySelector('#lnameError').textContent = '';
        }
    });

    usernameInput.addEventListener('input', function () {
        if (!validateLength(usernameInput.value)) {
            document.querySelector('#usernameLengthError').textContent = 'Username must have at least 5 characters.';
        } else {
            document.querySelector('#usernameLengthError').textContent = '';
        }
    });

    passwordInput.addEventListener('input', function () {
        if (!validateLength(passwordInput.value)) {
            document.querySelector('#passwordError').textContent = 'Password must have at least 5 characters.';
        } else {
            document.querySelector('#passwordError').textContent = '';
        }
    });

    // Add event listener for form submission
    submitButton.addEventListener('click', handleSubmit);
});