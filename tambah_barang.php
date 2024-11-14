<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
include('config.php'); 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $merk = $_POST['merk'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    if (empty($kode_barang) || empty($nama_barang) || empty($harga) || empty($stok)) {
        $error_message = "Semua kolom harus diisi.";
    } else {
        $query = "INSERT INTO barang (kode_barang, nama_barang, merk, harga, stok) 
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssss", $kode_barang, $nama_barang, $merk, $harga, $stok);
        if ($stmt->execute()) {
            $success_message = "Barang berhasil ditambahkan.";
        } else {
            $error_message = "Terjadi kesalahan: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>
<?php  include('includes/header.php') ?>
<?php  include('includes/navbar.php') ?>
<?php  include('includes/sidebar.php') ?>
<div id="content">
    <h2 class="mt-5">Tambah Barang</h2>
    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger mt-3">
            <i class="fas fa-exclamation-circle"></i> <?php echo $error_message; ?>
        </div>
    <?php endif; ?>
    <?php if (isset($success_message)): ?>
        <div class="alert alert-success mt-3">
            <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
        </div>
    <?php endif; ?>
    <form action="tambah_barang.php" method="POST" class="mt-4 p-4 rounded shadow-sm bg-light">
        <div class="mb-3">
            <label for="kode_barang" class="form-label">Kode Barang</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                <input type="text" class="form-control" id="kode_barang" name="kode_barang" required placeholder="Masukkan kode barang">
            </div>
        </div>
        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-box"></i></span>
                <input type="text" class="form-control" id="nama_barang" name="nama_barang" required placeholder="Masukkan nama barang">
            </div>
        </div>
        <div class="mb-3">
            <label for="merk" class="form-label">Merk</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                <input type="text" class="form-control" id="merk" name="merk" placeholder="Masukkan merk barang">
            </div>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-money-bill-wave"></i></span>
                <input type="number" class="form-control" id="harga" name="harga" required placeholder="Masukkan harga barang">
            </div>
        </div>
        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-cubes"></i></span>
                <input type="number" class="form-control" id="stok" name="stok" required placeholder="Masukkan jumlah stok">
            </div>
        </div>
        <button type="submit" class="btn btn-primary w-100 mt-4"><i class="fas fa-plus-circle"></i> Tambah Barang</button>
    </form>
</div>
<style>
    #content h2 {
        color: #4A90E2;
        font-weight: bold;
    }
    .form-label {
        font-weight: 500;
    }
    .input-group-text {
        background-color: #4A90E2;
        color: #fff;
    }
    .btn-primary {
        background-color: #4A90E2;
        border: none;
    }
    .btn-primary:hover {
        background-color: #357ABD;
    }
</style>
    <?php  include('includes/footer.php') ?>
