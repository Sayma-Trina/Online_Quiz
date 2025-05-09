<?php
require_once __DIR__ . '/../Views/template.php';
require_once __DIR__ . '/../Middleware/SessionHandler.php';

// Check if user is logged in and has admin role
SessionHandler::init();
if (SessionHandler::getUserRole() !== 'admin') {
    header('Location: /Views/Login/login.php');
    exit();
}

// Start output buffering
ob_start();

// Display header
echo Template::header('Admin Dashboard', true);
?>

<div class="admin-dashboard">
    <h1>Admin Dashboard</h1>
    
    <div class="dashboard-stats">
        <div class="stat-card">
            <h3>Total Users</h3>
            <p class="stat-number">0</p>
        </div>
        <div class="stat-card">
            <h3>Active Quizzes</h3>
            <p class="stat-number">0</p>
        </div>
        <div class="stat-card">
            <h3>Completed Tests</h3>
            <p class="stat-number">0</p>
        </div>
    </div>

    <div class="quick-actions">
        <h2>Quick Actions</h2>
        <div class="action-buttons">
            <a href="add-quiz.php" class="btn-primary">Create New Quiz</a>
            <a href="add-user.php" class="btn-primary">Add New User</a>
            <a href="reports.php" class="btn-primary">View Reports</a>
        </div>
    </div>

    <div class="recent-activity">
        <h2>Recent Activity</h2>
        <div class="activity-list">
            <p>No recent activity to display.</p>
        </div>
    </div>
</div>

<?php
// Display footer
echo Template::footer();

// Send output to browser
ob_end_flush();