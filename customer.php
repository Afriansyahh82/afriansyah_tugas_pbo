<?php
require_once 'barang.php';
require_once 'barangManager.php';

$barangManager = new barangManager();
$barangs = $barangManager->getBarang();

// Proses pembelian
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['beli'])) {
    $barangId = $_POST['barang'];
    $jumlah = $_POST['jumlah'];
    $namaPelanggan = $_POST['nama_pelanggan'];
    
    $barang = $barangManager->getBarangById($barangId);
    
    if ($barang && $barang['stok'] >= $jumlah) {
        // Kurangi stok
        $barangManager->kurangiStok($barangId, $jumlah);
        
        // Hitung total harga
        $totalHarga = $barang['harga'] * $jumlah;
        
        // Simpan pesan sukses
        $pesanSukses = "Terima kasih, {$namaPelanggan}! Berhasil membeli {$jumlah} {$barang['nama']} dengan total harga Rp " . number_format($totalHarga, 0, ',', '.');
    } else {
        $pesanError = "Pembelian gagal. Stok tidak mencukupi atau barang tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Pembelian Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar">
        <div class="navbar-brand">Toko Barang</div>
        <ul class="navbar-menu">
            <li><a href="home.php">Beranda</a></li>
            <li><a href="index.php">Manajemen Barang</a></li>
            <li><a href="customer.php">Beli Barang</a></li>
        </ul>
    </nav>

    <div class="container">
        <h1>Pembelian Barang</h1>

        <?php if (isset($pesanSukses)): ?>
            <div class="alert alert-success"><?= $pesanSukses ?></div>
        <?php endif; ?>

        <?php if (isset($pesanError)): ?>
            <div class="alert alert-error"><?= $pesanError ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div>
                <label for="nama_pelanggan">Nama Pelanggan</label>
                <input type="text" name="nama_pelanggan" id="nama_pelanggan" required placeholder="Masukkan nama Anda">
            </div>
            <div>
                <label for="barang">Pilih Barang</label>
                <select name="barang" id="barang" required>
                    <option value="">Pilih Barang</option>
                    <?php foreach ($barangs as $barang): ?>
                        <?php if ($barang['stok'] > 0): ?>
                            <option value="<?= $barang['id'] ?>">
                                <?= $barang['nama'] ?> - Stok: <?= $barang['stok'] ?> - Harga: Rp <?= number_format($barang['harga'], 0, ',', '.') ?>
                            </option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label for="jumlah">Jumlah Barang</label>
                <input type="number" name="jumlah" id="jumlah" min="1" required>
            </div>
            <button type="submit" name="beli" class="btn btn-add">Beli Barang</button>
        </form>
    </div>
</body>
</html>