<?php
require_once __DIR__ . '/../config.php'; require_teacher(); require_once __DIR__ . '/../conn/conn.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); exit('Method not allowed.'); } verify_csrf();
$fields = ['quiz_question','option_a','option_b','option_c','option_d']; $data=[];
foreach ($fields as $field) { $value = trim((string)($_POST[$field] ?? '')); if ($value === '' || strlen($value) > ($field === 'quiz_question' ? 2000 : 1000)) { http_response_code(422); exit('Please complete all fields within the allowed length.'); } $data[$field]=$value; }
$answer = strtoupper(trim((string)($_POST['correct_answer'] ?? ''))); if (!in_array($answer, ['A','B','C','D'], true)) { http_response_code(422); exit('Correct answer must be A, B, C, or D.'); }
$stmt=$conn->prepare('INSERT INTO tbl_quiz (quiz_question, option_a, option_b, option_c, option_d, correct_answer) VALUES (:quiz_question,:option_a,:option_b,:option_c,:option_d,:correct_answer)'); $stmt->execute($data + ['correct_answer'=>$answer]); redirect_to('teacher.php');
