
document.addEventListener('DOMContentLoaded', function () {

    const emailInput = document.getElementById('email');
    const usernameInput = document.getElementById('username');
    const emailError = document.getElementById('emailError');
    const usernameError = document.getElementById('usernameError');
    const submitButton = document.getElementById('submitButton');
    
    // Regular expression for validating Gmail-like email format
    const emailRegex = /^[a-zA-Z0-9._%+-]+@gmail\.com$/i;
    
    let isEmailValid = false;
    let isUsernameValid = false;
    
    emailInput.addEventListener('input', async () => {
        const email = emailInput.value;
        if (!email.match(emailRegex)) {
            emailError.textContent = 'Invalid Gmail format';
            emailInput.required = true;
            isEmailValid = false;
            checkEnableSubmitButton();
            return;
        }
    
        try {
            const response = await checkEmailExists(email);
            emailError.textContent = response;
    
            if (response === '') {
                isEmailValid = true;
                checkEnableSubmitButton();
            } else {
                isEmailValid = false;
                checkEnableSubmitButton();
            }
        } catch (error) {
            console.error(error);
            emailError.textContent = 'Error checking email';
            emailInput.required = true;
            isEmailValid = false;
            checkEnableSubmitButton();
        }
    });
    
    usernameInput.addEventListener('input', async () => {
        const username = usernameInput.value;
        try {
            const response = await checkUsernameExists(username);
            usernameError.textContent = response;
    
            if (response === '') {
                isUsernameValid = true;
                checkEnableSubmitButton();
            } else {
                isUsernameValid = false;
                checkEnableSubmitButton();
            }
        } catch (error) {
            console.error(error);
            usernameError.textContent = 'Error checking username';
            isUsernameValid = false;
            checkEnableSubmitButton();
        }
    });
    
    function checkEnableSubmitButton() {
        if (isEmailValid && isUsernameValid) {
            submitButton.disabled = false;
        } else {
            submitButton.disabled = true;
        }
    }
    
    async function checkEmailExists(email) {
        try {
            const response = await fetch(`../controller/signup/check_email.php?email=${email}`);
            const data = await response.text();
            return data;
        } catch (error) {
            console.error(error);
            return 'Error checking email';
        }
    }
    
    async function checkUsernameExists(username) {
        try {
            const response = await fetch(`../controller/signup/check_username.php?username=${username}`);
            const data = await response.text();
            return data;
        } catch (error) {
            console.error(error);
            return 'Error checking username';
        }
    }
    });
    