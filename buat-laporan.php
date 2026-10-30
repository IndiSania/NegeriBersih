<?php
require_once __DIR__.'/config/database.php';require_once __DIR__.'/config/helpers.php';
if(!logged_in()){$_SESSION['after_login']='buat-laporan.php';header('Location: login.php');exit;}
$error='';$success=false;
if($_SERVER['REQUEST_METHOD']==='POST'){verify_csrf();
$title=trim($_POST['title']??'');$desc=trim($_POST['description']??'');$area=trim($_POST['area']??'');$type=$_POST['waste_type']??'Campuran';$photo=trim($_POST['photo_url']??'');$lat=trim($_POST['latitude']??'');$lng=trim($_POST['longitude']??'');
$types=['Organik','Anorganik','B3 Rumah Tangga','Campuran'];
if($title===''||$desc===''||$area===''||!in_array($type,$types,true))$error='Lengkapi judul, deskripsi, lokasi, dan jenis sampah.';
elseif($photo!==''&&!filter_var($photo,FILTER_VALIDATE_URL))$error='URL foto tidak valid.';
elseif(($lat!==''&&!is_numeric($lat))||($lng!==''&&!is_numeric($lng)))$error='Koordinat harus berupa angka.';
else{$stmt=$pdo->prepare("INSERT INTO reports(user_id,title,description,area,waste_type,photo_url,latitude,longitude,status) VALUES(:uid,:title,:description,:area,:type,:photo,:lat,:lng,'Menunggu')");
$stmt->execute(['uid'=>$_SESSION['user_id'],'title'=>$title,'description'=>$desc,'area'=>$area,'type'=>$type,'photo'=>$photo?:null,'lat'=>$lat!==''?$lat:null,'lng'=>$lng!==''?$lng:null]);$success=true;}
}
$pageTitle='Buat Laporan';$basePath='';require __DIR__.'/includes/header.php';
?>
<section class="page-banner"><div class="container"><span class="eyebrow">LAPORKAN KONDISI LINGKUNGAN</span><h1>Sampaikan laporanmu.</h1><p>Berikan informasi lokasi dan kondisi sampah agar dapat diperiksa petugas.</p></div></section>
<section class="section"><div class="container narrow"><a class="back" href="laporan.php">← Kembali ke laporan</a><?php if($success):?><div class="success-box"><h2>Laporan berhasil dikirim!</h2><p>Terima kasih sudah berkontribusi. Laporanmu tersimpan dengan status Menunggu verifikasi.</p><a class="btn btn-primary" href="laporan.php">Lihat laporan publik</a></div><?php else:?>
<?php if($error):?><div class="error-box"><?=e($error)?></div><?php endif;?>
<form method="post" class="form-card"><input type="hidden" name="csrf_token" value="<?=e(csrf_token())?>"><label>Judul laporan *<input name="title" maxlength="160" required placeholder="Contoh: Tumpukan sampah di tepi jalan"></label><label>Jenis sampah *<select name="waste_type"><?php foreach(['Campuran','Organik','Anorganik','B3 Rumah Tangga'] as $t):?><option><?=e($t)?></option><?php endforeach;?></select></label><label>Alamat / area kejadian *<input name="area" required placeholder="Nama jalan, desa/kelurahan, kecamatan, kabupaten"></label><div class="two"><label>Latitude (opsional)<input name="latitude" placeholder="-6.5"></label><label>Longitude (opsional)<input name="longitude" placeholder="110.7"></label></div><label>Deskripsi kondisi *<textarea name="description" rows="5" required placeholder="Jelaskan kondisi, perkiraan jumlah, dan informasi penting lainnya..."></textarea></label><label>URL foto (opsional)<input type="url" name="photo_url" placeholder="https://..."></label><div class="hint">Jangan memasukkan data pribadi orang lain. Pastikan laporan sesuai kondisi sebenarnya.</div><button class="btn btn-primary" type="submit">Kirim Laporan →</button></form><?php endif;?></div></section>
<?php require __DIR__.'/includes/footer.php';?>
