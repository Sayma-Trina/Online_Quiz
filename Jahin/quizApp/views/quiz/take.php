<?php
$quizData = $_SESSION['current_quiz'];
$timeLimitMinutes = $quizData['questions'][0]['time_limit'] ?? 30;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Take Quiz</title>
    <link rel="stylesheet" href="/quizApp/assets/css/styles.css">
    <script>
        let timeLeft = <?= $timeLimitMinutes * 60 ?>;
        
        function updateTimer() {
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            document.getElementById('timer').textContent = 
                `${minutes}:${seconds.toString().padStart(2, '0')}`;
            
            if (timeLeft <= 0) {
                document.forms['quizForm'].submit();
            } else {
                timeLeft--;
                setTimeout(updateTimer, 1000);
            }
        }
        
        window.onload = function() {
            updateTimer();
        };
    </script>
</head>
<body>
    <div class="container">
        <div class="timer-box">
            Time Remaining: <span id="timer"></span>
        </div>
        
        <form id="quizForm" method="POST" action="/quizApp/quiz/submit">
            <?php foreach ($quizData['questions'] as $index => $question): ?>
                <div class="question-card">
                    <h3>Question <?= $index + 1 ?></h3>
                    <p><?= htmlspecialchars($question['question_text']) ?></p>
                    
                    <?php if ($question['question_type'] === 'mcq'): ?>
                        <?php $options = json_decode($question['options'], true); ?>
                        <?php foreach ($options as $key => $value): ?>
                            <label class="option">
                                <input type="radio" 
                                    name="answers[<?= $question['id'] ?>]" 
                                    value="<?= $key ?>"
                                    required>
                                <?= htmlspecialchars($value) ?>
                            </label>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <textarea 
                            name="answers[<?= $question['id'] ?>]"
                            rows="4"
                            placeholder="Type your answer here..."
                            required></textarea>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
            
            <button type="submit" class="btn submit-btn">Submit Quiz</button>
        </form>
    </div>
</body>
</html>