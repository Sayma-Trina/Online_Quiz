<?php
require_once __DIR__.'/../../helpers/Session.php';
$session = new Session();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Teacher Dashboard</title>
    <link rel="stylesheet" href="/quizApp/assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Teacher Dashboard</h1>
        <div class="dashboard-actions">
            <a href="/quizApp/quiz/create" class="btn primary">Create New Quiz</a>
            <a href="/quizApp/quiz/manage" class="btn secondary">Manage Quizzes</a>
        </div>
        <div class="stats-container">
            <div class="stat-card">
                <h3>Active Quizzes</h3>
                <p>0</p>
            </div>
            <div class="stat-card">
                <h3>Total Students</h3>
                <p>0</p>
            </div>
        </div>
    </div>
</body>
</html>