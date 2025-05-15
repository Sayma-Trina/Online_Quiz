<?php
require '../../Controllers/config.php';

$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate CSRF token
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die('Invalid CSRF token');
    }

    $email = trim($_POST['email']);

    if (empty($email)) {
        $errors['email'] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email format';
    }

    if (empty($errors)) {
        try {
            // Check if email exists
            $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            if ($user) {
                // Generate token
                $token = bin2hex(random_bytes(32));
                $expires = date('Y-m-d H:i:s', time() + 3600); // 1 hour expiration

                // Store token in database
                $stmt = $pdo->prepare('INSERT INTO password_reset_tokens (user_id, token, expires) VALUES (?, ?, ?)');
                $stmt->execute([$user['id'], $token, $expires]);

                // In a real application, you would send an email with the reset link
                // For demonstration purposes, we'll just show the success message
                $success = true;
            } else {
                // Don't reveal if email exists or not for security
                $success = true; // Still show success even if email doesn't exist
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
    <title>Forgot Password</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-header">
            <h2>Forgot Password</h2>
            <p>Enter your email to reset your password</p>
        </div>
        
        <?php if ($success): ?>
            <div class="success-message" style="background-color: rgba(40, 167, 69, 0.1); color: var(--success-color); padding: 0.75rem; border-radius: 4px; margin-bottom: 1.5rem; font-size: 0.9rem;">
                If your email exists in our system, you will receive a password reset link shortly.
            </div>
        <?php endif; ?>
        
        <?php if (!empty($errors['general'])): ?>
            <div class="error-message"><?= htmlspecialchars($errors['general']) ?></div>
        <?php endif; ?>
        
        <?php if (!$success): ?>
            <form method="post">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                    <?php if (!empty($errors['email'])): ?>
                        <div class="form-error"><?= $errors['email'] ?></div>
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn btn-primary">Reset Password</button>
            </form>
        <?php endif; ?>
        
        <div class="auth-footer">
            <p>Remember your password? <a href="login.php">Login here</a></p>
        </div>
    </div>
</body>
</html>