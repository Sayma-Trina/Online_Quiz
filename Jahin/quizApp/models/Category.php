<?php

class Category {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($name, $parentId = null) {
        $stmt = $this->db->prepare("INSERT INTO categories (name, parent_id) VALUES (?, ?)");
        $stmt->bind_param("si", $name, $parentId);
        return $stmt->execute();
    }

    public function update($id, $name, $parentId) {
        $stmt = $this->db->prepare("UPDATE categories SET name = ?, parent_id = ? WHERE id = ?");
        $stmt->bind_param("sii", $name, $parentId, $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM categories WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function getAll() {
        $result = $this->db->query("SELECT * FROM categories ORDER BY parent_id, name");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}