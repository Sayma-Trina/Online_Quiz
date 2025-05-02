<?php

class AuthMiddleware {
    public function isAdmin() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
    }
    public static function isAuthenticated() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['user_id']);
    }

    public static function requireAuth() {
        if (!self::isAuthenticated()) {
            header('HTTP/1.0 401 Unauthorized');
            echo json_encode(['error' => 'Authentication required']);
            exit;
        }
    }

    public static function requireRole($role) {
        self::requireAuth();
        if ($_SESSION['user_role'] !== $role) {
            header('HTTP/1.0 403 Forbidden');
            echo json_encode(['error' => 'Access denied']);
            exit;
        }
    }

    public static function getUserId() {
        return $_SESSION['user_id'] ?? null;
    }

    public static function getUserRole() {
        return $_SESSION['user_role'] ?? null;
    }

    public static function validateCSRFToken($token) {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }

    public static function generateCSRFToken() {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
}