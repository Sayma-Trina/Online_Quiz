<?php
require_once __DIR__.'/../../helpers/Session.php';
$session = new Session();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="/quizApp/assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Admin Dashboard</h1>
        <div class="stats-container">
            <div class="stat-card">
                <h3>Total Users</h3>
                <p>0</p>
            </div>
            <div class="stat-card">
                <h3>Active Quizzes</h3>
                <p>0</p>
            </div>
        </div>
    </div>
</body>
</html>