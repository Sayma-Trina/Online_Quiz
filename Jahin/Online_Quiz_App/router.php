<?php

session_start();

// Parse the URL
$request = $_SERVER['REQUEST_URI'];
$path = parse_url($request, PHP_URL_PATH);

// Remove base path if exists
$basePath = '/Controllers/';
if (strpos($path, $basePath) === 0) {
    $path = substr($path, strlen($basePath));
}

// Route definitions
// Admin routes with middleware
$adminRoutes = [
    'GET /api/admin/users' => ['controller' => 'AdminController', 'action' => 'getUsers'],
    'POST /api/admin/users' => ['controller' => 'AdminController', 'action' => 'createUser'],
    'PUT /api/admin/users/(\d+)' => ['controller' => 'AdminController', 'action' => 'updateUser'],
    'DELETE /api/admin/users/(\d+)' => ['controller' => 'AdminController', 'action' => 'deleteUser'],
    'GET /api/admin/quizzes' => ['controller' => 'AdminController', 'action' => 'getQuizzes'],
    'POST /api/admin/quizzes' => ['controller' => 'AdminController', 'action' => 'createQuiz'],
    'PUT /api/admin/quizzes/(\d+)' => ['controller' => 'AdminController', 'action' => 'updateQuiz'],
    'DELETE /api/admin/quizzes/(\d+)' => ['controller' => 'AdminController', 'action' => 'deleteQuiz']
];

// Match admin routes
foreach ($adminRoutes as $pattern => $route) {
    list($method, $pathPattern) = explode(' ', $pattern, 2);
    
    if ($_SERVER['REQUEST_METHOD'] === $method 
        && preg_match('#^'.$pathPattern.'$#', $path, $matches)) {
        
        require_once __DIR__.'/Middleware/AuthMiddleware.php';
        $auth = new AuthMiddleware();
        if (!$auth->isAdmin()) {
            header('HTTP/1.1 403 Forbidden');
            echo json_encode(['status' => 'error', 'message' => 'Insufficient permissions']);
            exit;
        }

        $controllerName = $route['controller'];
        $actionName = $route['action'];
        require_once BASE_PATH . "/Controllers/{$controllerName}.php";
        $controller = new $controllerName();
        
        // Pass URL parameters
        $controller->$actionName($matches[1] ?? null);
        exit;
    }
}

// Existing non-admin routes
$routes = [
    'POST /auth' => ['controller' => 'UserController', 'action' => 'login'],
    'POST /register' => ['controller' => 'UserController', 'action' => 'register'],
    'POST /logout' => ['controller' => 'UserController', 'action' => 'logout'],
    'PUT /profile' => ['controller' => 'UserController', 'action' => 'updateProfile'],
    'GET /check-auth' => ['controller' => 'UserController', 'action' => 'checkAuth']
];

// Match standard routes
foreach ($routes as $pattern => $route) {
    list($method, $pathPattern) = explode(' ', $pattern, 2);
    
    if ($_SERVER['REQUEST_METHOD'] === $method && $path === $pathPattern) {
        $controllerName = $route['controller'];
        $actionName = $route['action'];
        require_once BASE_PATH . "/Controllers/{$controllerName}.php";
        $controller = new $controllerName();
        $controller->$actionName();
        exit;
    }
}

// Handle 404
header('HTTP/1.0 404 Not Found');
echo json_encode(['status' => 'error', 'message' => 'Route not found']);