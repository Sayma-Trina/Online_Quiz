<?php
require '../../Controllers/config.php';

$errors = [];
$username = $email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate CSRF token
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die('Invalid CSRF token');
    }

    // Validate username
    $username = trim($_POST['username']);
    if (empty($username)) {
        $errors['username'] = 'Username is required';
    } elseif (!preg_match('/^[a-zA-Z0-9_]{4,20}$/', $username)) {
        $errors['username'] = 'Username must be 4-20 chars (letters, numbers, underscores)';
    }

    // Validate email
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email format';
    }

    // Validate password
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    if (empty($password)) {
        $errors['password'] = 'Password is required';
    } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password)) {
        $errors['password'] = 'Password must be at least 8 chars with uppercase, lowercase, number, and special char';
    } elseif ($password !== $confirm_password) {
        $errors['confirm_password'] = 'Passwords do not match';
    }

    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare('INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)');
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt->execute([$username, $email, $password_hash]);
            header('Location: login.php');
            exit;
        } catch (PDOException $e) {
            if ($e->errorInfo[1] === 1062) {
                $errors['general'] = 'Username or email already exists';
            } else {
                $errors['general'] = 'Registration error: ' . $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-header">
            <h2>Create Account</h2>
            <p>Sign up for a new account</p>
        </div>
        
        <?php if (!empty($errors['general'])): ?>
            <div class="error-message"><?= htmlspecialchars($errors['general']) ?></div>
        <?php endif; ?>
        
        <form method="post">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control" 
                       value="<?= htmlspecialchars($username ?? '') ?>" 
                       required pattern="[a-zA-Z0-9_]{4,20}">
                <?php if (!empty($errors['username'])): ?>
                    <div class="form-error"><?= $errors['username'] ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" 
                       value="<?= htmlspecialchars($email ?? '') ?>" required>
                <?php if (!empty($errors['email'])): ?>
                    <div class="form-error"><?= $errors['email'] ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group" style="position: relative;">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" required
                       pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$">
                <span class="toggle-password" style="position: absolute; right: 10px; top: 38px; cursor: pointer; color: var(--secondary-color);" onclick="togglePasswordVisibility('password')">👁️</span>
                <?php if (!empty($errors['password'])): ?>
                    <div class="form-error"><?= $errors['password'] ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group" style="position: relative;">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                <span class="toggle-password" style="position: absolute; right: 10px; top: 38px; cursor: pointer; color: var(--secondary-color);" onclick="togglePasswordVisibility('confirm_password')">👁️</span>
                <?php if (!empty($errors['confirm_password'])): ?>
                    <div class="form-error"><?= $errors['confirm_password'] ?></div>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary">Create Account</button>
        </form>
        
        <div class="auth-footer">
            <p>Already have an account? <a href="login.php">Login here</a></p>
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