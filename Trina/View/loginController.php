<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
   
    if ($email === 'admin@admin.com' && $password === 'admin123') {
        $_SESSION['user_id'] = 1; 
        $_SESSION['email'] = $email;
        header("Location: ../View/quiz.php");
        exit();
    } else {
        // Redirect back to login with error
        header("Location: ../View/login.php?error=1");
        exit();
    }
}
?>