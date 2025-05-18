<?php

class Session {
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start([
                'cookie_secure' => false,
                'cookie_httponly' => true,
                'cookie_samesite' => 'Strict'
            ]);
        }
    }

    public function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public function get($key) {
        return $_SESSION[$key] ?? null;
    }

    public function setFlash($type, $message) {
        $_SESSION['flash'][$type] = $message;
    }

    public function getFlash($type) {
        $message = $_SESSION['flash'][$type] ?? null;
        unset($_SESSION['flash'][$type]);
        return $message;
    }

    public function destroy() {
        session_unset();
        session_destroy();
        session_write_close();
        setcookie(session_name(), '', time() - 3600, '/');
    }
}