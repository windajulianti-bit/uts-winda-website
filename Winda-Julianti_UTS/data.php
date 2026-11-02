<?php

$daftarData = [
    ['judul' => 'SMK Rosma Karawang - Teknik Komputer', 'kategori' => 'pendidikan', 'deskripsi' => 'Lulus tahun 2025 dari jurusan Teknik Komputer di SMK Rosma Karawang.', 'info' => '2022 - 2025'],
    ['judul' => 'Praktik Kerja Lapangan', 'kategori' => 'pengalaman', 'deskripsi' => 'Pengalaman di lingkungan kerja dengan mengutamakan konsentrasi, ketelitian, kerapian, dan penyelesaian tugas secara optimal.', 'info' => '22 Agustus - 21 November 2023'],
    ['judul' => 'Admin MBG', 'kategori' => 'pengalaman', 'deskripsi' => 'Mendukung administrasi dan operasional harian: pencatatan, input data keuangan, mengecek dan mengontrol gudang, serta berkoordinasi dengan tim.', 'info' => 'Administrasi dan operasional'],
    ['judul' => 'Pencatatan dan Pengelolaan Data Keuangan', 'kategori' => 'keahlian', 'deskripsi' => 'Mencatat dan menginput data keuangan dengan rapi dan akurat.', 'info' => 'Keahlian utama'],
    ['judul' => 'Microsoft Word dan Microsoft Excel', 'kategori' => 'keahlian', 'deskripsi' => 'Mengolah dokumen dan data menggunakan Word dan Excel.', 'info' => 'Keahlian utama'],
    ['judul' => 'Konfigurasi Dasar MikroTik', 'kategori' => 'keahlian', 'deskripsi' => 'Memahami konfigurasi dasar router MikroTik untuk jaringan komputer.', 'info' => 'Keahlian utama'],
    ['judul' => 'Ketelitian, Kerapian, dan Akurasi Kerja', 'kategori' => 'keahlian', 'deskripsi' => 'Bekerja dengan rapi, memperhatikan detail, dan menjaga akurasi hasil kerja.', 'info' => 'Keahlian utama'],
    ['judul' => 'Sertifikat PKL', 'kategori' => 'sertifikat', 'deskripsi' => 'Sertifikat Praktik Kerja Lapangan.', 'info' => 'Sertifikat'],
    ['judul' => 'Sertifikat MikroTik Dasar', 'kategori' => 'sertifikat', 'deskripsi' => 'Pelatihan dasar jaringan komputer dengan MikroTik.', 'info' => 'Sertifikat'],
    ['judul' => 'Sertifikat Jaringan Dasar', 'kategori' => 'sertifikat', 'deskripsi' => 'Pelatihan konsep dasar jaringan.', 'info' => 'Sertifikat'],
];

/** Mengamankan teks sebelum ditampilkan (cegah XSS). */
function e(string $teks): string
{
    return htmlspecialchars($teks, ENT_QUOTES, 'UTF-8');
}

/** Memfilter data berdasarkan kata kunci dan kategori. */
function cariData(array $data, string $q, string $kategori): array
{
    $hasil = [];
    foreach ($data as $item) {
        $cocokKategori = ($kategori === 'semua') || ($item['kategori'] === $kategori);
        $cocokKata = ($q === '') || (stripos($item['judul'] . ' ' . $item['deskripsi'], $q) !== false);
        if ($cocokKategori && $cocokKata) {
            $hasil[] = $item;
        }
    }
    return $hasil;
}
