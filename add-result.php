<?php
require_once __DIR__ . '/../config.php'; require_once __DIR__ . '/../conn/conn.php';
if($_SERVER['REQUEST_METHOD']!=='POST'){http_response_code(405);exit('Method not allowed.');}verify_csrf();
$name=trim((string)($_POST['quiz_taker']??''));$section=trim((string)($_POST['year_section']??''));if($name===''||strlen($name)>120||$section===''||strlen($section)>80){http_response_code(422);exit('Please enter a valid name and year/section.');}
$submitted=$_POST['answers']??[];if(!is_array($submitted))$submitted=[];$questions=$conn->query('SELECT tbl_quiz_id, correct_answer FROM tbl_quiz')->fetchAll();if(!$questions){http_response_code(422);exit('No quiz questions are available.');}$score=0;
foreach($questions as $q){$id=(string)$q['tbl_quiz_id'];$answer=strtoupper(trim((string)($submitted[$id]??'')));if(in_array($answer,['A','B','C','D'],true)&&$answer===$q['correct_answer'])$score++;}
$stmt=$conn->prepare('INSERT INTO tbl_result (quiz_taker, year_section, total_score, date_taken) VALUES (:name,:section,:score,CURRENT_TIMESTAMP)');$stmt->execute(['name'=>$name,'section'=>$section,'score'=>$score]);$_SESSION['last_score']=['score'=>$score,'total'=>count($questions)];redirect_to('result.php');
