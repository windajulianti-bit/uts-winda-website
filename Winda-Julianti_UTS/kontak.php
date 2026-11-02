<?php
// kontak.php - memproses metode POST
require 'data.php';
$judul = 'Hasil Kirim Pesan';
include 'header.php';

// Tolak akses langsung lewat URL (GET)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo '<div class="alert alert-error">Halaman ini hanya menerima data dari formulir kontak.</div>';
    echo '<a class="button button-dark" href="index.html#kontak">Ke formulir kontak</a>';
    include 'footer.php';
    exit;
}

// Ambil & bersihkan data
$nama = trim($_POST['nama'] ?? '');
$email = trim($_POST['email'] ?? '');
$telepon = trim($_POST['telepon'] ?? '');
$subjek = trim($_POST['subjek'] ?? '');
$pesan = trim($_POST['pesan'] ?? '');

// Validasi
$errors = [];
if (empty($nama)) {
    $errors[] = 'Nama wajib diisi.';
}
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Format email tidak valid.';
}
if (empty($telepon) || !preg_match('/^[0-9]{10,13}$/', $telepon)) {
    $errors[] = 'Nomor telepon harus berupa angka 10 sampai 13 digit.';
}
if (!in_array($subjek, ['Pertanyaan', 'Peluang kerja', 'Saran'], true)) {
    $errors[] = 'Subjek tidak valid.';
}
if (empty($pesan) || strlen($pesan) < 10) {
    $errors[] = 'Pesan minimal 10 karakter.';
}

// Nilai tambah: simpan pesan valid ke pesan.json
$tersimpan = false;
if (empty($errors)) {
    $berkas = __DIR__ . '/pesan.json';
    $semua = file_exists($berkas) ? (json_decode(file_get_contents($berkas), true) ?: []) : [];
    $semua[] = ['waktu' => date('Y-m-d H:i:s'), 'nama' => $nama, 'email' => $email, 'telepon' => $telepon, 'subjek' => $subjek, 'pesan' => $pesan];
    $tersimpan = @file_put_contents($berkas, json_encode($semua, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX) !== false;
}
?>
<h1>Hasil kirim pesan</h1>
<?php if (!empty($errors)): ?>
  <div class="alert alert-error">
    <strong>Pesan gagal dikirim:</strong>
    <ul>
      <?php foreach ($errors as $err): ?>
        <li><?= e($err) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php else: ?>
  <div class="alert alert-ok">Terima kasih, <?= e($nama) ?>. Pesan Anda sudah diterima<?= $tersimpan ? ' dan disimpan.' : '.' ?></div>
  <table class="summary">
    <tr><th>Nama</th><td><?= e($nama) ?></td></tr>
    <tr><th>Email</th><td><?= e($email) ?></td></tr>
    <tr><th>Nomor telepon</th><td><?= e($telepon) ?></td></tr>
    <tr><th>Subjek</th><td><?= e($subjek) ?></td></tr>
    <tr><th>Pesan</th><td><?= nl2br(e($pesan)) ?></td></tr>
  </table>
<?php endif; ?>
<a class="button button-dark" href="index.html#kontak">Kembali ke beranda</a>
<?php include 'footer.php'; ?>
