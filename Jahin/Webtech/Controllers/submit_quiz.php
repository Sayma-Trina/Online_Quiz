<?php
require '../config.php';

session_start();

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    http_response_code(403);
    exit('Unauthorized access');
}

try {
    // Validate and process answers
    $rawAnswers = json_decode($_POST['answers'], true);
    $score = 0;

    // Get correct answers
    $stmt = $pdo->query('SELECT q.id, o.id AS option_id FROM quizzes q JOIN quiz_options o ON q.id = o.quiz_id WHERE o.is_correct = 1');
    $correctAnswers = $stmt->fetchAll(PDO::FETCH_GROUP | PDO::FETCH_COLUMN);

    // Calculate score
    foreach ($rawAnswers as $questionId => $selectedOptionId) {
        if (isset($correctAnswers[$questionId]) && in_array($selectedOptionId, $correctAnswers[$questionId])) {
            $score++;
        }
    }

    // Store results
    $resultStmt = $pdo->prepare('INSERT INTO quiz_results (user_id, score) VALUES (?, ?)');
    $resultStmt->execute([$_SESSION['user_id'], $score]);

    echo json_encode(['score' => $score]);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request: ' . $e->getMessage()]);
}