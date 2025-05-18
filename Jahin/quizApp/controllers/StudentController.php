<?php

require_once __DIR__.'/../helpers/Session.php';

class StudentController {
    private $session;

    public function __construct() {
        $this->session = new Session();
        $this->checkAuthorization();
    }

    public function dashboard() {
        require_once __DIR__.'/../views/student/dashboard.php';
    }

    private function checkAuthorization() {
        if ($this->session->get('role') !== 'student') {
            header('Location: /quizApp/unauthorized');
            exit;
        }
    }
}