<?php $pageTitle = 'Student'; include __DIR__ . '/partials/header.php'; ?>
<section class="panel"><h1>Welcome, Student</h1><p>Answer the multiple-choice questions and submit your attempt to save your score.</p><a class="btn btn-primary" href="<?= e(base_path()) ?>/take-quiz.php">Start quiz</a></section>
<?php include __DIR__ . '/partials/footer.php'; ?>
