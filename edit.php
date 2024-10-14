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
    $merek = htmlspecialchars($_POST['merek_kendaraan']);
    $jenis = htmlspecialchars($_POST['jenis_kendaraan']);
    $harga = filter_var($_POST['harga_sewa'], FILTER_VALIDATE_FLOAT);

    if ($harga === false) {
        $error = "Harga sewa harus berupa angka.";
    } else {
        updateKendaraan($id, $merek, $jenis, $harga);
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
    <title>Edit Kendaraan</title>
</head>
<body>
    <div class="container">
        <h1>Edit Kendaraan</h1>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST">
            <label for="merek_kendaraan">Merek Kendaraan:</label>
            <input type="text" id="merek_kendaraan" name="merek_kendaraan" value="<?php echo htmlspecialchars($kendaraan['merek_kendaraan']); ?>" required>
            <label for="jenis_kendaraan">Jenis Kendaraan:</label>
            <input type="text" id="jenis_kendaraan" name="jenis_kendaraan" value="<?php echo htmlspecialchars($kendaraan['jenis_kendaraan']); ?>" required>
            <label for="harga_sewa">Harga Sewa (per hari):</label>
            <input type="number" id="harga_sewa" name="harga_sewa" step="0.01" value="<?php echo htmlspecialchars($kendaraan['harga_sewa']); ?>" required>
            <button type="submit" class="btn-add">Update</button>
        </form>
        <a href="index.php" class="btn-back">Kembali</a>
    </div>
</body>
</html>