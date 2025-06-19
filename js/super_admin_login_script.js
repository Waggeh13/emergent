const container = document.querySelector('.container');
const loginBtn = document.querySelector('.login-btn');

loginBtn.addEventListener('click', () => {
    container.classList.remove('active');
});

function validation() {
  document.getElementById("idError").textContent = "";
  document.getElementById("passwordError").textContent = "";

  let isValid = true;

  var super_admin_id = document.getElementById("super_admin_id").value.trim();
  var loginPassword = document.getElementById("password").value;

  if (!/^[a-zA-Z0-9]+$/.test(super_admin_id) || super_admin_id.length < 8) {
    document.getElementById("idError").textContent = "Invalid ID (min 8 alphanumeric characters)";
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

    document.getElementById("idError").textContent = "";
    document.getElementById("passwordError").textContent = "";

    if (validation()) {
        var super_admin_id = document.getElementById("super_admin_id").value;
        var password = document.getElementById("password").value;

        try {
            const response = await fetch('../actions/super_admin_login_action.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `super_admin_id=${encodeURIComponent(super_admin_id)}&password=${encodeURIComponent(password)}`
            });

            if (response.ok) {
                const result = await response.json();
                if (result.error) {
                    if (result.message.includes("incorrect ID")) {
                        document.getElementById("idError").textContent = result.message;
                    } else if (result.message.includes("incorrect password")) {
                        document.getElementById("passwordError").textContent = result.message;
                    }
                } else {
                    window.location.href = '../view/super_admin_dashboard.php';
                }
            } else {
                document.getElementById("idError").textContent = "Server error. Please try again later.";
            }
        } catch (error) {
            document.getElementById("idError").textContent = "Network error. Please check your connection.";
        }
    }
});