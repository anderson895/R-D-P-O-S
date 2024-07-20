
document.addEventListener('DOMContentLoaded', function () {

    

    const OldpasswordInput = document.getElementById('oldPasword');
    const emailInput = document.getElementById('email');
    const usernameInput = document.getElementById('username');

    
    const oldpassError = document.getElementById('oldpassError');
    const emailError = document.getElementById('emailError');
    const usernameError = document.getElementById('usernameError');
    const submitButton = document.getElementById('submitButton');
   
    const emailRegex = /^[a-zA-Z0-9._%+-]+@gmail\.com$/i;
    let isPasswordCorrectValid = false;
    let isEmailValid = false;
    let isUsernameValid = false;
    

    
    OldpasswordInput.addEventListener('input', async () => {
        const Oldpassword = OldpasswordInput.value;
        try {
            const response = await checkPasswordExists(Oldpassword);
            oldpassError.textContent = response;
    
            if (response === '') {
               
                isPasswordCorrectValid = true;
                
                checkEnableSubmitButton();
            } else {
                
                isPasswordCorrectValid = false;
                checkEnableSubmitButton();
            }
        } catch (error) {
            console.error(error);
            oldpassError.textContent = 'Error checking email';
            OldpasswordInput.required = true;
            isPasswordCorrectValid = false;
            checkEnableSubmitButton();
        }
    });


    emailInput.addEventListener('input', async () => {
        const email = emailInput.value;
        if (!email.match(emailRegex)) {
            emailError.textContent = 'Invalid gmail format';
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
       
        
        if (isEmailValid && isUsernameValid && isPasswordCorrectValid) {
            submitButton.disabled = false;
        } else {
            submitButton.disabled = true;
        }
    }


    async function checkPasswordExists(Oldpassword) {
        try {
            
            var account_id = $("#account_id").val();
            const response = await fetch(`profile/controller/check_oldpassword.php?Oldpassword=${Oldpassword}&account_id=${account_id}`);
            const data = await response.text();
            return data;
        } catch (error) {
            console.error(error);
            return 'Error checking email';
        }
    }
    
    async function checkEmailExists(email) {
        try {
            
            var account_id = $("#account_id").val();
            const response = await fetch(`profile/controller/check_email.php?email=${email}&account_id=${account_id}`);
            const data = await response.text();
            return data;
        } catch (error) {
            console.error(error);
            return 'Error checking email';
        }
    }
    
    async function checkUsernameExists(username) {
        try {
            var account_id = $("#account_id").val();
            const response = await fetch(`profile/controller/check_username.php?username=${username}&account_id=${account_id}`);
            const data = await response.text();
            return data;
        } catch (error) {
            console.error(error);
            return 'Error checking username';
        }
    }


     OldpasswordInput.dispatchEvent(new Event('input'));
    emailInput.dispatchEvent(new Event('input'));
    usernameInput.dispatchEvent(new Event('input'));
    });
    