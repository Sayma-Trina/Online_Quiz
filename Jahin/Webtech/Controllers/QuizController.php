<?php
require_once __DIR__.'/../Models/Quiz.php';
require_once __DIR__.'/config.php';

class QuizController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getQuizData() {
        try {
            $stmt = $this->pdo->query('SELECT q.id, q.question_text, o.id AS option_id, o.option_text, o.is_correct FROM '.Quiz::QUIZ_TABLE.' q JOIN '.Quiz::OPTIONS_TABLE.' o ON q.id = o.quiz_id ORDER BY q.id');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $questions = [];
            foreach ($results as $row) {
                $questionId = $row['id'];
                if (!isset($questions[$questionId])) {
                    $questions[$questionId] = [
                        'id' => $questionId,
                        'question' => $row['question_text'],
                        'options' => []
                    ];
                }
                $questions[$questionId]['options'][] = [
                    'id' => $row['option_id'],
                    'text' => $row['option_text'],
                    'correct' => (bool)$row['is_correct']
                ];
            }

            return array_values($questions);
        } catch (PDOException $e) {
            throw new PDOException('Quiz data retrieval failed: ' . $e->getMessage());
        }
    }

    public function getQuizDataWithAnswers() {
        try {
            $stmt = $this->pdo->query('SELECT q.id, q.question_text, o.id AS option_id, o.option_text, o.is_correct FROM '.Quiz::QUIZ_TABLE.' q JOIN '.Quiz::OPTIONS_TABLE.' o ON q.id = o.quiz_id ORDER BY q.id');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $questions = [];
            foreach ($results as $row) {
                $questionId = $row['id'];
                if (!isset($questions[$questionId])) {
                    $questions[$questionId] = (object)[
                        'id' => $questionId,
                        'question_text' => $row['question_text'],
                        'options' => []
                    ];
                }
                $questions[$questionId]->options[] = (object)[
                    'id' => $row['option_id'],
                    'option_text' => $row['option_text'],
                    'is_correct' => (bool)$row['is_correct']
                ];
            }

            return array_values($questions);
        } catch (PDOException $e) {
            throw new PDOException('Quiz data retrieval failed: ' . $e->getMessage());
        }
    }

    public function submitQuiz($userId, $answers) {
        try {
            $score = 0;
            $stmt = $this->pdo->query(
                'SELECT q.id, o.id AS option_id '.
                'FROM '.Quiz::QUIZ_TABLE.' q '.
                'JOIN '.Quiz::OPTIONS_TABLE.' o ON q.id = o.quiz_id '.
                'WHERE o.is_correct = 1'
            );
            $correctAnswers = $stmt->fetchAll(PDO::FETCH_GROUP | PDO::FETCH_COLUMN);

            // Validate single answer per question
            foreach ($answers as $questionId => $selectedOptionId) {
                if (is_array($selectedOptionId)) {
                    throw new Exception("Multiple answers submitted for question $questionId");
                }
            }

            foreach ($answers as $questionId => $selectedOptionId) {
                if (isset($correctAnswers[$questionId]) && 
                    in_array($selectedOptionId, $correctAnswers[$questionId])) {
                    $score++;
                }
            }

            $resultStmt = $this->pdo->prepare(
                'INSERT INTO '.Quiz::RESULTS_TABLE.' (user_id, score) VALUES (?, ?)'
            );
            $resultStmt->execute([$userId, $score]);
            return $score;
        } catch (PDOException $e) {
            throw new Exception("Submission error: " . $e->getMessage());
        }
    }
}