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
            <a href="../Auth/logout.php">Log Out</a>
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
        startTimer(900); // 15 minutes in seconds
        updateProgress();
        updateNavigation();
    }

    function startTimer(duration) {
        let timer = duration, minutes, seconds;
        const timerInterval = setInterval(() => {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? '0' + minutes : minutes;
            seconds = seconds < 10 ? '0' + seconds : seconds;

            document.getElementById('time-remaining').textContent = minutes + ':' + seconds;

            if (--timer < 0) {
                clearInterval(timerInterval);
                submitQuiz();
            }
        }, 1000);
    }

    function showQuestion(index) {
        const question = quizData[index];
        const questionElement = document.getElementById('current-question');
        const optionsList = document.getElementById('options-list');
        
        questionElement.textContent = question.question;
        optionsList.innerHTML = '';

        userAnswers[question.id] = userAnswers[question.id] || '';
        question.options.forEach(option => {
            const container = document.createElement('div');
            container.className = 'option-container';
    
            const checkbox = document.createElement('input');
            checkbox.type = 'radio';
            checkbox.id = `option-${option.id}`;
            checkbox.name = `question-${question.id}`;
            checkbox.checked = userAnswers[question.id] === option.id;
            checkbox.onchange = () => toggleOption(option.id);

            const label = document.createElement('label');
            label.htmlFor = `option-${option.id}`;
            label.textContent = option.text;

            container.appendChild(checkbox);
            container.appendChild(label);
            optionsList.appendChild(container);
        });

        document.getElementById('question-count').textContent = `Question ${index + 1} of ${quizData.length}`;
        updateNavigation();
    }

    function toggleOption(optionId) {
        const questionId = quizData[currentQuestion].id;
        userAnswers[questionId] = optionId;
        const checkbox = document.getElementById(`option-${optionId}`);
        if (checkbox) checkbox.checked = true;
        sessionStorage.setItem('quizProgress', JSON.stringify({
            current: currentQuestion,
            answers: userAnswers
        }));
        updateProgress();
    }

    function updateProgress() {
        const progress = (Object.keys(userAnswers).length / quizData.length) * 100;
        document.querySelector('.progress-fill').style.width = progress + '%';
    }

    function updateNavigation() {
        document.querySelector('.prev-button').disabled = currentQuestion === 0;
        document.querySelector('.next-button').disabled = currentQuestion === quizData.length - 1;
        document.getElementById('submit-quiz').style.display = 
            currentQuestion === quizData.length - 1 ? 'block' : 'none';
    }

    document.querySelector('.prev-button').addEventListener('click', () => {
        if (currentQuestion > 0) {
            currentQuestion--;
            showQuestion(currentQuestion);
        }
    });

    document.querySelector('.next-button').addEventListener('click', () => {
        if (currentQuestion < quizData.length - 1) {
            currentQuestion++;
            showQuestion(currentQuestion);
        }
    });

    async function submitQuiz() {
        try {
            const controller = new AbortController();
            const timeoutId = setTimeout(() => controller.abort(), 5000);
            
            const submitBtn = document.getElementById('submit-quiz');
            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Submitting...';
            
            const response = await fetch('/Webtech/Controllers/submit_quiz.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({ answers: userAnswers }),
                signal: controller.signal
            });
            
            clearTimeout(timeoutId);
            
            const errorData = await response.json().catch(() => ({}));
            if (!response.ok) {
                throw new Error(errorData.error || `HTTP error! status: ${response.status}`);
            }
            
            const result = await response.json();
            window.location.href = 'result.php';
            
        } catch (error) {
            const errorMessage = error.name === 'AbortError' 
                ? 'Submission timed out. Please check your connection'
                : error.message;
            alert(`Error: ${errorMessage}`);
            submitBtn.disabled = false;
            submitBtn.innerHTML = 'Submit Quiz';
        }
    }
    document.getElementById('submit-quiz').addEventListener('click', submitQuiz);

    window.addEventListener('load', initializeQuiz);
</script>
<script>
let timeLeft = 600; // 10 minutes in seconds
const timerElement = document.getElementById('quiz-timer');

function updateTimer() {
    const minutes = Math.floor(timeLeft / 60);
    const seconds = timeLeft % 60;
    timerElement.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
    
    if(timeLeft <= 0) {
        document.forms['quiz-form'].submit();
    }
    timeLeft--;
}

// Initial call
updateTimer();
setInterval(updateTimer, 1000);
</script>
</body>
</html>