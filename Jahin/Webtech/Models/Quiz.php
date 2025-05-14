<?php
class Quiz {
    /**
     * Database table definitions
     */
    const QUIZ_TABLE = 'quizzes';
    const OPTIONS_TABLE = 'quiz_options';

    public static $schema = [
        self::QUIZ_TABLE => [
            'id' => 'INT PRIMARY KEY AUTO_INCREMENT',
            'question' => 'TEXT NOT NULL',
            'created_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
        ],
        self::OPTIONS_TABLE => [
            'id' => 'INT PRIMARY KEY AUTO_INCREMENT',
            'quiz_id' => 'INT NOT NULL',
            'option_text' => 'TEXT NOT NULL',
            'is_correct' => 'BOOLEAN DEFAULT FALSE',
            'FOREIGN KEY (quiz_id) REFERENCES '.self::QUIZ_TABLE.'(id)'
        ]
    ];

    /**
     * Get all quiz questions with options
     */
    public static function getAllWithOptions($pdo) {
        $stmt = $pdo->query(
            'SELECT q.id, q.question, o.option_text, o.is_correct '.
            'FROM '.self::QUIZ_TABLE.' q '.
            'JOIN '.self::OPTIONS_TABLE.' o ON q.id = o.quiz_id '.
            'ORDER BY q.id, o.id'
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}