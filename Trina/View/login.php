<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register - QuizMaster</title>
    <link rel="stylesheet" href="../Asset/Css/style.css">
    <link rel="stylesheet" href="../Asset/Css/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-box">
            <a href="../../index.html" class="back-home">
                <i class="fas fa-arrow-left"></i>
                Back
            </a>
            <div class="auth-tabs">
                <div class="auth-tab active" data-tab="login">Login</div>
                <div class="auth-tab" data-tab="register">Register</div>
            </div>

            <form id="loginForm" class="auth-form active" method="POST" action="../controller/LoginController.php">
                <div class="auth-header">
                    <h2>Welcome Back</h2>
                    <p>Sign in to continue to QuizMaster</p>
                </div>

                <?php if (isset($_GET['error'])): ?>
                <div class="error-alert">
                    Invalid email or password.
                </div>
                <?php endif; ?>

                <div class="form-group">
                    <label for="loginEmail">Email</label>
                    <input type="email" id="loginEmail" name="email" required placeholder="Enter your email">
                    <div class="error-message"></div>
                </div>

                <div class="form-group">
                    <label for="loginPassword">Password</label>
                    <input type="password" id="loginPassword" name="password" required placeholder="Enter your password">
                    <div class="error-message"></div>
                </div>

                <button type="submit" name="submit" class="auth-button">Sign In</button>

                <div class="auth-links">
                    <a href="#forgot-password">Forgot Password?</a>
                </div>

                <div class="auth-social">
                    <p>Or continue with</p>
                    <div class="auth-social-buttons">
                        <button type="button" class="social-button">
                            <i class="fab fa-google"></i>
                        </button>
                        <button type="button" class="social-button">
                            <i class="fab fa-facebook"></i>
                        </button>
                        <button type="button" class="social-button">
                            <i class="fab fa-twitter"></i>
                        </button>
                    </div>
                </div>
            </form>

            <form id="registerForm" class="auth-form">
                <div class="auth-header">
                    <h2>Create Account</h2>
                    <p>Join QuizMaster today</p>
                </div>

                <div class="form-group">
                    <label for="registerName">Full Name</label>
                    <input type="text" id="registerName" name="name" required placeholder="Enter your full name">
                    <div class="error-message"></div>
                </div>

                <div class="form-group">
                    <label for="registerEmail">Email</label>
                    <input type="email" id="registerEmail" name="email" required placeholder="Enter your email">
                    <div class="error-message"></div>
                </div>

                <div class="form-group">
                    <label for="registerPassword">Password</label>
                    <input type="password" id="registerPassword" name="password" required placeholder="Create a password">
                    <div class="error-message"></div>
                </div>

                <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="confirm_password" required placeholder="Confirm your password">
                    <div class="error-message"></div>
                </div>

                <button type="submit" class="auth-button">Create Account</button>
            </form>
        </div>
    </div>

    <script src="../Asset/Js/login.js"></script>
    <script src="../Asset/Js/login-handler.js"></script>
</body>
</html>

