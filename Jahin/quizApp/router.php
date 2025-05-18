<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include controllers
require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/AdminController.php';
require_once __DIR__ . '/controllers/TeacherController.php';
require_once __DIR__ . '/controllers/StudentController.php';
require_once __DIR__ . '/controllers/DashboardController.php';
require_once __DIR__ . '/controllers/QuizController.php';
require_once __DIR__ . '/controllers/QuizTakeController.php';

// Parse the URL
$request_uri = $_SERVER['REQUEST_URI'];
$path = parse_url($request_uri, PHP_URL_PATH);
$path = str_replace('/quizApp/', '/', $path);
$path = rtrim($path, '/');

if ($path === '') {
    $path = '/';
}

// Define routes
$routes = [
    '/' => function() {
        // Home page - already handled by index.php
        return;
    },
    '/login' => function() {
        $controller = new AuthController();
        $controller->login();
    },
    '/register' => function() {
        $controller = new AuthController();
        $controller->register();
    },
    '/admin/dashboard' => function() {
        $controller = new AdminController();
        $controller->dashboard();
    },
    '/teacher/dashboard' => function() {
        $controller = new TeacherController();
        $controller->dashboard();
    },
    '/student/dashboard' => function() {
        $controller = new StudentController();
        $controller->dashboard();
    },
    '/dashboard' => function() {
        $controller = new DashboardController();
        $controller->index();
    }
    // Add more routes as needed
];

// Route the request
if (array_key_exists($path, $routes)) {
    $routes[$path]();
} else {
    // 404 Not Found
    header("HTTP/1.0 404 Not Found");
    echo "<h1>404 Not Found</h1>";
    echo "<p>The page you requested could not be found.</p>";
    echo "<p>Request path: $path</p>";
}