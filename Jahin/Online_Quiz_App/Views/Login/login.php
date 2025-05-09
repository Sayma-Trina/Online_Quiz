<?php
require_once __DIR__ . '/../../Middleware/SessionHandler.php';
SessionHandler::init();

// If user is already logged in, redirect to appropriate dashboard
if (SessionHandler::getUserId()) {
    if (SessionHandler::getUserRole() === 'admin') {
        header('Location: /Admin/dashboard.php');
    } else {
        header('Location: /Pages/quiz.php');
    }
    exit();
}

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'login') {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        
        // TODO: Add proper validation and database authentication
        // This is a placeholder for demonstration
        if ($email && $password) {
            // Simulate successful login
            SessionHandler::setUser(1, 'user');
            header('Location: /Pages/quiz.php');
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Online Quiz System</title>
    <link rel="stylesheet" href="/Assets/CSS/style.css">
</head>
<body class="login-page">
    <div class="container">
        <div class="login-container">
            <div class="tabs">
                <button class="tab active" onclick="showTab('login')">Login</button>
                <button class="tab" onclick="showTab('register')">Register</button>
            </div>

            <div id="loginTab" class="tab-content active">
                <form id="loginForm" method="POST" action="">
                    <input type="hidden" name="action" value="login">
                    <div class="form-group">
                        <input type="email" id="loginEmail" name="email" placeholder="Email" required>
                        <div class="error-message"></div>
                    </div>
                    <div class="form-group">
                        <input type="password" id="loginPassword" name="password" placeholder="Password" required>
                        <div class="error-message"></div>
                    </div>
                    <button type="submit" class="btn-primary">Login</button>
                </form>
            </div>

            <div id="registerTab" class="tab-content">
                <form id="registerForm" method="POST" action="">
                    <input type="hidden" name="action" value="register">
                    <div class="form-group">
                        <input type="text" id="registerName" name="name" placeholder="Full Name" required>
                        <div class="error-message"></div>
                    </div>
                    <div class="form-group">
                        <input type="email" id="registerEmail" name="email" placeholder="Email" required>
                        <div class="error-message"></div>
                    </div>
                    <div class="form-group">
                        <input type="password" id="registerPassword" name="password" placeholder="Password" required>
                        <div class="password-strength">
                            <div class="meter"></div>
                        </div>
                        <div class="error-message"></div>
                    </div>
                    <div class="form-group">
                        <input type="password" id="confirmPassword" name="confirm_password" placeholder="Confirm Password" required>
                        <div class="error-message"></div>
                    </div>
                    <button type="submit" class="btn-primary">Register</button>
                </form>
            </div>
        </div>
    </div>

    <script src="/Assets/JS/login-handler.js"></script>
    <script>
        function showTab(tabName) {
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.remove('active');
            });
            document.querySelectorAll('.tab').forEach(tab => {
                tab.classList.remove('active');
            });

            document.getElementById(tabName + 'Tab').classList.add('active');
            document.querySelector(`button[onclick="showTab('${tabName}')"]`).classList.add('active');
        }

        function checkPasswordStrength(password) {
            const meter = document.querySelector('.password-strength .meter');
            let strength = 0;

            if (password.length >= 8) strength++;
            if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
            if (password.match(/\d/)) strength++;

            if (strength === 3) {
                meter.style.width = '100%';
                meter.style.backgroundColor = '#4CAF50';
            } else if (strength === 2) {
                meter.style.width = '66%';
                meter.style.backgroundColor = '#FFA500';
            } else if (strength === 1) {
                meter.style.width = '33%';
            } else {
                meter.style.width = '0';
            }

            return strength;
        }

        document.getElementById('registerPassword').addEventListener('input', (e) => {
            checkPasswordStrength(e.target.value);
        });

        // Form validation
        function showError(input, message) {
            const errorDiv = input.nextElementSibling;
            if (errorDiv && errorDiv.classList.contains('error-message')) {
                errorDiv.textContent = message;
                errorDiv.style.display = 'block';
            }
        }

        function clearError(input) {
            const errorDiv = input.nextElementSibling;
            if (errorDiv && errorDiv.classList.contains('error-message')) {
                errorDiv.style.display = 'none';
            }
        }
    </script>
</body>
</html>