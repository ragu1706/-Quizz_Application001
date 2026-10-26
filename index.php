<?php $pageTitle = 'Online Quiz System'; include __DIR__ . '/partials/header.php'; ?>
<section class="hero text-center py-5"><h1>Online Quiz System</h1><p class="lead">Practice, submit your answers, and review your score.</p><div class="mt-4"><a class="btn btn-primary btn-lg mr-2" href="<?= e(base_path()) ?>/student.php">Take a quiz</a><a class="btn btn-outline-light btn-lg" href="<?= e(base_path()) ?>/teacher-login.php">Teacher login</a></div></section>
<?php include __DIR__ . '/partials/footer.php'; ?>
