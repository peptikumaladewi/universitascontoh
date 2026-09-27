<?php
session_start();

// === SALIN FILE INI JADI config.php, LALU ISI SESUAI DATA MYSQL ANDA ===
$DB_HOST = 'isi-host-anda';        // contoh: sql210.infinityfree.com
$DB_NAME = 'isi-nama-database';    // contoh: if0_42986321_universitasmb
$DB_USER = 'isi-username-db';      // contoh: if0_42986321
$DB_PASS = 'isi-password-db';
// =========================================================================

try {
  $db = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4", $DB_USER, $DB_PASS);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
  die('Koneksi database gagal. Periksa DB_HOST/DB_NAME/DB_USER/DB_PASS di config.php. Detail: ' . $ex->getMessage());
}

$db->exec("CREATE TABLE IF NOT EXISTS prodi(
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100), jumlah INT, ikon VARCHAR(10), warna VARCHAR(10)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

$db->exec("CREATE TABLE IF NOT EXISTS users(
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) UNIQUE, password VARCHAR(255), nama VARCHAR(100),
  role VARCHAR(20), prodi_id INT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

if (!$db->query("SELECT COUNT(*) FROM prodi")->fetchColumn()) {
  $p = [['Manajemen',325,'📊','#14a37f'],['Teknik Informatika',412,'💻','#1d6fe8'],['Ekonomi Syariah',286,'📖','#8e5fd0'],
        ['Keperawatan',198,'🩺','#e8506a'],['Pendidikan',276,'👥','#f07a1a'],['Agronomi',154,'🌿','#3aa843'],['Teknik Mesin',231,'⚙️','#4b4fc0']];
  $s = $db->prepare("INSERT INTO prodi(nama,jumlah,ikon,warna) VALUES(?,?,?,?)");
  foreach ($p as $r) $s->execute($r);
  $u = $db->prepare("INSERT INTO users(username,password,nama,role,prodi_id) VALUES(?,?,?,?,?)");
  $u->execute(['admin', password_hash('admin123', PASSWORD_DEFAULT), 'Administrator', 'admin', null]);
  $u->execute(['2101001', password_hash('mhs123', PASSWORD_DEFAULT), 'Budi Santoso', 'mahasiswa', 2]);
}

function e($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }
function guard($role) {
  if (empty($_SESSION['user']) || $_SESSION['user']['role'] !== $role) { header('Location: login.php'); exit; }
}
