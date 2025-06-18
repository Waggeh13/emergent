const container = document.querySelector('.container');
const registerBtn = document.querySelector('.register-btn');
const loginBtn = document.querySelector('.login-btn');

registerBtn.addEventListener('click', () => {
    container.classList.add('active');
});

loginBtn.addEventListener('click', () => {
    container.classList.remove('active');
});

function validation() {
    document.getElementById("phoneError").textContent = "";
    document.getElementById("passwordError").textContent = "";

    let isValid = true;

    var phone_number = document.getElementById("phone_number").value.trim();
    var loginPassword = document.getElementById("password").value;

    if (!/^[0-9]{10}$/.test(phone_number)) {
        document.getElementById("phoneError").textContent = "Invalid phone number (must be 10 digits)";
        isValid = false;
    }

    if (
        loginPassword.length < 8 ||
        !/[a-zA-Z]/.test(loginPassword) ||
        !/\d/.test(loginPassword) ||
        !/[!@#$%^&*(),.?":{}|<>]/.test(loginPassword)
    ) {
        document.getElementById("passwordError").textContent = "Password must be at least 8 characters with letters, numbers, and a special character";
        isValid = false;
    }

    return isValid;
}

document.getElementById('loginForm').addEventListener('submit', async function (event) {
    event.preventDefault();

    document.getElementById("phoneError").textContent = "";
    document.getElementById("passwordError").textContent = "";

    if (validation()) {
        var phone_number = document.getElementById("phone_number").value;
        var password = document.getElementById("password").value;

        try {
            const response = await fetch('../actions/user_login.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `phone_number=${encodeURIComponent(phone_number)}&password=${encodeURIComponent(password)}`
            });

            if (response.ok) {
                const result = await response.json();
                if (result.error) {
                    if (result.message.includes("incorrect phone number")) {
                        document.getElementById("phoneError").textContent = result.message;
                    } else if (result.message.includes("incorrect password")) {
                        document.getElementById("passwordError").textContent = result.message;
                    }
                } else {
                    window.location.href = '../view/user_dashboard.php';
                }
            } else {
                document.getElementById("phoneError").textContent = "Server error. Please try again later.";
            }
        } catch (error) {
            document.getElementById("phoneError").textContent = "Network error. Please check your connection.";
        }
    }
});