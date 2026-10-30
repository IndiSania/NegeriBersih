<?php
require_once __DIR__.'/config/database.php';require_once __DIR__.'/config/helpers.php';require_staff();
if($_SERVER['REQUEST_METHOD']!=='POST'){header('Location: dashboard.php');exit;}verify_csrf();
$id=filter_input(INPUT_POST,'id',FILTER_VALIDATE_INT);$status=$_POST['status']??'';$note=trim($_POST['note']??'');
$allowed=['Menunggu','Diverifikasi','Ditangani','Selesai','Ditolak'];
if($id&&in_array($status,$allowed,true)){$stmt=$pdo->prepare('UPDATE reports SET status=:status,staff_note=:note,handled_by=:uid WHERE id=:id');$stmt->execute(['status'=>$status,'note'=>$note?:null,'uid'=>$_SESSION['user_id'],'id'=>$id]);}
header('Location: dashboard.php');exit;
