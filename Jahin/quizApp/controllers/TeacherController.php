<?php

require_once __DIR__.'/../helpers/Session.php';

class TeacherController {
    private $session;

    public function __construct() {
        $this->session = new Session();
        $this->checkAuthorization();
    }

    public function dashboard() {
        require_once __DIR__.'/../views/teacher/dashboard.php';
    }

    private function checkAuthorization() {
        if ($this->session->get('role') !== 'teacher') {
            header('Location: /quizApp/unauthorized');
            exit;
        }
    }
}