<?php
$dsn = 'sqlite:kendaraan.db';
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, null, null, $options);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

// Fungsi untuk membuat tabel jika belum ada
function createTableIfNotExists() {
    global $pdo;
    $sql = "CREATE TABLE IF NOT EXISTS kendaraan (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        merek_kendaraan TEXT NOT NULL,
        jenis_kendaraan TEXT NOT NULL,
        harga_sewa REAL NOT NULL
    )";
    $pdo->exec($sql);
}

// Panggil fungsi untuk membuat tabel
createTableIfNotExists();

function getKendaraans() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM kendaraan ORDER BY id DESC");
    return $stmt->fetchAll();
}

function getKendaraanById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM kendaraan WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function addKendaraan($merek, $jenis, $harga) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO kendaraan (merek_kendaraan, jenis_kendaraan, harga_sewa) VALUES (?, ?, ?)");
    $stmt->execute([$merek, $jenis, $harga]);
}

function updateKendaraan($id, $merek, $jenis, $harga) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE kendaraan SET merek_kendaraan = ?, jenis_kendaraan = ?, harga_sewa = ? WHERE id = ?");
    $stmt->execute([$merek, $jenis, $harga, $id]);
}

function deleteKendaraan($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM kendaraan WHERE id = ?");
    $stmt->execute([$id]);
}
?>