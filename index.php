<?php require 'config.php';
$prodi = $db->query("SELECT * FROM prodi ORDER BY id")->fetchAll(PDO::FETCH_ASSOC);
$total = array_sum(array_column($prodi, 'jumlah')); include 'header.php'; ?>
<section class="hero"><div class="wrap hero-in">
  <div>
    <h1>Data Mahasiswa<br><span>Per Program Studi</span></h1>
    <p>Akses, eksplorasi, dan manfaatkan data mahasiswa secara terbuka, terstruktur, dan terhubung untuk mendukung tata kelola universitas yang lebih baik.</p>
    <a class="btn lg" href="#prodi">🔍 Lihat Data Mahasiswa</a>
    <a class="btn lg ghost" href="#tentang">📖 Pelajari Web Semantik</a>
    <p class="quote">"Data yang terhubung, pengetahuan yang lebih luas"</p>
  </div>
  <div class="graph">
    <div class="node n1">🧑‍🎓<i>Mahasiswa</i></div><div class="node n2">🎓<i>Program Studi</i></div>
    <div class="node n3">📖<i>Mata Kuliah</i></div><div class="node n4">🏛️<i>Universitas</i></div>
    <div class="rdf">RDF</div><h3>Semantic Web<br>for a Smarter University</h3>
  </div>
</div></section>

<section class="wrap feats">
  <div><span>🗄️</span><b>Data Terintegrasi</b><p>Data mahasiswa terhubung dengan program studi, fakultas, dan informasi akademik lainnya.</p></div>
  <div><span>🔗</span><b>Standar Terbuka</b><p>Menggunakan teknologi Web Semantik (RDF, OWL, SPARQL) untuk interoperabilitas data.</p></div>
  <div><span>📈</span><b>Mudah Diakses</b><p>Pencarian dan visualisasi data yang cepat dan interaktif.</p></div>
  <div><span>🛡️</span><b>Mendukung Transparansi</b><p>Data yang terbuka untuk mendukung akreditasi, riset, dan pengambilan keputusan.</p></div>
</section>

<section id="prodi" class="alt"><div class="wrap">
  <h2>Daftar Program Studi</h2><p class="sub">Pilih program studi untuk melihat data mahasiswa secara detail</p>
  <div class="grid">
  <?php foreach ($prodi as $p): ?>
    <a class="card" href="<?= isset($_SESSION['user'])?'#':'login.php' ?>">
      <span class="ic" style="background:<?= e($p['warna']) ?>"><?= $p['ikon'] ?></span>
      <div><b><?= e($p['nama']) ?></b><small><?= number_format($p['jumlah'],0,',','.') ?> Mahasiswa</small></div><em>→</em></a>
  <?php endforeach; ?>
  </div>
</div></section>

<section class="stats"><div class="wrap">
  <div><span>🎓</span><b><?= number_format($total,0,',','.') ?></b>Total Mahasiswa</div>
  <div><span>👥</span><b><?= count($prodi) ?></b>Program Studi</div>
  <div><span>🏛️</span><b>8</b>Fakultas</div>
  <div><span>🌐</span><b>Web Semantik</b>Data Terhubung</div>
</div></section>

<section id="tentang" class="wrap about">
  <div><h2>Membangun Ekosistem Data Terbuka</h2>
  <p>Dengan pendekatan <b>Web Semantik</b>, data mahasiswa tidak hanya disimpan, tetapi juga dapat dipahami, dihubungkan, dan dimanfaatkan oleh berbagai aplikasi untuk mendukung pendidikan, penelitian, dan inovasi.</p>
  <a class="btn" href="#tentang">📖 Tentang Web Semantik</a></div>
  <blockquote>"Web Semantik memungkinkan data di universitas tidak hanya dilihat oleh manusia, tetapi juga dipahami oleh mesin."<cite>– Menuju Universitas yang Lebih Cerdas</cite></blockquote>
</section>
<?php include 'footer.php'; ?>
