<?php
require_once __DIR__ . '/../../Controllers/config.php';

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: login.php');
    exit;
}

session_start();
$result = $_SESSION['quiz_result'] ?? ['score' => 0, 'total' => 0];
$score = $result['score'];
$totalQuestions = $result['total'];
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
<p>Hello, <?= htmlspecialchars($_SESSION['username'] ?? 'User') ?>!</p>
        <div class="score-card">
            <div class="score-circle">
                <span class="score"><?= $score ?></span>
                <span class="total">/ <?= $totalQuestions ?></span>
            </div>
            <p class="score-text">Correct Answers</p>
        </div>
        <div class="answer-review">
        <h2>Answer Review</h2>
        <?php foreach ($_SESSION['correct_answers'] as $questionId => $correct): ?>
        <div class="question-box">
            <h3>Question #<?= $questionId ?></h3>
            <?php 
                $userSelections = $_SESSION['user_answers'][$questionId] ?? [];
                $correctOptions = array_column($correct, 'option_text');
            ?>
            <div class="user-answer <?= empty(array_diff($userSelections, array_column($correct, 'option_id'))) ? 'correct' : 'incorrect' ?>">
                <span>Your answer:</span>
                <?php foreach ($userSelections as $optionId): ?>
                    <div><?= htmlspecialchars($correct[$optionId]['option_text'] ?? 'Unknown option') ?></div>
                <?php endforeach; ?>
            </div>
            <div class="correct-answer">
                <span>Correct answer:</span>
                <?php foreach ($correctOptions as $text): ?>
                    <div><?= htmlspecialchars($text) ?></div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <a href="../../index.html" class="home-button">Return to Home</a>
    </div>
</body>
</html>