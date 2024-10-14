<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $merek = htmlspecialchars($_POST['merek_kendaraan']);
    $jenis = htmlspecialchars($_POST['jenis_kendaraan']);
    $harga = filter_var($_POST['harga_sewa'], FILTER_VALIDATE_FLOAT);

    if ($harga === false) {
        $error = "Harga sewa harus berupa angka.";
    } else {
        addKendaraan($merek, $jenis, $harga);
        header('Location: index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Tambah Kendaraan</title>
</head>
<body>
    <div class="container">
        <h1>Tambah Kendaraan</h1>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST">
            <label for="merek_kendaraan">Merek Kendaraan:</label>
            <input type="text" id="merek_kendaraan" name="merek_kendaraan" required>
            <label for="jenis_kendaraan">Jenis Kendaraan:</label>
            <input type="text" id="jenis_kendaraan" name="jenis_kendaraan" required>
            <label for="harga_sewa">Harga Sewa (per hari):</label>
            <input type="number" id="harga_sewa" name="harga_sewa" step="0.01" required>
            <button type="submit" class="btn-add">Simpan</button>
        </form>
        <a href="index.php" class="btn-back">Kembali</a>
    </div>
</body>
</html>