<?php
// Session configuration - must be set before session_start()
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.use_strict_mode', 1);

// Start the session after configuring it
session_start();

try {
    $pdo = new PDO('mysql:host=localhost;dbname=quiz_app', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}


error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = 'localhost';
$dbname = 'quiz_app';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Generate CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Automatic login from remember cookie
if (!isset($_SESSION['logged_in']) && isset($_COOKIE['remember'])) {
    list($selector, $validator) = explode(':', $_COOKIE['remember'], 2);
    
    try {
        $stmt = $pdo->prepare('SELECT * FROM auth_tokens WHERE selector = ?');
        $stmt->execute([$selector]);
        $token = $stmt->fetch();

        if ($token && password_verify($validator, $token['hashed_validator'])) {
            if (time() < strtotime($token['expires'])) {
                $_SESSION['user_id'] = $token['user_id'];
                $_SESSION['logged_in'] = true;

                // Rotate validator
                $newValidator = bin2hex(random_bytes(32));
                $hashedNewValidator = password_hash($newValidator, PASSWORD_DEFAULT);
                
                $pdo->prepare('UPDATE auth_tokens SET hashed_validator = ? WHERE id = ?')
                    ->execute([$hashedNewValidator, $token['id']]);

                setcookie('remember', "$selector:$newValidator", [
                    'expires' => time() + 60 * 60 * 24 * 30,
                    'path' => '/',
                    'httponly' => true,
                    'secure' => true,
                    'samesite' => 'Strict'
                ]);
            }
        }
    } catch (PDOException $e) {
        error_log('Remember me error: ' . $e->getMessage());
    }
}
?>