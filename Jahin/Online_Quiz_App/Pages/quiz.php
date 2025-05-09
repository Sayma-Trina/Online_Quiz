<?php
require_once __DIR__ . '/../Views/template.php';

// Start output buffering
ob_start();

// Display header with authentication requirement
echo Template::header('Available Quizzes', true);
?>

<div class="quiz-list-container">
    <h1>Available Quizzes</h1>
    <div class="quiz-grid">
        <?php
        // TODO: Fetch actual quizzes from database
        $sample_quizzes = [
            ['id' => 1, 'title' => 'Mathematics Basics', 'duration' => '30 minutes', 'questions' => 20],
            ['id' => 2, 'title' => 'Science Fundamentals', 'duration' => '45 minutes', 'questions' => 25],
            ['id' => 3, 'title' => 'History Quiz', 'duration' => '40 minutes', 'questions' => 30]
        ];

        foreach ($sample_quizzes as $quiz): ?>
            <div class="quiz-card">
                <h3><?php echo htmlspecialchars($quiz['title']); ?></h3>
                <div class="quiz-info">
                    <p><strong>Duration:</strong> <?php echo htmlspecialchars($quiz['duration']); ?></p>
                    <p><strong>Questions:</strong> <?php echo htmlspecialchars($quiz['questions']); ?></p>
                </div>
                <a href="take-quiz.php?id=<?php echo $quiz['id']; ?>" class="btn-primary">Start Quiz</a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php
// Display footer
echo Template::footer();

// Send output to browser
ob_end_flush();