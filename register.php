<?php
require_once __DIR__.'/config/database.php';require_once __DIR__.'/config/helpers.php';
if(logged_in()){header('Location: dashboard.php');exit;}$error='';
if($_SERVER['REQUEST_METHOD']==='POST'){verify_csrf();$name=trim($_POST['name']??'');$email=filter_var(trim($_POST['email']??''),FILTER_VALIDATE_EMAIL);$pass=$_POST['password']??'';
if($name===''||!$email||strlen($pass)<8)$error='Nama dan email wajib valid. Password minimal 8 karakter.';
else{try{$stmt=$pdo->prepare("INSERT INTO users(name,email,password,role) VALUES(:name,:email,:password,'masyarakat')");$stmt->execute(['name'=>$name,'email'=>$email,'password'=>password_hash($pass,PASSWORD_DEFAULT)]);header('Location: login.php?registered=1');exit;}catch(PDOException $e){$error='Email sudah terdaftar atau data tidak dapat disimpan.';}}}
$pageTitle='Daftar Akun';$basePath='';require __DIR__.'/includes/header.php';?>
<section class="login-wrap"><div class="login-card"><span class="logo large">B</span><span class="eyebrow">GABUNG DALAM GERAKAN</span><h1>Buat akun masyarakat.</h1><p>Daftar untuk menyampaikan laporan lingkungan.</p><?php if($error):?><div class="error-box"><?=e($error)?></div><?php endif;?><form method="post" class="form-stack"><input type="hidden" name="csrf_token" value="<?=e(csrf_token())?>"><label>Nama lengkap<input name="name" required maxlength="120"></label><label>Email<input type="email" name="email" required></label><label>Password (minimal 8 karakter)<input type="password" name="password" minlength="8" required></label><button class="btn btn-primary">Buat Akun →</button></form><p class="small-center">Sudah memiliki akun? <a href="login.php">Masuk</a></p></div></section>
<?php require __DIR__.'/includes/footer.php';?>
