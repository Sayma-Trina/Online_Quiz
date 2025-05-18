<?php
$session = new Session();
$success = $session->getFlash('success');
$error = $session->getFlash('error');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Quizzes</title>
    <link rel="stylesheet" href="/quizApp/assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Quizzes</h1>
        <?php if ($success): ?>
            <div class="alert success"><?= $success ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="alert error"><?= $error ?></div>
        <?php endif; ?>
        
        <a href="/quizApp/quiz/create" class="btn">Create New Quiz</a>
        
        <table class="quiz-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Time Limit</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($quizzes as $quiz): ?>
                    <tr>
                        <td><?= htmlspecialchars($quiz['title']) ?></td>
                        <td><?= htmlspecialchars($quiz['category_id']) ?></td>
                        <td><?= $quiz['time_limit'] ?> mins</td>
                        <td>
                            <a href="/quizApp/quiz/edit/<?= $quiz['id'] ?>" class="btn edit">Edit</a>
                            <a href="/quizApp/quiz/delete/<?= $quiz['id'] ?>" class="btn danger" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>