<?php
require_once 'barang.php';
require_once 'barangManager.php';

$barangManager = new barangManager();
$editMode = false; // Flag untuk mode edit
$editBarang = null; // Data barang yang sedang diedit

// Menangani form tambah/edit barang
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    if (isset($_POST['edit'])) {
        // Mode Edit
        $id = $_POST['id'];
        $barangManager->editBarang($id, $nama, $harga, $stok);
    } else {
        // Mode Tambah
        $barangManager->tambahBarang($nama, $harga, $stok);
    }

    header('Location: index.php');
}

// Menangani penghapusan barang
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $barangManager->hapusBarang($id);
    header('Location: index.php'); // Redirect setelah menghapus
}

// Menangani permintaan edit barang
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $editBarang = $barangManager->getBarangById($id);
    if ($editBarang) {
        $editMode = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencatatan Barang</title>
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
        <h1>Pencatatan Barang</h1>
        <form method="POST" action="">
            <?php if ($editMode): ?>
                <input type="hidden" name="id" value="<?= $editBarang['id'] ?>">
            <?php endif; ?>
            <div>
                <label for="nama">Nama Barang</label><br>
                <input type="text" id="nama" name="nama" value="<?= $editMode ? $editBarang['nama'] : '' ?>" required>
            </div>
            <div>
                <label for="harga">Harga Barang</label><br>
                <input type="number" id="harga" name="harga" value="<?= $editMode ? $editBarang['harga'] : '' ?>" required>
            </div>
            <div>
                <label for="stok">Stok Barang</label><br>
                <input type="number" id="stok" name="stok" value="<?= $editMode ? $editBarang['stok'] : '' ?>" required>
            </div>
            <button type="submit" name="<?= $editMode ? 'edit' : 'tambah' ?>" class="btn <?= $editMode ? 'btn-edit' : 'btn-add' ?>">
                <?= $editMode ? 'Update Stok Barang' : 'Tambah Barang' ?>
            </button>
            <?php if ($editMode): ?>
                <a href="index.php" class="btn btn-cancel">Batal</a>
            <?php endif; ?>
        </form>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Stok Barang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($barangManager->getBarang() as $barang): ?>
                <tr>
                    <td><?= $barang['id'] ?></td>
                    <td><?= $barang['nama'] ?></td>
                    <td><?= $barang['harga'] ?></td>
                    <td><?= $barang['stok'] ?></td>
                    <td>
                        <a href="?edit=<?= $barang['id'] ?>" class="btn btn-edit">Edit</a>
                        <a href="?hapus=<?= $barang['id'] ?>" class="btn btn-delete">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
