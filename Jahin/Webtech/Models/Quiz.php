<?php
class Quiz {
    /**
     * Database table definitions
     */
    const QUIZ_TABLE = 'quizzes';
    const OPTIONS_TABLE = 'quiz_options';
    const RESULTS_TABLE = 'quiz_results';

    public static $schema = [
        self::QUIZ_TABLE => [
            'id' => 'INT PRIMARY KEY AUTO_INCREMENT',
            'question_text' => 'TEXT NOT NULL',
            'created_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
        ],
        self::RESULTS_TABLE => [
            'id' => 'INT PRIMARY KEY AUTO_INCREMENT',
            'user_id' => 'INT NOT NULL',
            'score' => 'INT NOT NULL',
            'completed_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'FOREIGN KEY (user_id) REFERENCES '.User::TABLE_NAME.'(id)'
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
            'SELECT q.id, q.question_text, o.option_text, o.is_correct '.
            'FROM '.self::QUIZ_TABLE.' q '.
            'JOIN '.self::OPTIONS_TABLE.' o ON q.id = o.quiz_id '.
            'ORDER BY q.id, o.id'
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function saveResult($pdo, $user_id, $score) {
        $stmt = $pdo->prepare(
            'INSERT INTO '.self::RESULTS_TABLE.' '.
            '(user_id, score) VALUES (?, ?)'
        );
        return $stmt->execute([$user_id, $score]);
    }
}