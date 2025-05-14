-- Database schema version 1.0

-- Create users table with full schema
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create quizzes table
CREATE TABLE quizzes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    question_text TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create quiz options table with proper foreign key
CREATE TABLE quiz_options (
    id INT AUTO_INCREMENT PRIMARY KEY,
    quiz_id INT NOT NULL,
    option_text TEXT NOT NULL,
    is_correct BOOLEAN DEFAULT false,
    FOREIGN KEY (quiz_id) REFERENCES quizzes(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create user submissions table with cascade deletes
CREATE TABLE user_submissions (
    user_id INT NOT NULL,
    question_id INT NOT NULL,
    selected_answers JSON NOT NULL,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (question_id) REFERENCES quizzes(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create quiz results table
CREATE TABLE IF NOT EXISTS quiz_results (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    score INT NOT NULL,
    completed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Add password reset functionality
CREATE TABLE IF NOT EXISTS password_reset_tokens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    token VARCHAR(64) NOT NULL,
    expires DATETIME NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Authentication tokens table
CREATE TABLE IF NOT EXISTS auth_tokens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    selector VARCHAR(255) NOT NULL UNIQUE,
    hashed_validator VARCHAR(255) NOT NULL,
    expires DATETIME NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Initial data population
INSERT INTO quizzes (question_text) VALUES
('What is the capital of France?'),
('Which planet is closest to the Sun?'),
('What is the largest ocean on Earth?'),
('Who wrote the play "Romeo and Juliet"?'),
('What is the chemical symbol for water?'),
('Who painted the Mona Lisa?'),
('What is the largest continent by area?'),
('What is the square root of 64?'),
('Which element has the atomic number 1?'),
('What is the currency of Japan?'),
('Which country is known as the Land of the Rising Sun?'),
('What is the largest desert in the world?'),
('What is the smallest country in the world?'),
('Who discovered penicillin?'),
('Which animal is known as the King of the Jungle?');

INSERT INTO quiz_options (quiz_id, option_text, is_correct) VALUES
(1, 'Paris', true),
(1, 'London', false),
(1, 'Berlin', false),
(2, 'Mercury', true),
(2, 'Venus', false),
(2, 'Mars', false),
(3, 'Pacific Ocean', true),
(3, 'Atlantic Ocean', false),
(3, 'Indian Ocean', false),
(4, 'Shakespeare', true),
(4, 'Dickens', false),
(4, 'Hemingway', false),
(5, 'H2O', true),
(5, 'O2', false),
(5, 'CO2', false),
(6, 'Da Vinci', true),
(6, 'Van Gogh', false),
(6, 'Picasso', false),
(7, 'Asia', true),
(7, 'Africa', false),
(7, 'North America', false),
(8, '8', true),
(8, '6', false),
(8, '10', false),
(9, 'Hydrogen', true),
(9, 'Oxygen', false),
(9, 'Helium', false),
(10, 'Yen', true),
(10, 'Won', false),
(10, 'Peso', false),
(11, 'Japan', true),
(11, 'China', false),
(11, 'India', false),
(12, 'Antarctic', true),
(12, 'Sahara', false),
(12, 'Gobi', false),
(13, 'Fleming', true),
(13, 'Curie', false),
(13, 'Einstein', false),
(14, 'Lion', true),
(14, 'Tiger', false),
(14, 'Elephant', false);
