<?php
require_once __DIR__ . '/config.php'; require_once __DIR__ . '/conn/conn.php';
$questions = $conn->query('SELECT tbl_quiz_id, quiz_question, option_a, option_b, option_c, option_d FROM tbl_quiz ORDER BY tbl_quiz_id')->fetchAll();
$pageTitle = 'Take quiz'; include __DIR__ . '/partials/header.php';
?>
<section class="panel"><h1>Multiple-choice quiz</h1><p>Select one answer for each question. Your score is calculated securely on the server.</p>
<?php if (!$questions): ?><div class="alert alert-info">No questions are available yet. Please check back later.</div><?php else: ?>
<form action="<?= e(base_path()) ?>/endpoint/add-result.php" method="post"><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
<div class="form-row"><div class="form-group col-md-6"><label for="quizTaker">Full name</label><input class="form-control" id="quizTaker" name="quiz_taker" maxlength="120" required></div><div class="form-group col-md-6"><label for="yearSection">Year and section</label><input class="form-control" id="yearSection" name="year_section" maxlength="80" required></div></div>
<?php foreach ($questions as $q): ?><fieldset class="question-card"><legend><?= e($q['quiz_question']) ?></legend><?php foreach (['A'=>'option_a','B'=>'option_b','C'=>'option_c','D'=>'option_d'] as $letter=>$column): ?><div class="form-check"><input class="form-check-input" type="radio" id="q<?= (int)$q['tbl_quiz_id'] ?><?= $letter ?>" name="answers[<?= (int)$q['tbl_quiz_id'] ?>]" value="<?= $letter ?>"><label class="form-check-label" for="q<?= (int)$q['tbl_quiz_id'] ?><?= $letter ?>"><?= e($letter . '. ' . $q[$column]) ?></label></div><?php endforeach; ?></fieldset><?php endforeach; ?>
<button class="btn btn-primary" type="submit">Submit quiz</button></form><?php endif; ?></section>
<?php include __DIR__ . '/partials/footer.php'; ?>
