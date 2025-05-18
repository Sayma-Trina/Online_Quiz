<?php

class Result {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($userId, $quizId, $score, $startTime, $endTime) {
        $stmt = $this->db->prepare("INSERT INTO results (user_id, quiz_id, score, start_time, end_time) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$userId, $quizId, $score, $startTime, $endTime]);
        return $this->db->lastInsertId();
    }

    
    public function saveEssayAnswer($resultId, $questionId, $answer) {
        $stmt = $this->db->prepare("INSERT INTO essay_answers (result_id, question_id, answer) VALUES (?, ?, ?)");
        return $stmt->execute([$resultId, $questionId, $answer]);
    }
}