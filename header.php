<?php $u = $_SESSION['user'] ?? null; $cur = basename($_SERVER['PHP_SELF']); ?>
<!DOCTYPE html><html lang="id"><head><meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Universitas Muhammadiyah Bengkulu – Data Mahasiswa</title>
<link rel="stylesheet" href="assets/style.css"></head><body>
<header class="nav"><div class="wrap nav-in">
  <a class="brand" href="index.php"><img class="logo" src="assets/logo.png" alt="Logo"><span><b>Universitas Muhammadiyah Bengkulu</b><small>Unggul · Islam · Berkemajuan</small></span></a>
  <nav>
    <a href="index.php" class="<?= $cur=='index.php'?'on':'' ?>">Beranda</a>
    <a href="index.php#prodi">Program Studi</a>
    <a href="index.php#tentang">Web Semantik</a>
    <a href="index.php#kontak">Kontak</a>
  </nav>
  <?php if ($u): ?>
    <div class="who"><a class="btn sm" href="<?= $u['role']=='admin'?'admin.php':'mahasiswa.php' ?>">👤 <?= e($u['nama']) ?></a>
    <a class="btn sm ghost" href="logout.php">Keluar</a></div>
  <?php else: ?><a class="btn" href="login.php">👤 Login</a><?php endif; ?>
</div></header>
