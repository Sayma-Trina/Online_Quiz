<?php
require '../../Controllers/config.php';
$errors = [];
$success = false;
$token_valid = false;
$token = '';

// Check if token is provided in URL
if (isset($_GET['token']) && !empty($_GET['token'])) {
    $token = $_GET['token'];
    
    try {
        // Check if token exists and is valid
        $stmt = $pdo->prepare('SELECT * FROM password_reset_tokens WHERE token = ? AND expires > NOW()');
        $stmt->execute([$token]);
        $reset = $stmt->fetch();
        
        if ($reset) {
            $token_valid = true;
        }
    } catch (PDOException $e) {
        $errors['general'] = 'Error: ' . $e->getMessage();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate CSRF token
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die('Invalid CSRF token');
    }
    
    $token = $_POST['token'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Validate password
    if (empty($password)) {
        $errors['password'] = 'Password is required';
    } elseif (strlen($password) < 8) {
        $errors['password'] = 'Password must be at least 8 characters';
    }
    
    // Validate password confirmation
    if ($password !== $confirm_password) {
        $errors['confirm_password'] = 'Passwords do not match';
    }
    
    if (empty($errors)) {
        try {
            // Check if token exists and is valid
            $stmt = $pdo->prepare('SELECT * FROM password_reset_tokens WHERE token = ? AND expires > NOW()');
            $stmt->execute([$token]);
            $reset = $stmt->fetch();
            
            if ($reset) {
                // Update user's password
                $password_hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare('UPDATE users SET password_hash = ? WHERE id = ?');
                $stmt->execute([$password_hash, $reset['user_id']]);
                
                // Delete used token
                $stmt = $pdo->prepare('DELETE FROM password_reset_tokens WHERE id = ?');
                $stmt->execute([$reset['id']]);
                
                $success = true;
            } else {
                $errors['general'] = 'Invalid or expired token';
            }
        } catch (PDOException $e) {
            $errors['general'] = 'Error: ' . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .password-container {
            position: relative;
        }
        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--secondary-color);
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-header">
            <h2>Reset Password</h2>
            <p>Create a new password</p>
        </div>
        
        <?php if ($success): ?>
            <div class="success-message" style="background-color: rgba(40, 167, 69, 0.1); color: var(--success-color); padding: 0.75rem; border-radius: 4px; margin-bottom: 1.5rem; font-size: 0.9rem;">
                Your password has been reset successfully. <a href="login.php">Login here</a>
            </div>
        <?php else: ?>
            
            <?php if (!empty($errors['general'])): ?>
                <div class="error-message"><?= htmlspecialchars($errors['general']) ?></div>
            <?php endif; ?>
            
            <?php if ($token_valid || isset($_POST['token'])): ?>
                <form method="post">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
                    
                    <div class="form-group password-container">
                        <label for="password">New Password</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                        <span class="toggle-password" onclick="togglePasswordVisibility('password')">👁️</span>
                        <?php if (!empty($errors['password'])): ?>
                            <div class="form-error"><?= $errors['password'] ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group password-container">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                        <span class="toggle-password" onclick="togglePasswordVisibility('confirm_password')">👁️</span>
                        <?php if (!empty($errors['confirm_password'])): ?>
                            <div class="form-error"><?= $errors['confirm_password'] ?></div>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn btn-primary">Reset Password</button>
                </form>
            <?php else: ?>
                <div class="error-message">Invalid or expired token. Please request a new password reset link.</div>
                <div class="auth-footer">
                    <p><a href="forgot_password.php">Request new reset link</a></p>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    
    <script>
        function togglePasswordVisibility(inputId) {
            const input = document.getElementById(inputId);
            if (input.type === "password") {
                input.type = "text";
            } else {
                input.type = "password";
            }
        }
    </script>
</body>
</html>