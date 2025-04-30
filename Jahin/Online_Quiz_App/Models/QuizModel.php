<?php
require_once __DIR__ . '/Model.php';

class QuizModel extends Model {
    public function getAllQuizzes() {
        $query = "SELECT q.*, u.username as creator_name 
                 FROM quizzes q 
                 LEFT JOIN users u ON q.created_by = u.id";
        return $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getQuizById($id) {
        $query = "SELECT * FROM quizzes WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createQuiz($data) {
        $query = "INSERT INTO quizzes (title, description, created_by, duration, passing_score) 
                 VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            $data['title'],
            $data['description'],
            $_SESSION['user_id'] ?? null,
            $data['duration'],
            $data['passing_score']
        ]);
        return $this->db->lastInsertId();
    }

    public function updateQuiz($id, $data) {
        $query = "UPDATE quizzes 
                 SET title = ?, description = ?, duration = ?, passing_score = ? 
                 WHERE id = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            $data['title'],
            $data['description'],
            $data['duration'],
            $data['passing_score'],
            $id
        ]);
    }

    public function deleteQuiz($id) {
        $query = "DELETE FROM quizzes WHERE id = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$id]);
    }

    public function getQuizResults($quizId = null) {
        $query = "SELECT qa.*, q.title as quiz_title, u.username 
                 FROM quiz_attempts qa 
                 JOIN quizzes q ON qa.quiz_id = q.id 
                 JOIN users u ON qa.user_id = u.id";
        $params = [];
        
        if ($quizId) {
            $query .= " WHERE qa.quiz_id = ?";
            $params[] = $quizId;
        }
        
        $query .= " ORDER BY qa.start_time DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addQuestion($quizId, $questionData) {
        $query = "INSERT INTO questions (quiz_id, question_text, question_type, points) 
                 VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            $quizId,
            $questionData['question_text'],
            $questionData['question_type'],
            $questionData['points'] ?? 1
        ]);
        return $this->db->lastInsertId();
    }

    public function addAnswer($questionId, $answerData) {
        $query = "INSERT INTO answers (question_id, answer_text, is_correct) 
                 VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            $questionId,
            $answerData['answer_text'],
            $answerData['is_correct'] ?? false
        ]);
    }
}