<?php

class SessionHandler {
    public static function init() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function checkAuth() {
        self::init();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /Views/Login/login.php');
            exit();
        }
    }

    public static function setUser($userId, $userRole) {
        self::init();
        $_SESSION['user_id'] = $userId;
        $_SESSION['user_role'] = $userRole;
    }

    public static function logout() {
        self::init();
        session_destroy();
        header('Location: /Views/Login/login.php');
        exit();
    }

    public static function getUserId() {
        self::init();
        return $_SESSION['user_id'] ?? null;
    }

    public static function getUserRole() {
        self::init();
        return $_SESSION['user_role'] ?? null;
    }
}