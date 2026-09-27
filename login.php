<?php require 'config.php';
$err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $s = $db->prepare("SELECT * FROM users WHERE username=? AND role=?");
  $s->execute([trim($_POST['username']), $_POST['role']]);
  $r = $s->fetch(PDO::FETCH_ASSOC);
  if ($r && password_verify($_POST['password'], $r['password'])) {
    session_regenerate_id(true); $_SESSION['user'] = $r;
    header('Location: ' . ($r['role']=='admin' ? 'admin.php' : 'mahasiswa.php')); exit;
  }
  $err = 'Username, password, atau peran salah.';
}
include 'header.php'; $role = $_POST['role'] ?? 'mahasiswa'; ?>
<section class="loginbox"><form method="post" class="lcard">
  <h2>Masuk</h2><p class="sub">Pilih peran lalu masukkan akun Anda</p>
  <div class="roles">
    <label><input type="radio" name="role" value="mahasiswa" <?= $role=='mahasiswa'?'checked':'' ?>><span>🧑‍🎓 Mahasiswa</span></label>
    <label><input type="radio" name="role" value="admin" <?= $role=='admin'?'checked':'' ?>><span>🛠️ Admin</span></label>
  </div>
  <?php if ($err): ?><div class="err"><?= e($err) ?></div><?php endif; ?>
  <label>Username / NIM<input name="username" required autofocus></label>
  <label>Password<input type="password" name="password" required></label>
  <button class="btn lg full">Login</button>
  <small class="hint">Demo — Admin: admin / admin123 · Mahasiswa: 2101001 / mhs123</small>
</form></section>
<?php include 'footer.php'; ?>
