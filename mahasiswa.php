<?php require 'config.php'; guard('mahasiswa');
$s = $db->prepare("SELECT u.*, p.nama AS pn, p.jumlah, p.ikon, p.warna FROM users u LEFT JOIN prodi p ON p.id=u.prodi_id WHERE u.id=?");
$s->execute([$_SESSION['user']['id']]); $m = $s->fetch(PDO::FETCH_ASSOC);
$prodi = $db->query("SELECT * FROM prodi ORDER BY jumlah DESC")->fetchAll(PDO::FETCH_ASSOC);
$max = max(array_column($prodi,'jumlah') ?: [1]); include 'header.php'; ?>
<div class="wrap dash">
  <h2>Halo, <?= e($m['nama']) ?> 👋</h2>
  <div class="profile"><span class="ic big" style="background:<?= e($m['warna']) ?>"><?= $m['ikon'] ?></span>
    <div><b><?= e($m['nama']) ?></b><small>NIM: <?= e($m['username']) ?></small><small>Program Studi: <?= e($m['pn']) ?> (<?= $m['jumlah'] ?> mahasiswa)</small></div></div>
  <h3>Sebaran Mahasiswa per Program Studi</h3>
  <?php foreach ($prodi as $p): ?>
    <div class="bar"><span><?= e($p['nama']) ?></span><div><i style="width:<?= round($p['jumlah']/$max*100) ?>%;background:<?= e($p['warna']) ?>"></i></div><b><?= $p['jumlah'] ?></b></div>
  <?php endforeach; ?>
</div>
<?php include 'footer.php'; ?>
