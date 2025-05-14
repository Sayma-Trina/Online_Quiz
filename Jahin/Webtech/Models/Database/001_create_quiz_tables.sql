-- Database schema for quiz system
CREATE TABLE IF NOT EXISTS quizzes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS quiz_options (
    id INT AUTO_INCREMENT PRIMARY KEY,
    quiz_id INT NOT NULL,
    option_text TEXT NOT NULL,
    is_correct BOOLEAN DEFAULT false,
    FOREIGN KEY (quiz_id) REFERENCES quizzes(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO quizzes (question) VALUES
('What is the capital of France?'),
('Which planet is closest to the Sun?');

INSERT INTO quiz_options (quiz_id, option_text, is_correct) VALUES
(1, 'London', false),
(1, 'Paris', true),
(1, 'Berlin', false),
(2, 'Venus', false),
(2, 'Mercury', true),
(2, 'Mars', false);