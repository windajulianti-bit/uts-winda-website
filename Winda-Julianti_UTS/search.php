<?php
// search.php - memproses metode GET
require 'data.php';
$judul = 'Hasil Pencarian';

// Ambil & bersihkan parameter GET
$q = trim($_GET['q'] ?? '');
$kategori = trim($_GET['kategori'] ?? 'semua');
if (!in_array($kategori, ['semua', 'pendidikan', 'pengalaman', 'keahlian', 'sertifikat'], true)) {
    $kategori = 'semua';
}

// Saring data + pagination sederhana (3 data per halaman)
$hasil = cariData($daftarData, $q, $kategori);
$perHalaman = 3;
$totalHalaman = max(1, (int) ceil(count($hasil) / $perHalaman));
$halaman = min(max(1, (int) ($_GET['hal'] ?? 1)), $totalHalaman);
$tampil = array_slice($hasil, ($halaman - 1) * $perHalaman, $perHalaman);

include 'header.php';
?>
<h1>Hasil pencarian</h1>
<p class="meta">
  Kata kunci: <strong><?= e($q === '' ? '(kosong)' : $q) ?></strong> ·
  Kategori: <strong><?= e($kategori) ?></strong> ·
  Ditemukan: <strong><?= count($hasil) ?></strong> hasil
</p>

<?php if (empty($hasil)): ?>
  <div class="alert alert-warn">Tidak ada hasil untuk “<?= e($q) ?>”. Coba kata kunci lain atau pilih kategori Semua.</div>
<?php else: ?>
  <div class="result-list">
    <?php foreach ($tampil as $item): ?>
      <article class="result">
        <span class="pill"><?= e(strtoupper($item['kategori'])) ?> · <?= e($item['info']) ?></span>
        <h2><?= e($item['judul']) ?></h2>
        <p><?= e($item['deskripsi']) ?></p>
      </article>
    <?php endforeach; ?>
  </div>
  <?php if ($totalHalaman > 1): ?>
    <nav class="pagination" aria-label="Halaman hasil">
      <?php for ($i = 1; $i <= $totalHalaman; $i++): ?>
        <?php if ($i === $halaman): ?>
          <strong><?= $i ?></strong>
        <?php else: ?>
          <a href="?<?= e(http_build_query(['q' => $q, 'kategori' => $kategori, 'hal' => $i])) ?>"><?= $i ?></a>
        <?php endif; ?>
      <?php endfor; ?>
    </nav>
  <?php endif; ?>
<?php endif; ?>

<a class="button button-dark" href="index.html#kontak">Kembali ke beranda</a>
<?php include 'footer.php'; ?>
