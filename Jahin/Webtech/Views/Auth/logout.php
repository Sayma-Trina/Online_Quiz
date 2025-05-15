<?php
require '../../Controllers/config.php';

// Destroy session
$_SESSION = [];
session_destroy();

// Expire remember cookie
if (isset($_COOKIE['remember'])) {
    setcookie('remember', '', [
        'expires' => time() - 3600,
        'path' => '/',
        'httponly' => true,
        'secure' => true,
        'samesite' => 'Strict'
    ]);
}

header('Location: ../../index.html');
exit;
?>