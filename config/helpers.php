<?php
declare(strict_types=1);
if(session_status()!==PHP_SESSION_ACTIVE) session_start();
function e(?string $v):string{return htmlspecialchars($v??'',ENT_QUOTES,'UTF-8');}
function csrf_token():string{if(empty($_SESSION['csrf_token']))$_SESSION['csrf_token']=bin2hex(random_bytes(32));return $_SESSION['csrf_token'];}
function verify_csrf():void{$t=$_POST['csrf_token']??'';if(!is_string($t)||!hash_equals($_SESSION['csrf_token']??'',$t)){http_response_code(419);exit('Permintaan tidak valid. Muat ulang halaman.');}}
function logged_in():bool{return isset($_SESSION['user_id']);}
function require_login():void{if(!logged_in()){header('Location: login.php');exit;}}
function require_staff():void{if(!logged_in()||!in_array($_SESSION['role']??'', ['admin','petugas'],true)){header('Location: login.php');exit;}}
function status_class(string $s):string{return match($s){'Selesai'=>'status-done','Ditangani'=>'status-work','Ditolak'=>'status-rejected','Diverifikasi'=>'status-verified',default=>'status-wait'};}
function excerpt(string $s,int $n=120):string{$s=trim(strip_tags($s));return mb_strlen($s)<=$n?$s:mb_substr($s,0,$n).'…';}
