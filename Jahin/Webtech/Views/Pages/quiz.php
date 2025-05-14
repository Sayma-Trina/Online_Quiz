<?php
require_once __DIR__ . '/../../Controllers/config.php';
require_once __DIR__.'/../../Controllers/QuizController.php';
require_once __DIR__.'/../../Controllers/AuthController.php';

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: login.php');
    exit;
}

try {
    // Fetch user data
    $quizController = new QuizController($pdo);
    $questions = $quizController->getQuizData();
    
    $authController = new AuthController();
    $user = $authController->getUserById($_SESSION['user_id']);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz - QuizMaster</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../Assets/css/quiz.css">
  
</head>
<body>
    
        <div class="nav-brand">
            <a href="../Auth/logout.php">Back To Home</a>
        </div>
   
    

    <div class="quiz-container">
        <div class="quiz-header">
            <div class="quiz-progress">
                <span id="question-count"></span>
                <div class="progress-bar">
                    <div class="progress-fill"></div>
                </div>
            </div>
            <div class="timer">
                <i class="fas fa-clock"></i>
                <span id="time-remaining">14:32</span>
            </div>
        </div>

        <div class="quiz-card">
            <h2 class="question" id="current-question"></h2>
            <ul class="options-list" id="options-list"></ul>
        </div>

        <div class="quiz-navigation">
            <button class="nav-button prev-button">
                <i class="fas fa-arrow-left"></i> Previous
            </button>
            <button class="nav-button next-button">
                Next <i class="fas fa-arrow-right"></i>
            </button>
            <button class="nav-button submit-button" id="submit-quiz">
                Submit <i class="fas fa-paper-plane"></i>
            </button>
        </div>
    </div>

 

   
<script>
    let currentQuestion = 0;
    let userAnswers = {};
    const quizData = <?= json_encode($questions) ?>;

    function initializeQuiz() {
        showQuestion(currentQuestion);
        updateProgress();
        document.getElementById('time-remaining').textContent = '15:00';
        // ... existing code ...
    }

    function showQuestion(index) {
        const questionElement = document.getElementById('current-question');
        const optionsList = document.getElementById('options-list');
        // ... existing code ...
    }

    function selectOption(optionId) {
        userAnswers[quizData[currentQuestion].id] = optionId;
        sessionStorage.setItem('quizProgress', JSON.stringify({
            current: currentQuestion,
            answers: userAnswers
        }));
        // ... existing code ...
    }

    document.getElementById('submit-quiz').addEventListener('click', async () => {
        const response = await fetch('/Webtech/Controllers/submit_quiz.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({ answers: userAnswers })
        });
        // ... existing code ...
    });

    window.addEventListener('load', initializeQuiz);
</script>
</body>
</html>