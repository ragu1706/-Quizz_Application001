<?php
require_once __DIR__ . '/../config.php'; require_teacher(); require_once __DIR__ . '/../conn/conn.php';
if($_SERVER['REQUEST_METHOD']!=='POST'){http_response_code(405);exit('Method not allowed.');}verify_csrf();$id=filter_input(INPUT_POST,'question',FILTER_VALIDATE_INT,['options'=>['min_range'=>1]]);if(!$id){http_response_code(422);exit('Invalid question ID.');}$stmt=$conn->prepare('DELETE FROM tbl_quiz WHERE tbl_quiz_id=:id');$stmt->execute(['id'=>$id]);redirect_to('teacher.php');
