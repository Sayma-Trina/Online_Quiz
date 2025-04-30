<?php

class Controller {
    protected $model;
    protected $view;

    public function __construct() {
        header('Content-Type: application/json');
    }

    protected function loadModel($modelName) {
        require_once "../Models/{$modelName}.php";
        $this->model = new $modelName();
    }

    protected function loadView($view, $data = []) {
        extract($data);
        require_once "../Views/{$view}.php";
    }

    protected function json($data, $statusCode = 200) {
        http_response_code($statusCode);
        echo json_encode($data);
        exit;
    }

    protected function error($message, $statusCode = 400) {
        $this->json(['error' => $message], $statusCode);
    }

    protected function success($data = null, $message = 'Success') {
        $response = ['message' => $message];
        if ($data !== null) {
            $response['data'] = $data;
        }
        $this->json($response);
    }

    protected function getRequestData() {
        $data = [];
        
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $_GET;
        } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contentType = isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : '';
            
            if (strpos($contentType, 'application/json') !== false) {
                $json = file_get_contents('php://input');
                $data = json_decode($json, true) ?? [];
            } else {
                $data = $_POST;
            }
        }

        return $data;
    }

    protected function validateCSRF() {
        if (!isset($_SESSION['csrf_token']) || 
            !isset($_POST['csrf_token']) || 
            $_SESSION['csrf_token'] !== $_POST['csrf_token']) {
            $this->error('Invalid CSRF token', 403);
        }
    }

    protected function generateCSRFToken() {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    protected function redirect($url) {
        header("Location: $url");
        exit;
    }

    protected function isAjax() {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
               strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }
}