<?php

require_once 'Controller.php';

require_once __DIR__ . '/../Middleware/AuthMiddleware.php';

class UserController extends Controller {
    public function __construct() {
        parent::__construct();
        $this->loadModel('UserModel');
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->error('Invalid request method', 405);
        }

        if (!$this->validateCSRF()) {
            $this->error('Invalid CSRF token', 403);
        }

        $data = $this->getRequestData();
        
        if (empty($data['email']) || empty($data['password'])) {
            $this->error('Email and password are required');
        }

        try {
            if ($this->model->validateLogin($data['email'], $data['password'])) {
                $user = $this->model->findByEmail($data['email']);
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_role'] = $user['role'];
                
                $this->success([
                    'redirect' => $user['role'] === 'admin' ? '/Admin/dashboard.html' : '/Pages/quiz.html'
                ]);
            } else {
                $this->error('Invalid email or password');
            }
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->error('Invalid request method', 405);
        }

        $data = $this->getRequestData();
        $errors = $this->model->validateRegistration($data);

        if (!empty($errors)) {
            $this->error($errors);
        }

        try {
            $userId = $this->model->createUser($data);
            $_SESSION['user_id'] = $userId;
            $_SESSION['user_role'] = 'user';
            
            $this->success([
                'redirect' => '/Pages/quiz.html'
            ]);
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }

    public function logout() {
        session_destroy();
        $this->success(['redirect' => '/Views/Login/login.html']);
    }

    public function updateProfile() {
        if (!isset($_SESSION['user_id'])) {
            $this->error('Unauthorized', 401);
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->error('Invalid request method', 405);
        }

        $data = $this->getRequestData();
        $userId = $_SESSION['user_id'];

        try {
            $this->model->updateUser($userId, $data);
            $this->success(['message' => 'Profile updated successfully']);
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }

    public function checkAuth() {
        if (!isset($_SESSION['user_id'])) {
            $this->error('Unauthorized', 401);
        }

        $user = $this->model->find($_SESSION['user_id']);
        unset($user['password']);
        $this->success(['user' => $user]);
    }
}