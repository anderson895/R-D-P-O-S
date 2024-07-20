$(document).ready(function() {
 // Get references to the form input fields
 const emailInput = document.getElementById('email');
 const usernameInput = document.getElementById('username');
 const fnameInput = document.getElementById('fname');
 const lnameInput = document.getElementById('lname');
 const phoneInput = document.getElementById('phone');
 


 
 //const selectionAccountTypeInput = document.getElementById('selectionAccountType');
 const selectionAccountTypeInput = $("#selectionAccountType");
 const passwordInput = document.getElementById('password');
 const cunfirmpasswordInput = document.getElementById('cunfirmpassword');
 const UserimageUploadTypeInput = document.getElementById('UserimageUpload');
 
 // Get error message elements
 const usernameError = document.getElementById('usernameError');
 const usernameLengError = document.getElementById('usernameLengError');

 const fnameError = document.getElementById('fnameError');
 const lnameError = document.getElementById('lnameError');
 const phoneError = document.getElementById('phoneError');
 const accountTypeError = document.getElementById('accountTypeError');
 const passwordError = document.getElementById('passwordError');
 const cunfirmpasswordError = document.getElementById('cunfirmpasswordError');
 const UserimageUploadError = document.getElementById('UserimageUploadError');


 const emailRegex = /^[a-zA-Z0-9._%+-]+@gmail\.com$/i;
 const phoneRegex = /^09\d{9}$/; // 11 digits starting with '09'


 
 let isEmailValid = false;
 let isUsernameValid = false;
 let isFnameValid = false;
 let isLnameValid = false;
 let isPhoneValid = false;
 let isAccountTypeValid = false;
 let isPasswordValid = false;
 let isCunfirmpasswordValid = false;
 let isUserImageValid = false;



 accountTypeError.textContent = 'Please select an account type.';
 usernameLengError.textContent = 'Username must be at least 4 characters long.';
 fnameError.textContent = 'First name must be at least 4 characters long.';
 lnameError.textContent = 'Last name must be at least 4 characters long.';
phoneError.textContent = 'Phone number It should start with 09 and have 11 digits.';
passwordError.textContent = 'Password must be at least 6 characters long.';
   UserimageUploadError.textContent = 'Please select an image file.';
  emailError.textContent = 'Use gmail format only';
  

 $("#selectionAccountType").on( "change", function() {
            if (selectionAccountTypeInput.val() === 'Select') {
                accountTypeError.textContent = 'Please select an account type.';
                isAccountTypeValid = false;
                checkEnableSubmitButton();
                
            } else {
                accountTypeError.textContent = '';
                isAccountTypeValid = true;
             
                checkEnableSubmitButton();
            }
        });

 // Event listener for the 'username' field
 usernameInput.addEventListener('input', () => {
     const username = usernameInput.value;
     if (username.length < 4) {
        usernameLengError.textContent = 'Username must be at least 4 characters long.';
         isUsernameValid = false;
         checkEnableSubmitButton();
     } else {
        usernameLengError.textContent = '';
         isUsernameValid = true;
         checkEnableSubmitButton();
     }
 });

// Event listener for the 'fname' field
fnameInput.addEventListener('input', () => {
    const fname = fnameInput.value;
    const regex = /^[a-zA-Z,.\s]+$/; // Ito ay regular expression na pumipigil sa mga numero, espesyal na karakter maliban sa koma at decimal

    if (fname.length < 4) {
        fnameError.textContent = 'First name must be at least 4 characters long.';
        isFnameValid = false;
        checkEnableSubmitButton();
    } else if (!regex.test(fname)) {
        fnameError.textContent = 'First name may only contain letters, comma, and decimal.';
        isFnameValid = false;
        checkEnableSubmitButton();
    } else {
        fnameError.textContent = '';
        isFnameValid = true;
        checkEnableSubmitButton();
    }
});

// Event listener for the 'lname' field
lnameInput.addEventListener('input', () => {
    const lname = lnameInput.value;
    const regex = /^[a-zA-Z,.\s]+$/; // Ito ay regular expression na pumipigil sa mga numero, espesyal na karakter maliban sa koma at decimal

    if (lname.length < 4) {
        lnameError.textContent = 'Last name must be at least 4 characters long.';
        isLnameValid = false;
        checkEnableSubmitButton();
    } else if (!regex.test(lname)) {
        lnameError.textContent = 'Last name may only contain letters, comma, and decimal.';
        isLnameValid = false;
        checkEnableSubmitButton();
    } else {
        lnameError.textContent = '';
        isLnameValid = true;
        checkEnableSubmitButton();
    }
});


 // Event listener for the 'phone' field
 phoneInput.addEventListener('input', () => {
     const phone = phoneInput.value;
     if (!phone.match(phoneRegex)) {
         phoneError.textContent = 'Invalid phone number format. It should start with 09 and have 11 digits.';
         isPhoneValid = false;
         checkEnableSubmitButton();
     } else {
         phoneError.textContent = '';
         isPhoneValid = true;
         checkEnableSubmitButton();
     }
 });



 // Event listener for the 'password' field
 passwordInput.addEventListener('input', () => {
     const password = passwordInput.value;
     if (password.length < 6) {
         passwordError.textContent = 'Password must be at least 6 characters long.';
         isPasswordValid = false;
         checkEnableSubmitButton();
     } else {
         passwordError.textContent = '';
         isPasswordValid = true;
         checkEnableSubmitButton();
     }
 });

 // Event listener for the 'cunfirmpassword' field
 cunfirmpasswordInput.addEventListener('input', () => {
     const confirmPassword = cunfirmpasswordInput.value;
     const password = passwordInput.value;
     if (confirmPassword !== password) {
         cunfirmpasswordError.textContent = 'Passwords do not match.';
         isCunfirmpasswordValid = false;
         checkEnableSubmitButton();
     } else {
         cunfirmpasswordError.textContent = '';
         isCunfirmpasswordValid = true;
         checkEnableSubmitButton();
     }
 });

 // Event listener for the 'UserimageUpload' field
 UserimageUploadTypeInput.addEventListener('change', () => {
     const file = UserimageUploadTypeInput.files[0];
     if (!file) {
         UserimageUploadError.textContent = 'Please select an image file.';
         isUserImageValid = false;
         checkEnableSubmitButton();
     } else {
         const fileType = file.type;
         if (fileType.startsWith('image/')) {
             UserimageUploadError.textContent = '';
             isUserImageValid = true;
             checkEnableSubmitButton();
         } else {
             UserimageUploadError.textContent = 'Please select an image file.';
             isUserImageValid = false;
             checkEnableSubmitButton();
         }
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


    
    async function checkEmailExists(email) {
        try {
            
            var account_id = $("#account_id").val();
            const response = await fetch(`adduser/controller/check_email.php?email=${email}&account_id=${account_id}`);
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
            const response = await fetch(`adduser/controller/check_username.php?username=${username}&account_id=${account_id}`);
            const data = await response.text();
            return data;
        } catch (error) {
            console.error(error);
            return 'Error checking username';
        }
    }

 function checkEnableSubmitButton() {



    if (isEmailValid &&
        isAccountTypeValid &&
        isUsernameValid &&
        isFnameValid &&
        isLnameValid &&
        isPhoneValid &&
        isPasswordValid &&
        isCunfirmpasswordValid &&
        isUserImageValid
    ) {
        submitButton.disabled = false;
    } else {
        submitButton.disabled = true;
    }
}


checkEnableSubmitButton();

    });
    