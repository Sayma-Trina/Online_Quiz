<?php
session_start();
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/QuizController.php';

header('Content-Type: application/json');

try {
    if (!$pdo) {
        throw new PDOException('Database connection failed');
    }

    $data = json_decode(file_get_contents('php://input'), true);
    if ($data === null) {
        throw new Exception('Invalid JSON input');
    }
    $answers = $data['answers'] ?? [];
    if (!is_array($answers)) {
        throw new Exception('Invalid answer format');
    }

    $quizController = new QuizController($pdo);
    $questions = $quizController->getQuizDataWithAnswers();

    $score = 0;
    $correctAnswers = [];
    $userAnswers = [];

    foreach ($questions as $question) {
        // Store correct answers with both ID and text
        $correctOptions = array_filter($question->options, fn($opt) => $opt->is_correct);
        $correctAnswers[$question->id] = array_map(fn($opt) => [
            'option_id' => $opt->id,
            'option_text' => $opt->option_text
        ], $correctOptions);

        // Process user answers
        $userAnswers[$question->id] = $answers[$question->id] ?? [];
        if (!is_array($userAnswers[$question->id])) {
            $userAnswers[$question->id] = [$userAnswers[$question->id]];
        }

        // Calculate score
        $correctIds = array_column($correctOptions, 'id');
        if (empty(array_diff($correctIds, $userAnswers[$question->id])) 
            && empty(array_diff($userAnswers[$question->id], $correctIds))) {
            $score++;
        }
    }

    // Store session data for review
    $_SESSION['correct_answers'] = $correctAnswers;
    $_SESSION['user_answers'] = $userAnswers;

    $_SESSION['quiz_result'] = [
        'score' => $score,
        'total' => count($questions),
        'timestamp' => time()
    ];

    // Save result to database
    if (!Quiz::saveResult($pdo, $_SESSION['user_id'], $score)) {
        throw new Exception('Failed to save quiz result');
    }

    echo json_encode(['success' => true]);
    exit;

} catch (PDOException $e) {
    error_log('Database error: ' . $e->getMessage());
    http_response_code(503);
    echo json_encode(['error' => 'Service unavailable']);
    exit;
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
    exit;
}
?>