<?php
require '../../Controllers/config.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate CSRF token
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die('Invalid CSRF token');
    }

    $identifier = trim($_POST['identifier']);
    $password = $_POST['password'];
    $remember = isset($_POST['remember']);

    if (empty($identifier)) {
        $errors['identifier'] = 'Username/Email is required';
    }
    if (empty($password)) {
        $errors['password'] = 'Password is required';
    }

    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ? OR email = ?');
            $stmt->execute([$identifier, $identifier]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password_hash'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['logged_in'] = true;

                if ($remember) {
                    $selector = bin2hex(random_bytes(12));
                    $validator = bin2hex(random_bytes(32));
                    $hashedValidator = password_hash($validator, PASSWORD_DEFAULT);
                    $expires = date('Y-m-d H:i:s', time() + 60 * 60 * 24 * 30);

                    $pdo->prepare('INSERT INTO auth_tokens (user_id, selector, hashed_validator, expires) VALUES (?, ?, ?, ?)')
                        ->execute([$user['id'], $selector, $hashedValidator, $expires]);

                    setcookie('remember', "$selector:$validator", [
                        'expires' => time() + 60 * 60 * 24 * 30,
                        'path' => '/',
                        'httponly' => true,
                        'secure' => true,
                        'samesite' => 'Strict'
                    ]);
                }

               
                header('Location: ../Pages/quiz.php');
                exit;
            } else {
                $errors['general'] = 'Invalid credentials';
            }
        } catch (PDOException $e) {
            $errors['general'] = 'Login error: ' . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-header">
            <h2>Welcome Back</h2>
            <p>Sign in to your account</p>
        </div>
        
        <?php if (!empty($errors['general'])): ?>
            <div class="error-message"><?= htmlspecialchars($errors['general']) ?></div>
        <?php endif; ?>
        
        <form method="post">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            
            <div class="form-group">
                <label for="identifier">Username/Email</label>
                <input type="text" id="identifier" name="identifier" class="form-control" required>
                <?php if (!empty($errors['identifier'])): ?>
                    <div class="form-error"><?= $errors['identifier'] ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group" style="position: relative;">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
                <span class="toggle-password" style="position: absolute; right: 10px; top: 38px; cursor: pointer; color: var(--secondary-color);" onclick="togglePasswordVisibility('password')">👁️</span>
                <?php if (!empty($errors['password'])): ?>
                    <div class="form-error"><?= $errors['password'] ?></div>
                <?php endif; ?>
            </div>

            <div class="form-check">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Remember me</label>
            </div>

            <button type="submit" class="btn btn-primary">Sign In</button>
        </form>
        
        <div class="auth-footer">
            <p>Don't have an account? <a href="register.php">Register here</a></p>
            <p style="margin-top: 10px;"><a href="forgot_password.php">Forgot your password?</a></p>
            <p style="margin-top: 10px;"><a href="../../index.html">Back to Home</a></p>
        </div>
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