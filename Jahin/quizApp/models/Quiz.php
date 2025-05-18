<?php

class Quiz {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($title, $description, $categoryId, $timeLimit, $createdBy) {
        $stmt = $this->db->prepare("INSERT INTO tests (title, description, category_id, time_limit, created_by) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiii", $title, $description, $categoryId, $timeLimit, $createdBy);
        return $stmt->execute();
    }

    public function update($id, $title, $description, $categoryId, $timeLimit) {
        $stmt = $this->db->prepare("UPDATE tests SET title = ?, description = ?, category_id = ?, time_limit = ? WHERE id = ?");
        $stmt->bind_param("ssiii", $title, $description, $categoryId, $timeLimit, $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM tests WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function getAll() {
        $result = $this->db->query("SELECT * FROM tests ORDER BY created_at DESC");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM tests WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}