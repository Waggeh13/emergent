document.addEventListener('DOMContentLoaded', () => {
    const container = document.querySelector('.container');
    const loginForm = document.getElementById('loginForm');

    function validation() {
        const idError = document.getElementById("idError");
        const passwordError = document.getElementById("passwordError");
        idError.textContent = "";
        passwordError.textContent = "";

        let isValid = true;
        const admin_id = document.getElementById("admin_id").value.trim();
        const password = document.getElementById("password").value;

        if (!/^[a-zA-Z0-9]+$/.test(admin_id) || admin_id.length < 8) {
            idError.textContent = "Invalid user ID (min 8 alphanumeric characters)";
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

    loginForm.addEventListener('submit', async (event) => {
        event.preventDefault();

        if (validation()) {
            const admin_id = document.getElementById("admin_id").value.trim();
            const password = document.getElementById("password").value;

            try {
                const response = await fetch('../actions/admin_login_action.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `admin_id=${encodeURIComponent(admin_id)}&password=${encodeURIComponent(password)}`
                });

                if (response.ok) {
                    const result = await response.json();

                    if (result.error) {
                        if (result.message.includes("incorrect admin ID")) {
                            document.getElementById("idError").textContent = result.message;
                        } else if (result.message.includes("Incorrect password")) {
                            document.getElementById("passwordError").textContent = result.message;
                        }
                    } else {
                        window.location.href = '../view/admin_dashboard.php';
                    }
                } else {
                    document.getElementById("idError").textContent = "Server error. Please try again later.";
                }
            } catch (error) {
                document.getElementById("idError").textContent = "Network error. Please check your connection.";
            }
        }
    });
});