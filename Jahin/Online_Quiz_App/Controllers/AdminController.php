<?php
require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../Models/UserModel.php';
require_once __DIR__ . '/../Models/QuizModel.php';

class AdminController extends Controller {
    private $userModel;
    private $quizModel;

    public function __construct() {
        parent::__construct();
        $this->userModel = new UserModel();
        $this->quizModel = new QuizModel();
    }

    public function getUsers() {
        try {
            $users = $this->userModel->getAllUsers();
            return $this->jsonResponse(['success' => true, 'users' => $users]);
        } catch (Exception $e) {
            return $this->jsonResponse(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function createUser() {
        try {
            $data = $this->getRequestData();
            $required = ['username', 'email', 'password', 'role'];
            
            foreach ($required as $field) {
                if (!isset($data[$field])) {
                    throw new Exception("Missing required field: {$field}");
                }
            }

            $userId = $this->userModel->createUser($data);
            return $this->jsonResponse(['success' => true, 'userId' => $userId]);
        } catch (Exception $e) {
            return $this->jsonResponse(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function updateUser($userId) {
        try {
            if (!is_numeric($userId)) {
                throw new Exception('Invalid user ID format');
            }
            
            $data = $this->getRequestData();
            $success = $this->userModel->updateUser($userId, $data);
            return $this->jsonResponse(['success' => $success]);
        } catch (Exception $e) {
            return $this->jsonResponse(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function deleteUser($userId) {
        try {
            if (!is_numeric($userId)) {
                throw new Exception('Invalid user ID format');
            }
            
            $success = $this->userModel->deleteUser($userId);
            return $this->jsonResponse(['success' => $success]);
        } catch (Exception $e) {
            return $this->jsonResponse(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function getQuizzes() {
        try {
            $quizzes = $this->quizModel->getAllQuizzes();
            return $this->jsonResponse(['success' => true, 'quizzes' => $quizzes]);
        } catch (Exception $e) {
            return $this->jsonResponse(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function createQuiz() {
        try {
            $data = $this->getRequestData();
            $required = ['title', 'description', 'duration', 'passing_score'];
            
            foreach ($required as $field) {
                if (!isset($data[$field])) {
                    throw new Exception("Missing required field: {$field}");
                }
            }

            $quizId = $this->quizModel->createQuiz($data);
            return $this->jsonResponse(['success' => true, 'quizId' => $quizId]);
        } catch (Exception $e) {
            return $this->jsonResponse(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function updateQuiz($quizId) {
        try {
            if (!is_numeric($quizId)) {
                throw new Exception('Invalid quiz ID format');
            }
            
            $data = $this->getRequestData();
            $success = $this->quizModel->updateQuiz($quizId, $data);
            return $this->jsonResponse(['success' => $success]);
        } catch (Exception $e) {
            return $this->jsonResponse(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function deleteQuiz($quizId) {
        try {
            if (!is_numeric($quizId)) {
                throw new Exception('Invalid quiz ID format');
            }
            
            $success = $this->quizModel->deleteQuiz($quizId);
            return $this->jsonResponse(['success' => $success]);
        } catch (Exception $e) {
            return $this->jsonResponse(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function getQuizResults() {
        try {
            $data = $this->getRequestData();
            $quizId = isset($data['quiz_id']) ? $data['quiz_id'] : null;
            $results = $this->quizModel->getQuizResults($quizId);
            return $this->jsonResponse(['success' => true, 'results' => $results]);
        } catch (Exception $e) {
            return $this->jsonResponse(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    private function getRequestData() {
        return json_decode(file_get_contents('php://input'), true);
    }

    private function jsonResponse($data) {
        header('Content-Type: application/json');
        return json_encode($data);
    }
}