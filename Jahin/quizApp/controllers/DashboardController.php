<?php

require_once __DIR__.'/../helpers/Session.php';

class DashboardController {
    private $session;

    public function __construct() {
        $this->session = new Session();
        $this->checkAuthentication();
    }

    public function index() {
        $role = $this->session->get('role');
        
        switch ($role) {
            case 'admin':
                header('Location: /quizApp/admin/dashboard');
                break;
            case 'teacher':
                header('Location: /quizApp/teacher/dashboard');
                break;
            default:
                header('Location: /quizApp/student/dashboard');
        }
        exit;
    }

    private function checkAuthentication() {
        if (!$this->session->get('user_id')) {
            header('Location: /quizApp/login');
            exit;
        }
    }
}