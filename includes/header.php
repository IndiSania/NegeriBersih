<?php $pageTitle=$pageTitle??'BersihNegeri'; $basePath=$basePath??''; ?>
<!doctype html><html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="description" content="BersihNegeri - platform pelaporan sampah dan pengelolaan lingkungan."><title><?=e($pageTitle)?> | BersihNegeri</title>
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?=$basePath?>assets/css/style.css"></head><body>
<header class="header"><div class="container nav"><a class="brand" href="<?=$basePath?>index.php"><span class="logo">B</span><span>Bersih<span class="green">Negeri</span><small>GERAKAN LINGKUNGAN BERSIH</small></span></a>
<button class="menu-toggle" aria-label="Buka navigasi">☰</button><nav class="main-nav"><a href="<?=$basePath?>index.php">Beranda</a><a href="<?=$basePath?>laporan.php">Laporan Publik</a><a href="<?=$basePath?>lokasi.php">Bank Sampah</a><a href="<?=$basePath?>edukasi.php">Edukasi</a><?php if(logged_in()):?><a class="nav-cta" href="<?=$basePath?>dashboard.php">Dashboard</a><?php else:?><a class="nav-cta" href="<?=$basePath?>login.php">Masuk</a><?php endif;?></nav></div></header><main>
