<?php

require_once __DIR__.'/../config/database.php';
require_once __DIR__.'/../models/Quiz.php';
require_once __DIR__.'/../models/Question.php';
require_once __DIR__.'/../models/Result.php';
require_once __DIR__.'/../models/User.php'; // Add this
require_once __DIR__.'/../helpers/Session.php';
class QuizTakeController {
    private $db;
    private $session;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->session = new Session();
        $this->checkAuthentication();
    }

    public function start($quizId) {
        $quiz = new Quiz($this->db);
        $quizData = $quiz->getById($quizId);

        if (!$quizData) {
            header('Location: /quizApp/quiz');
            exit;
        }

        $question = new Question($this->db);
        $questions = $question->getByQuiz($quizId);

        $_SESSION['current_quiz'] = [
            'quiz_id' => $quizId,
            'start_time' => time(),
            'questions' => $questions
        ];

        require_once __DIR__.'/../views/quiz/take.php';
    }

    public function submit() {
        if (!isset($_SESSION['current_quiz'])) {
            header('Location: /quizApp/quiz');
            exit;
        }

        $quizData = $_SESSION['current_quiz'];
        $result = new Result($this->db);
        $this->db->autocommit(false); // Start MySQLi transaction

        try {
            $score = 0;
            $total = count($quizData['questions']);
            $essayAnswers = [];

            foreach ($quizData['questions'] as $q) {
                $answer = $_POST['answers'][$q['id']] ?? '';

                if ($q['question_type'] === 'mcq') {
                    if ($answer === $q['correct_answer']) {
                        $score += $q['weight'];
                    }
                } else {
                    $essayAnswers[$q['id']] = $answer;
                }
            }

            $percentage = ($score / $total) * 100;
            $resultId = $result->create(
                $this->session->get('user_id'),
                $quizData['quiz_id'],
                $percentage,
                date('Y-m-d H:i:s', $quizData['start_time']),
                date('Y-m-d H:i:s')
            );

            foreach ($essayAnswers as $questionId => $answer) {
                $result->saveEssayAnswer($resultId, $questionId, $answer);
            }

            
            $this->db->commit();

            unset($_SESSION['current_quiz']);
            $this->session->setFlash('success', "Quiz submitted! Score: $score/$total");

            $_SESSION['quiz_results'] = [
                'score' => $score,
                'total' => $total,
                'questions' => $quizData['questions'],
                'answers' => $_POST['answers']
            ];

            header('Location: /quizApp/quiz/results');
            exit;

        } catch (Exception $e) {
            $this->db->rollback();
            $this->session->setFlash('error', 'An error occurred while submitting the quiz.');
            header('Location: /quizApp/quiz');
            exit;
        }
    }

    
    private function checkAuthentication() {
        if (!$this->session->get('user_id')) {
            header('Location: /quizApp/login');
            exit;
        }
    }
}
