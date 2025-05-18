<?php

require_once __DIR__.'/../helpers/Session.php';

class AdminController {
    private $session;

    public function __construct() {
        $this->session = new Session();
        $this->checkAuthorization();
    }

    public function dashboard() {
        require_once __DIR__.'/../views/admin/dashboard.php';
    }

    private function checkAuthorization() {
        if ($this->session->get('role') !== 'admin') {
            header('Location: unauthorized.php');
            exit;
        }
    }
}