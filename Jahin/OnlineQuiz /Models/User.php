<?php
class User {
    /**
     * @var string TABLE_NAME Database table name
     */
    const TABLE_NAME = 'users';

    /**
     * Database schema definition
     */
    public static $schema = [
        'id' => 'INT PRIMARY KEY AUTO_INCREMENT',
        'username' => 'VARCHAR(255) UNIQUE NOT NULL',
        'email' => 'VARCHAR(255) UNIQUE NOT NULL',
        'password_hash' => 'VARCHAR(255) NOT NULL',
        'created_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
    ];

    /**
     * Get user by credentials
     */
    public static function getByCredentials($pdo, $identifier) {
        $stmt = $pdo->prepare('SELECT * FROM '.self::TABLE_NAME.' WHERE username = ? OR email = ?');
        $stmt->execute([$identifier, $identifier]);
        return $stmt->fetch();
    }
}