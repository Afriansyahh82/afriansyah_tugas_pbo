<?php
require_once 'barang.php';
require_once 'barangManager.php';

$barangManager = new barangManager();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama - Grosir Entong</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar">
        <div class="navbar-brand">Toko Entong</div>
        <ul class="navbar-menu">
            <li><a href="home.php">Beranda</a></li>
            <li><a href="index.php">Manajemen Barang</a></li>
            <li><a href="customer.php">Beli Barang</a></li>
        </ul>
    </nav>

    <div class="container">
        <h1 class="welcome">Selamat Datang di Toko Entong</h1>
        
        <div class="content">
            <h2>Grosir Termurah Se - Indonesia</h2>
            <p>Toko Entong berdiri sejak tahun 1945</p>
            <ul>
                <li>Grosir terlengkap, Murah, dan stok selalu baru✔</li>
            </ul>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Tentang Kami</h3>
                <p>Toko Entong adalah grosir terpercaya sejak 1945, menyediakan berbagai kebutuhan dengan harga termurah.</p>
            </div>
            <div class="footer-section">
                <h3>Kontak</h3>
                <p>📞 Telepon: 0821-1234-5678</p>
                <p>📍 Alamat: Jl. Cimareme No. 45, Bandung</p>
                <p>✉️ Email: customer@tokoentong.com</p>
            </div>
            <div class="footer-section">
                <h3>Jam Operasional</h3>
                <p>Senin - Jumat: 08:00 - 17:00</p>
                <p>Sabtu: 08:00 - 14:00</p>
                <p>Minggu: Tutup</p>
            </div>
        </div>
        
        <div class="social-links">
            <!-- <a href="#" target="_blank"><i class="fab fa-facebook"></i></a> -->
            <a href="https://www.instagram.com/drizz82_/" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="https://github.com/afriansyahh82/" target="_blank"><i class="fab fa-github"></i></a>
            <a href="https://wa.me/62895365232815/" target="_blank"><i class="fab fa-whatsapp"></i></a>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2024 Afriansyah idris. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>