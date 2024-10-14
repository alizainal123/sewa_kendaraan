<?php
require 'db.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
if ($id === false) {
    header('Location: index.php');
    exit;
}

$kendaraan = getKendaraanById($id);
if (!$kendaraan) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    deleteKendaraan($id);
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Hapus Kendaraan</title>
</head>
<body>
    <div class="container">
        <h1>Hapus Kendaraan</h1>
        <p>Apakah Anda yakin ingin menghapus kendaraan ini?</p>
        <p>Merek: <?php echo htmlspecialchars($kendaraan['merek_kendaraan']); ?></p>
        <p>Jenis: <?php echo htmlspecialchars($kendaraan['jenis_kendaraan']); ?></p>
        <p>Harga Sewa: <?php echo htmlspecialchars($kendaraan['harga_sewa']); ?></p>
        <form method="POST">
            <button type="submit" class="btn-delete">Hapus</button>
        </form>
        <a href="index.php" class="btn-back">Batal</a>
    </div>
</body>
</html>