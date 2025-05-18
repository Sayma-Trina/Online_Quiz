<?php

require_once __DIR__.'/../config/database.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../helpers/Session.php';

class AuthController {
    private $db;
    private $session;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->session = new Session();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = new User($this->db);
            $loggedInUser = $user->authenticate($email, $password);

            if ($loggedInUser) {
                $this->session->set('user_id', $loggedInUser['id']);
                $this->session->set('role', $loggedInUser['role_id']);
                $role = $loggedInUser['role_id'];
switch($role) {
    case 1:
        header('Location: /quizApp/admin/dashboard');
        break;
    case 2:
        header('Location: /quizApp/teacher/dashboard');
        break;
    default:
        header('Location: /quizApp/student/dashboard');
}
                exit;
            }

            $this->session->setFlash('error', 'Invalid credentials');
            header('Location: /quizApp/login');
            exit;
        }

        require_once __DIR__.'/../views/auth/login.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = new User($this->db);
            $userId = $user->create($name, $email, $password, $_POST['role']);
                $userData = $user->getById($userId);

            if ($userId) {
                $this->session->set('user_id', $userId);
                $this->session->set('role', $userData['role_id']);
                $role = $userData['role_id'];
                switch($role) {
                    case 1:
                        header('Location: /quizApp/admin/dashboard');
                        exit;
                    case 2:
                        header('Location: /quizApp/teacher/dashboard');
                        exit;
                    default:
                        header('Location: /quizApp/student/dashboard');
                        exit;
                }
            } else {
                $this->session->setFlash('error', 'Registration failed');
                header('Location: /quizApp/register');
                exit;
            }
        }

        require_once __DIR__.'/../views/auth/register.php';
    }
}