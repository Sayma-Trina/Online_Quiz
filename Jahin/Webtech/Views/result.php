<?php
session_start();
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../Models/Quiz.php';
require_once __DIR__ . '/../Models/User.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: /login.php');
    exit;
}

try {
    // Get latest quiz result
    $stmt = $pdo->prepare(
        'SELECT score, completed_at '.
        'FROM '.Quiz::RESULTS_TABLE.' '.
        'WHERE user_id = ? ORDER BY completed_at DESC LIMIT 1'
    );
    $stmt->execute([$_SESSION['user_id']]);
    $result = $stmt->fetch();

    // Get total questions
    $total = $pdo->query('SELECT COUNT(DISTINCT id) FROM '.Quiz::QUIZ_TABLE)->fetchColumn();

} catch (PDOException $e) {
    error_log('Database error: ' . $e->getMessage());
    die('Error retrieving results');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Quiz Results</title>
    <style>
        .result-container { max-width: 800px; margin: 2rem auto; padding: 2rem; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .score { font-size: 2rem; color: #2c3e50; margin-bottom: 1rem; }
        .detail { color: #7f8c8d; }
    </style>
</head>
<body>
    <div class="result-container">
        <?php if ($result): ?>
            <div class="score">
                Score: <?= htmlspecialchars($result['score']) ?>/<?= htmlspecialchars($total) ?>
            </div>
            <div class="detail">
                Completed on: <?= date('M j, Y H:i', strtotime($result['completed_at'])) ?>
            </div>
        <?php else: ?>
            <div class="no-results">No quiz results found</div>
        <?php endif; ?>
    </div>
</body>
</html>