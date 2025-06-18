<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/login.css">
    <title>Login</title>

</head>
    <body>
        <div class="container">
            <div class="form-box login">
                <form id="loginForm" method="POST">
                    <h1>Login</h1>
                    <div class="input-box">
                        <input type=text name="phone_number" id="phone_number" placeholder="Phone Number" required>
                        <i class="fas fa-user"></i>
                        <div id="phoneError" class="error-message"></div><br>
                    </div>
                    <div class="input-box">
                        <input type=password name="password" id="password" placeholder="Password" required>
                        <i class="fas fa-lock"></i>
                        <div id="passwordError" class="error-message"></div><br>
                    </div>
                    <div class="forgot-link">
                        <a href="#">Forgot password?</a>
                    </div>
                    <button type="submit" class="btn">Login</button>
                </form>
            </div>

            <div class="form-box register">
                <form id="registerForm" method="POST">
                    <h1>Registration</h1>
                    <div class="input-box">
                        <input type=text name="phoneNumber" placeholder="Phone Number" required>
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="input-box">
                        <input type=password name="password" placeholder="Password" required>
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="input-box">
                        <input type=password name="cpassword" placeholder="Confirm Password" required>
                        <i class="fas fa-lock"></i>
                    </div>
                    <button type="submit" class="btn">Register</button>
                </form>
            </div>

            <div class="toggle-box">
                <div class="toggle-panel toggle-left">
                    <h1>Hello, Welcome!</h1>
                    <p>Don't have an account?</p>
                    <button class="btn register-btn">Register</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Welcome Back!</h1>
                    <p>Already have an account?</p>
                    <button class="btn login-btn">Login</button>
                </div>
            </div>
        </div>

        <script src="../js/login_script.js"></script>
    </body>
</html>
