document.addEventListener('DOMContentLoaded', () => {
    const container = document.querySelector('.container');
    const registerBtn = document.querySelector('.register-btn');
    const loginBtn = document.querySelector('.login-btn');
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');

    // Toggle between login and register forms
    registerBtn.addEventListener('click', () => {
        container.classList.add('active');
    });

    loginBtn.addEventListener('click', () => {
        container.classList.remove('active');
    });

    // Validation function for login
    function validateLoginForm() {
        const phoneError = document.getElementById("phoneError");
        const passwordError = document.getElementById("passwordError");
        phoneError.textContent = "";
        passwordError.textContent = "";

        let isValid = true;
        const phone_number = document.getElementById("phone_number").value.trim();
        const password = document.getElementById("password").value;

        if (!/^[0-9]{10}$/.test(phone_number)) {
            phoneError.textContent = "Invalid phone number (must be 10 digits)";
            isValid = false;
        }

        if (
            password.length < 8 ||
            !/[a-zA-Z]/.test(password) ||
            !/\d/.test(password) ||
            !/[!@#$%^&*(),.?":{}|<>]/.test(password)
        ) {
            passwordError.textContent = "Password must be at least 8 characters with letters, numbers, and a special character";
            isValid = false;
        }

        return isValid;
    }

    // Validation function for registration
    function validateRegisterForm() {
        // Check if error elements exist; if not, create and append them
        let phoneError = document.getElementById("phoneErrorRegister");
        let passwordError = document.getElementById("passwordErrorRegister");
        let cpasswordError = document.getElementById("cpasswordError");

        const registerFormBox = document.querySelector('.form-box.register');
        if (!phoneError) {
            phoneError = document.createElement('div');
            phoneError.id = "phoneErrorRegister";
            phoneError.className = "error-message";
            document.querySelector('#registerForm .input-box:nth-child(1)').appendChild(phoneError);
        }
        if (!passwordError) {
            passwordError = document.createElement('div');
            passwordError.id = "passwordErrorRegister";
            passwordError.className = "error-message";
            document.querySelector('#registerForm .input-box:nth-child(2)').appendChild(passwordError);
        }
        if (!cpasswordError) {
            cpasswordError = document.createElement('div');
            cpasswordError.id = "cpasswordError";
            cpasswordError.className = "error-message";
            document.querySelector('#registerForm .input-box:nth-child(3)').appendChild(cpasswordError);
        }

        phoneError.textContent = "";
        passwordError.textContent = "";
        cpasswordError.textContent = "";

        let isValid = true;
        const phoneNumber = document.querySelector('#registerForm input[name="phoneNumber"]').value.trim();
        const password = document.querySelector('#registerForm input[name="password"]').value;
        const cpassword = document.querySelector('#registerForm input[name="cpassword"]').value;

        if (!/^[0-9]{10}$/.test(phoneNumber)) {
            phoneError.textContent = "Invalid phone number (must be 10 digits)";
            isValid = false;
        }

        if (
            password.length < 8 ||
            !/[a-zA-Z]/.test(password) ||
            !/\d/.test(password) ||
            !/[!@#$%^&*(),.?":{}|<>]/.test(password)
        ) {
            passwordError.textContent = "Password must be at least 8 characters with letters, numbers, and a special character";
            isValid = false;
        }

        if (password !== cpassword) {
            cpasswordError.textContent = "Passwords do not match";
            isValid = false;
        }

        return isValid;
    }

    // Login form submission
    loginForm.addEventListener('submit', async (event) => {
        event.preventDefault();

        if (validateLoginForm()) {
            const phone_number = document.getElementById("phone_number").value.trim();
            const password = document.getElementById("password").value;

            try {
                const response = await fetch('../actions/user_login.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `phone_number=${encodeURIComponent(phone_number)}&password=${encodeURIComponent(password)}`
                });

                if (!response.ok) {
                    const responseText = await response.text();
                    throw new Error(`HTTP error! Status: ${response.status}, Response: ${responseText}`);
                }

                const result = await response.json();
                console.log('Login response:', result);
                if (result.error) {
                    if (result.message.includes("incorrect phone number")) {
                        document.getElementById("phoneError").textContent = result.message;
                    } else if (result.message.includes("incorrect password")) {
                        document.getElementById("passwordError").textContent = result.message;
                    } else {
                        document.getElementById("phoneError").textContent = result.message;
                    }
                } else {
                    window.location.href = '../view/user_dashboard.php';
                }
            } catch (error) {
                console.error('Login error:', error, { stack: error.stack });
                document.getElementById("phoneError").textContent = "Network error. Please check your connection.";
            }
        }
    });

    // Register form submission
    registerForm.addEventListener('submit', async (event) => {
        event.preventDefault();

        if (validateRegisterForm()) {
            const formData = new FormData(registerForm);
            console.log('Register form data:', Object.fromEntries(formData));

            try {
                const response = await fetch('../actions/user_register.php', {
                    method: 'POST',
                    body: formData,
                });

                if (!response.ok) {
                    const responseText = await response.text();
                    throw new Error(`HTTP error! Status: ${response.status}, Response: ${responseText}`);
                }

                const result = await response.json();
                console.log('Register response:', result);
                if (result.success) {
                    console.log('Registration successful:', result.message);
                    container.classList.remove('active');
                } else {
                    console.error('Registration failed:', result.message);
                    const phoneErrorRegister = document.getElementById("phoneErrorRegister");
                    if (phoneErrorRegister) {
                        phoneErrorRegister.textContent = result.message;
                    } else {
                        console.error('phoneErrorRegister element not found');
                    }
                }
            } catch (error) {
                console.error('Register error:', error, { stack: error.stack });
                const phoneErrorRegister = document.getElementById("phoneErrorRegister");
                if (phoneErrorRegister) {
                    phoneErrorRegister.textContent = "Network error. Please check your connection.";
                } else {
                    console.error('phoneErrorRegister element not found');
                }
            }
        }
    });
});