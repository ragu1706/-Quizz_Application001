<?php require_once __DIR__ . '/../config.php'; ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($pageTitle ?? 'Online Quiz System') ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= e(base_path()) ?>/assets/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="<?= e(base_path()) ?>/index.php">Online Quiz System</a>
  <div class="navbar-nav ml-auto">
    <a class="nav-link" href="<?= e(base_path()) ?>/student.php">Student</a>
    <?php if (!empty($_SESSION['teacher_authenticated'])): ?>
      <a class="nav-link" href="<?= e(base_path()) ?>/teacher.php">Teacher</a>
      <form class="form-inline" action="<?= e(base_path()) ?>/logout.php" method="post"><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>"><button class="btn btn-outline-light btn-sm" type="submit">Log out</button></form>
    <?php else: ?><a class="nav-link" href="<?= e(base_path()) ?>/teacher-login.php">Teacher login</a><?php endif; ?>
  </div>
</nav>
<main class="container py-4">
