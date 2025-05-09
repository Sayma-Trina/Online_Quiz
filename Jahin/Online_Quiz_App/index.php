<?php
require_once __DIR__ . '/Middleware/SessionHandler.php';
SessionHandler::init();

// Check if user is logged in
if (SessionHandler::getUserId()) {
    // Redirect based on user role
    if (SessionHandler::getUserRole() === 'admin') {
        header('Location: /Admin/dashboard.php');
    } else {
        header('Location: /Pages/quiz.php');
    }
    exit();
} else {
    // Redirect to login page if not logged in
    header('Location: /Views/Login/login.php');
    exit();
}