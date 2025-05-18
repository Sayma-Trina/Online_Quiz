<?php
$results = $_SESSION['quiz_results'];
unset($_SESSION['quiz_results']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Quiz Results</title>
    <link rel="stylesheet" href="/quizApp/assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Quiz Results</h1>
        <div class="score-summary">
            <h2>Your Score: <?= $results['score'] ?>/<?= $results['total'] ?></h2>
        </div>

        <?php foreach ($results['questions'] as $index => $question): 
            $userAnswer = $results['answers'][$question['id']];
            $isCorrect = $question['question_type'] === 'mcq' && $userAnswer === $question['correct_answer'];
            ?>
            <div class="result-card <?= $isCorrect ? 'correct' : 'incorrect' ?>">
                <h3>Question <?= $index + 1 ?>: <?= htmlspecialchars($question['question_text']) ?></h3>
                
                <?php if ($question['question_type'] === 'mcq'): 
                    $options = json_decode($question['options'], true);
                    ?>
                    <div class="answer-comparison">
                        <p>Your answer: <?= htmlspecialchars($options[$userAnswer] ?? 'N/A') ?></p>
                        <p>Correct answer: <?= htmlspecialchars($options[$question['correct_answer']] ?? 'N/A') ?></p>
                    </div>
                <?php else: ?>
                    <div class="essay-response">
                        <h4>Your response:</h4>
                        <div class="answer-box"><?= nl2br(htmlspecialchars($userAnswer)) ?></div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
        
        <a href="/quizApp/quiz" class="btn">Return to Quizzes</a>
    </div>
</body>
</html>