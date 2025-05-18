<?php
require_once __DIR__.'/../../helpers/Session.php';
$session = new Session();
if (!$session->get('user_id') || !in_array($session->get('role'), [3, 2, 1])) {
    header('Location: /quizApp/login');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="../../Assets/css/styles.css">
</head>
<body>
    <?php include '../components/student_nav.php' ?>
    <div class="container">
        <h1>Welcome Student</h1>
        <div class="dashboard-cards">
            <div class="card">
                <h3>Available Quizzes</h3>
                <p>Take new assessments</p>
                <a href="/quizApp/quiz" class="btn">Browse Quizzes</a>
            </div>
            <div class="card">
                <h3>My Results</h3>
                <p>View previous attempts</p>
                <a href="/quizApp/student/results" class="btn">View History</a>
            </div>
        </div>
    </div>
</body>
</html>