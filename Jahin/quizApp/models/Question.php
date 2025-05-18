<?php

class Question {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($quizId, $questionText, $type, $options, $correctAnswer) {
        $stmt = $this->db->prepare("INSERT INTO questions (test_id, question_type, question_text, options, correct_answer) VALUES (?, ?, ?, ?, ?)");
        $optionsJson = json_encode($options);
        $stmt->bind_param("issss", $quizId, $type, $questionText, $optionsJson, $correctAnswer);
        return $stmt->execute();
    }

    public function getByQuiz($quizId) {
        $stmt = $this->db->prepare("SELECT * FROM questions WHERE test_id = ? ORDER BY id");
        $stmt->bind_param("i", $quizId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function update($id, $questionText, $type, $options, $correctAnswer) {
        $stmt = $this->db->prepare("UPDATE questions SET question_text = ?, question_type = ?, options = ?, correct_answer = ? WHERE id = ?");
        $optionsJson = json_encode($options);
        $stmt->bind_param("ssssi", $questionText, $type, $optionsJson, $correctAnswer, $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM questions WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}