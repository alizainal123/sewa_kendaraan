<?php
require 'db.php';
$kendaraans = getKendaraans();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Daftar Kendaraan</title>
</head>
<body>
    <div class="container">
        <h1>Daftar Kendaraan</h1>
        <a href="add.php" class="btn-add">Tambah Kendaraan</a>
        <?php if (empty($kendaraans)): ?>
            <p>Tidak ada kendaraan yang tersedia.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Merek Kendaraan</th>
                        <th>Jenis Kendaraan</th>
                        <th>Harga Sewa (per hari)</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($kendaraans as $kendaraan): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($kendaraan['merek_kendaraan']); ?></td>
                            <td><?php echo htmlspecialchars($kendaraan['jenis_kendaraan']); ?></td>
                            <td><?php echo number_format($kendaraan['harga_sewa'], 2, ',', '.'); ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $kendaraan['id']; ?>" class="btn-edit">Edit</a>
                                <a href="delete.php?id=<?php echo $kendaraan['id']; ?>" class="btn-delete">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>