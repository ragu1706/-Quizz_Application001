<?php
require_once __DIR__ . '/config.php';
if (!empty($_SESSION['teacher_authenticated'])) { redirect_to('teacher.php'); }
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $configuredPassword = env_value('TEACHER_PASSWORD');
    $providedPassword = (string)($_POST['password'] ?? '');
    if ($configuredPassword !== '' && hash_equals($configuredPassword, $providedPassword)) {
        session_regenerate_id(true);
        $_SESSION['teacher_authenticated'] = true;
        redirect_to('teacher.php');
    }
    $error = 'Login failed. Check the configured teacher password.';
}
$pageTitle = 'Teacher login'; include __DIR__ . '/partials/header.php';
?>
<section class="panel narrow"><h1>Teacher login</h1><p>Set <code>TEACHER_PASSWORD</code> in your server environment before logging in.</p><?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?><form method="post"><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>"><div class="form-group"><label for="password">Teacher password</label><input class="form-control" id="password" name="password" type="password" autocomplete="current-password" required></div><button class="btn btn-primary" type="submit">Log in</button></form></section>
<?php include __DIR__ . '/partials/footer.php'; ?>
