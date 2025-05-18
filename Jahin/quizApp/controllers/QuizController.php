<?php

require_once __DIR__.'/../config/database.php';
require_once __DIR__.'/../models/Quiz.php';
require_once __DIR__.'/../models/Category.php';
require_once __DIR__.'/../helpers/Session.php';

class QuizController {
    private $db;
    private $session;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->session = new Session();
    }

    public function index() {
        $quiz = new Quiz($this->db);
        $quizzes = $quiz->getAll();
        $category = new Category($this->db);
        $categories = $category->getAll();

        require_once __DIR__.'/../views/quiz/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $categoryId = $_POST['category_id'];
            $timeLimit = $_POST['time_limit'];

            $quiz = new Quiz($this->db);
            if ($quiz->create($title, $description, $categoryId, $timeLimit, $this->session->get('user_id'))) {
                $this->session->setFlash('success', 'Quiz created successfully');
                header('Location: /quizApp/quiz');
                exit;
            }

            $this->session->setFlash('error', 'Quiz creation failed');
            header('Location: /quizApp/quiz/create');
            exit;
        }

        $category = new Category($this->db);
        $categories = $category->getAll();
        require_once __DIR__.'/../views/quiz/create.php';
    }

    public function edit($id) {
        $quiz = new Quiz($this->db);
        $quizData = $quiz->getById($id);

        if (!$quizData) {
            header('Location: /quizApp/quiz');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $categoryId = $_POST['category_id'];
            $timeLimit = $_POST['time_limit'];

            if ($quiz->update($id, $title, $description, $categoryId, $timeLimit)) {
                $this->session->setFlash('success', 'Quiz updated successfully');
                header('Location: /quizApp/quiz');
                exit;
            }

            $this->session->setFlash('error', 'Quiz update failed');
        }

        $category = new Category($this->db);
        $categories = $category->getAll();
        require_once __DIR__.'/../views/quiz/edit.php';
    }

    public function delete($id) {
        $quiz = new Quiz($this->db);
        if ($quiz->delete($id)) {
            $this->session->setFlash('success', 'Quiz deleted successfully');
        } else {
            $this->session->setFlash('error', 'Quiz deletion failed');
        }
        header('Location: /quizApp/quiz');
        exit;
    }
}