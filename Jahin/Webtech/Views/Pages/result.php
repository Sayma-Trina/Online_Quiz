<?php
require_once __DIR__ . '/../../Controllers/config.php';

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: login.php');
    exit;
}

$score = isset($_GET['score']) ? (int)$_GET['score'] : 0;

// Get total questions from database
try {
    $totalStmt = $pdo->query('SELECT COUNT(*) FROM quizzes');
    $totalQuestions = $totalStmt->fetchColumn();
} catch (PDOException $e) {
    $totalQuestions = 'N/A';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Results - QuizMaster</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../Assets/css/result.css">
</head>
<body>
    <div class="result-container">
        <h1>Quiz Results</h1>
        <div class="score-card">
            <div class="score-circle">
                <span class="score"><?= $score ?></span>
                <span class="total">/ <?= $totalQuestions ?></span>
            </div>
            <p class="score-text">Correct Answers</p>
        </div>
        <a href="../../index.html" class="home-button">Return to Home</a>
    </div>
</body>
</html>