<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once __DIR__ . '/../../helpers/Session.php';
$session = new Session();
$error = $session->getFlash('error');
$success = $session->getFlash('success');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="../../Assets/css/styles.css">
</head>
<body>
    <div class="auth-container">
        <?php if ($error): ?>
            <div class="alert error"><?= $error ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="alert success"><?= $success ?></div>
        <?php endif; ?>

        <form method="POST" action="/quizApp/register">
            <div class="form-header">
                <h2>Get Started</h2>
                <p>Create your free account</p>
            </div>

            <div class="input-group">
                <svg class="input-icon" viewBox="0 0 24 24">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                </svg>
                <input type="text" name="name" placeholder="Enter your name" required>
            </div>

            <div class="input-group">
                <svg class="input-icon" viewBox="0 0 24 24">
                    <path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 14H4V8l8 5 8-5v10zm-8-7L4 6h16l-8 5z"/>
                </svg>
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>

            <div class="input-group">
                <svg class="input-icon" viewBox="0 0 24 24">
                    <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM9 6c0-1.66 1.34-3 3-3s3 1.34 3 3v2H9V6zm9 14H6V10h12v10zm-6-3c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2z"/>
                </svg>
                <input type="password" name="password" placeholder="Create password" required>
            </div>

            <div class="input-group">
                <svg class="input-icon" viewBox="0 0 24 24">
                    <path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/>
                </svg>
                <div class="input-group">
                    <label for="role">Role </label>
                    <select name="role" id="role" required>
                        <option value="admin">Admin</option>
                        <option value="teacher">Teacher</option>
                        <option value="student">Student</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn-primary">
                <span class="loading-text">Create Account</span>
            </button>
        </form>
        <div class="auth-switch">
            Already have an account? <a href="/quizApp/login">Sign in</a>
        </div>
        
    </div>
</body>
</html>