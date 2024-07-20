const passwordInput = document.getElementById('newpassword');
        const confirmPasswordInput = document.getElementById('confirmPassword');
        const errorText = document.getElementById('errorText');

        const validatePassword = () => {
            const password = passwordInput.value;
            const confirmPassword = confirmPasswordInput.value;

            const hasMinimumLength = password.length >= 8;
            const hasNumbersAndSpecialChars = /^(?=.*\d)(?=.*[\W_]).*$/.test(password);

            if (password === confirmPassword) {
                if (hasMinimumLength && hasNumbersAndSpecialChars) {
                    if (/^[a-zA-Z]*$/.test(password)) {
                        errorText.textContent = 'Weak Password';
                        errorText.classList.remove('success', 'warning', 'info');
                        errorText.classList.add('error');
                        submitButton.disabled = false;
                    } else if (hasNumbersAndSpecialChars && password.length >= 12) {
                        errorText.textContent = 'Strong Password';
                        errorText.classList.remove('error', 'warning', 'info');
                        errorText.classList.add('success');
                        submitButton.disabled = false;
                    } else {
                        errorText.textContent = 'Good Password';
                        errorText.classList.remove('error', 'success', 'info');
                        errorText.classList.add('warning');
                        submitButton.disabled = false;
                    }
                } else {
                    errorText.textContent = 'Tips: password must at least 12 characters in length, combined with numbers and special characters.';
                    errorText.classList.remove('success', 'warning', 'error');
                    errorText.classList.add('info');
                    submitButton.disabled = false;
                }
            } else {
                errorText.textContent = 'Passwords do not match';
                errorText.classList.remove('success', 'warning', 'info');
                errorText.classList.add('error');
                submitButton.disabled = true;
            }
        };

        passwordInput.addEventListener('input', validatePassword);
        confirmPasswordInput.addEventListener('input', validatePassword);