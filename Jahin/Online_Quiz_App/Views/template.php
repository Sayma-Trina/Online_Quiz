<?php
require_once __DIR__ . '/../Middleware/SessionHandler.php';

class Template {
    public static function header($title = 'Online Quiz System', $requireAuth = true) {
        if ($requireAuth) {
            SessionHandler::checkAuth();
        }
        ob_start();
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo htmlspecialchars($title); ?></title>
            <link rel="stylesheet" href="/Assets/CSS/style.css">
        </head>
        <body>
            <nav class="main-nav">
                <div class="container">
                    <a href="/" class="logo">Online Quiz</a>
                    <div class="nav-links">
                        <?php if (SessionHandler::getUserId()): ?>
                            <?php if (SessionHandler::getUserRole() === 'admin'): ?>
                                <a href="/Admin/dashboard.php">Dashboard</a>
                                <a href="/Admin/quizzes.php">Quizzes</a>
                                <a href="/Admin/users.php">Users</a>
                            <?php else: ?>
                                <a href="/Pages/quiz.php">Quizzes</a>
                                <a href="/Pages/results.php">Results</a>
                            <?php endif; ?>
                            <a href="/Views/Login/logout.php">Logout</a>
                        <?php else: ?>
                            <a href="/Views/Login/login.php">Login</a>
                        <?php endif; ?>
                    </div>
                </div>
            </nav>
            <main class="container">
        <?php
        return ob_get_clean();
    }

    public static function footer() {
        ob_start();
        ?>
            </main>
            <footer class="main-footer">
                <div class="container">
                    <p>&copy; <?php echo date('Y'); ?> Online Quiz System. All rights reserved.</p>
                </div>
            </footer>
            <script src="/Assets/JS/main.js"></script>
        </body>
        </html>
        <?php
        return ob_get_clean();
    }
}