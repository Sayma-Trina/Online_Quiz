<?php
$session = new Session();
$error = $session->getFlash('error');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Quiz</title>
    <link rel="stylesheet" href="/quizApp/assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Create New Quiz</h1>
        
        <?php if ($error): ?>
            <div class="alert error"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST" action="/quizApp/quiz/create">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" required>
            </div>
            
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label>Category</label>
                <select name="category_id" required>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Time Limit (minutes)</label>
                <input type="number" name="time_limit" min="1" value="30" required>
            </div>

            <button type="submit" class="btn">Create Quiz</button>
            <a href="/quizApp/quiz" class="btn cancel">Cancel</a>
        </form>
    </div>
</body>
</html>