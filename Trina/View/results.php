<?php include_once("../Controller/loginController.php"); 
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Results - QuizMaster</title>
    <link rel="stylesheet" href="../Asset/Css/style.css">
    <link rel="stylesheet" href="../Asset/Css/results.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
</head>
<body>


    <nav class="navbar">
        <div class="nav-brand">
            <a href="../index.html">QuizMaster</a>
        </div>
        <div class="nav-toggle">
            <i class="fas fa-bars"></i>
        </div>
        <div class="nav-menu">
            <ul>
                <li><a href="../index.html">Home</a></li>
                <li><a href="quiz.html">My Quizzes</a></li>
                <li>
                    <div class="notification-bell">
                        <i class="fas fa-bell"></i>
                        <span class="notification-count">2</span>
                    </div>
                </li>
                <li>
                <a href="logout.php" class="logout-button">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </li>
            </ul>
        </div>
    </nav>

    <div class="results-container">
        <div class="results-header">
            <h1>Quiz Results</h1>
            <p>Geography Quiz - World Capitals</p>
        </div>

        <div class="score-card">
            <div class="score-circle">85%</div>
            <h2>Great Job!</h2>
            <p>You've completed the quiz successfully</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <h3>Correct Answers</h3>
                <div class="number">17/20</div>
            </div>
            <div class="stat-card">
                <h3>Time Taken</h3>
                <div class="number">12:45</div>
            </div>
            <div class="stat-card">
                <h3>Accuracy</h3>
                <div class="number">85%</div>
            </div>
        </div>

        <div class="answers-review">
            <div class="answers-header">
                <h2>Answers Review</h2>
                <button class="export-button" onclick="exportData('pdf')">
                    <i class="fas fa-download"></i> Export Results
                </button>
            </div>

            <div class="answers-list">
                <div class="answer-item">
                    <div class="answer-status correct">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="answer-content">
                        <h4>What is the capital of France?</h4>
                        <p>Your answer: Paris</p>
                    </div>
                </div>

                <div class="answer-item">
                    <div class="answer-status incorrect">
                        <i class="fas fa-times"></i>
                    </div>
                    <div class="answer-content">
                        <h4>What is the capital of Japan?</h4>
                        <p>Your answer: Osaka (Correct: Tokyo)</p>
                    </div>
                </div>

                <div class="answer-item">
                    <div class="answer-status correct">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="answer-content">
                        <h4>What is the capital of Australia?</h4>
                        <p>Your answer: Canberra</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="action-buttons">
            <button class="action-button retry-button">
                <i class="fas fa-redo"></i> Try Again
            </button>
            <button class="action-button share-button">
                <i class="fas fa-share"></i> Share Results
            </button>
            <button class="action-button certificate-button">
                <i class="fas fa-certificate"></i> View Certificate
            </button>
        </div>
    </div>

    <script src="../Asset/Js/main.js"></script>
    <script src="../Asset/Js/results.js">
       
    </script>
</body>
</html>