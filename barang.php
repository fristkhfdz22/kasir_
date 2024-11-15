<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
include('config.php'); 
if (!isset($_SESSION['click_count'])) {
    $_SESSION['click_count'] = 0;
}
if (isset($_POST['search'])) {
    $_SESSION['click_count']++;
    $search_query = $_POST['search'];
} else {
    $search_query = '';
}

if ($_SESSION['click_count'] >= 2) {
    header("Refresh:0"); 
    $_SESSION['click_count'] = 0; 
}
$query = "SELECT * FROM barang WHERE kode_barang LIKE '%$search_query%' OR nama_barang LIKE '%$search_query%'";
$result = $conn->query($query);
$conn->close();
?>
<?php  include('includes/header.php') ?>
<?php  include('includes/navbar.php') ?>
<?php  include('includes/sidebar.php') ?>
<div id="content">
    <div class="mb-4">
        <form method="POST" class="d-flex justify-content-between align-items-center">
            <div class="input-group w-50">
                <input type="text" class="form-control" name="search" placeholder="Cari barang..." value="<?php echo htmlspecialchars($search_query); ?>">
                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Cari</button>
            </div>
        </form>
    </div>
    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="card-title mb-0">Stock Barang</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead >
                        <tr>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Merk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>{$row['kode_barang']}</td>
                                        <td>{$row['nama_barang']}</td>
                                        <td>{$row['merk']}</td>
                                        <td>Rp" . number_format($row['harga'], 2, ',', '.') . "</td>
                                        <td>{$row['stok']}</td>
                                        <td>
                                            <a href='edit_barang.php?id={$row['id']}' class='btn btn-warning btn-sm'><i class='fas fa-edit'></i> Edit</a>
                                            <a href='hapus_barang.php?id={$row['id']}' class='btn btn-danger btn-sm'><i class='fas fa-trash-alt'></i>Hapus</a>
                                        </td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center'>Tidak ada barang ditemukan</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php  include('includes/footer.php') ?>
