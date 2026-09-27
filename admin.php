<?php require 'config.php'; guard('admin');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $a = $_POST['aksi'] ?? '';
  if ($a=='tambah_prodi') $db->prepare("INSERT INTO prodi(nama,jumlah,ikon,warna) VALUES(?,?,?,?)")->execute([$_POST['nama'],(int)$_POST['jumlah'],'🎓',$_POST['warna']]);
  if ($a=='ubah_prodi')   $db->prepare("UPDATE prodi SET jumlah=? WHERE id=?")->execute([(int)$_POST['jumlah'],(int)$_POST['id']]);
  if ($a=='hapus_prodi')  $db->prepare("DELETE FROM prodi WHERE id=?")->execute([(int)$_POST['id']]);
  if ($a=='tambah_mhs') { try { $db->prepare("INSERT INTO users(username,password,nama,role,prodi_id) VALUES(?,?,?,'mahasiswa',?)")
      ->execute([$_POST['nim'], password_hash($_POST['pass'],PASSWORD_DEFAULT), $_POST['nama'], (int)$_POST['prodi_id']]); } catch (Exception $x) {} }
  if ($a=='hapus_mhs')    $db->prepare("DELETE FROM users WHERE id=? AND role='mahasiswa'")->execute([(int)$_POST['id']]);
  header('Location: admin.php'); exit;
}
$prodi = $db->query("SELECT * FROM prodi ORDER BY id")->fetchAll(PDO::FETCH_ASSOC);
$mhs = $db->query("SELECT u.*, p.nama AS pn FROM users u LEFT JOIN prodi p ON p.id=u.prodi_id WHERE role='mahasiswa'")->fetchAll(PDO::FETCH_ASSOC);
include 'header.php'; ?>
<div class="wrap dash">
  <h2>Dashboard Admin</h2>
  <div class="kpi"><div><b><?= array_sum(array_column($prodi,'jumlah')) ?></b>Total Mahasiswa</div><div><b><?= count($prodi) ?></b>Program Studi</div><div><b><?= count($mhs) ?></b>Akun Mahasiswa</div></div>

  <h3>Kelola Program Studi</h3>
  <table><tr><th>Program Studi</th><th>Jumlah Mahasiswa</th><th></th></tr>
  <?php foreach ($prodi as $p): ?><tr><td><?= $p['ikon'].' '.e($p['nama']) ?></td>
    <td><form method="post" class="inl"><input type="hidden" name="aksi" value="ubah_prodi"><input type="hidden" name="id" value="<?= $p['id'] ?>">
      <input type="number" name="jumlah" value="<?= $p['jumlah'] ?>"><button class="btn sm">Simpan</button></form></td>
    <td><form method="post" onsubmit="return confirm('Hapus?')"><input type="hidden" name="aksi" value="hapus_prodi"><input type="hidden" name="id" value="<?= $p['id'] ?>"><button class="btn sm danger">Hapus</button></form></td></tr>
  <?php endforeach; ?></table>
  <form method="post" class="inl add"><input type="hidden" name="aksi" value="tambah_prodi">
    <input name="nama" placeholder="Nama program studi" required><input type="number" name="jumlah" placeholder="Jumlah" required>
    <input type="color" name="warna" value="#1d6fe8"><button class="btn sm">+ Tambah</button></form>

  <h3>Akun Mahasiswa</h3>
  <table><tr><th>NIM</th><th>Nama</th><th>Program Studi</th><th></th></tr>
  <?php foreach ($mhs as $m): ?><tr><td><?= e($m['username']) ?></td><td><?= e($m['nama']) ?></td><td><?= e($m['pn']) ?></td>
    <td><form method="post" onsubmit="return confirm('Hapus?')"><input type="hidden" name="aksi" value="hapus_mhs"><input type="hidden" name="id" value="<?= $m['id'] ?>"><button class="btn sm danger">Hapus</button></form></td></tr>
  <?php endforeach; ?></table>
  <form method="post" class="inl add"><input type="hidden" name="aksi" value="tambah_mhs">
    <input name="nim" placeholder="NIM" required><input name="nama" placeholder="Nama" required><input name="pass" placeholder="Password" required>
    <select name="prodi_id"><?php foreach ($prodi as $p): ?><option value="<?= $p['id'] ?>"><?= e($p['nama']) ?></option><?php endforeach; ?></select>
    <button class="btn sm">+ Tambah</button></form>
</div>
<?php include 'footer.php'; ?>
