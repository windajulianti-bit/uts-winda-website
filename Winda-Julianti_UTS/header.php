<?php $judul = $judul ?? 'Portofolio Winda Julianti'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($judul) ?> | Winda Julianti</title>
  <link rel="stylesheet" href="styles/style.css">
</head>
<body>
  <header class="hero page-header">
    <?php include 'nav.php'; ?>
  </header>
  <main class="container page">
