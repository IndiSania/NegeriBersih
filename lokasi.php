<?php
require_once __DIR__.'/config/database.php';require_once __DIR__.'/config/helpers.php';
$pageTitle='Bank Sampah & Daur Ulang';$basePath='';$q=trim($_GET['q']??'');
$stmt=$pdo->prepare("SELECT * FROM recycling_points WHERE is_active=1 AND (name LIKE :q OR address LIKE :q OR type LIKE :q) ORDER BY name");$stmt->execute(['q'=>'%'.$q.'%']);$points=$stmt->fetchAll();require __DIR__.'/includes/header.php';
?>
<section class="page-banner"><div class="container"><span class="eyebrow">EKONOMI SIRKULAR</span><h1>Temukan titik daur ulang.</h1><p>Kenali lokasi bank sampah dan fasilitas daur ulang untuk menyalurkan sampah terpilah.</p></div></section>
<section class="section"><div class="container"><form class="filter"><input name="q" value="<?=e($q)?>" placeholder="Cari nama, wilayah, atau jenis fasilitas..."><button class="btn btn-primary">Cari</button></form>
<div class="location-grid"><?php foreach($points as $p):?><article class="location-card"><div class="location-icon">♻</div><span class="tag"><?=e($p['type'])?></span><h3><?=e($p['name'])?></h3><p><?=e($p['address'])?></p><div class="location-meta"><span>Jam: <?=e($p['hours']?:'Hubungi pengelola')?></span><?php if($p['latitude']&&$p['longitude']):?><a target="_blank" rel="noopener" href="https://www.openstreetmap.org/?mlat=<?=e((string)$p['latitude'])?>&mlon=<?=e((string)$p['longitude'])?>#map=17/<?=e((string)$p['latitude'])?>/<?=e((string)$p['longitude'])?>">Lihat peta ↗</a><?php endif;?></div></article><?php endforeach;?><?php if(!$points):?><div class="empty">Lokasi tidak ditemukan.</div><?php endif;?></div>
<div class="map-note">Lokasi pada halaman ini merupakan data demonstrasi. Konfirmasikan alamat dan jam operasional kepada pengelola sebelum berkunjung.</div></div></section>
<?php require __DIR__.'/includes/footer.php';?>
