<?php
require_once __DIR__.'/../Models/User.php';
require_once __DIR__.'/config.php';

class AuthController {
    public function login($data) {
        $user = User::getByCredentials($GLOBALS['pdo'], $data['identifier']);

        if ($user && password_verify($data['password'], $user['password_hash'])) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['logged_in'] = true;
            $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
            $_SESSION['ip_address'] = $_SERVER['REMOTE_ADDR'];
            return true;
        }
        return false;
    }

    public function register($data) {
        try {
            $stmt = $GLOBALS['pdo']->prepare('INSERT INTO '.User::TABLE_NAME.' (username, email, password_hash) VALUES (?, ?, ?)');
            if (!preg_match('/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^\w\d\s:])(\S){8,}$/', $data['password'])) {
                throw new Exception('Password must contain at least 8 characters with uppercase, lowercase, number and special character');
            }
            $password_hash = password_hash($data['password'], PASSWORD_DEFAULT, ['cost' => 12]);
            $stmt->execute([$data['username'], $data['email'], $password_hash]);
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function getUserById($id) {
        try {
            $stmt = $GLOBALS['pdo']->prepare('SELECT id, username, email FROM users WHERE id = ?');
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('User fetch error: ' . $e->getMessage());
            return false;
        }
    }
}