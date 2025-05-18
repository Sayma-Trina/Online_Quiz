<?php

class Notification {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($userId, $type, $message) {
        $stmt = $this->db->prepare("INSERT INTO notifications (user_id, type, message) VALUES (?, ?, ?)");
        return $stmt->execute([$userId, $type, $message]);
    }

    public function getUserNotifications($userId) {
        $stmt = $this->db->prepare("SELECT * FROM notifications WHERE user_id = ? ORDER BY created_at DESC");
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public function markAsRead($notificationId) {
        $stmt = $this->db->prepare("UPDATE notifications SET is_read = 1 WHERE id = ?");
        return $stmt->execute([$notificationId]);
    }
}