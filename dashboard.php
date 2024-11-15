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
    $search = $_POST['search'];
} else {
    $search = '';
}

if ($_SESSION['click_count'] >= 2) {
    header("Refresh:0"); 
    $_SESSION['click_count'] = 0; 
}
$query_barang = "SELECT * FROM barang WHERE kode_barang LIKE '%$search%' OR nama_barang LIKE '%$search%'";
$result_barang = $conn->query($query_barang);
$query_transaksi = "
    SELECT transaksi.kode_transaksi, transaksi.kode_barang, 
           barang.nama_barang, barang.merk, transaksi.jumlah_beli, 
           barang.harga, transaksi.tanggal
    FROM transaksi
    JOIN barang ON transaksi.kode_barang = barang.kode_barang
    ORDER BY transaksi.kode_transaksi, transaksi.tanggal DESC";
$result_transaksi = $conn->query($query_transaksi);
$conn->close();
?>
<?php  include('includes/header.php') ?>
<?php  include('includes/navbar.php') ?>
<?php  include('includes/sidebar.php') ?>
<div id="content">
    <div class="mb-4">
    <form method="POST" class="d-flex justify-content-between align-items-center">
    <div class="input-group w-50">
        <input type="text" class="form-control w-50" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Cari Kode Barang atau Nama Barang">
        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Cari</button>
    </div>
</form>
    </div>
    <div class="card shadow-sm mb-4">
    <div class="card-header">
            <h5 class="card-title mb-0">Barang</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
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
                        if ($result_barang->num_rows > 0) {
                            while($row = $result_barang->fetch_assoc()) {
                                echo "<tr>
                                        <td>{$row['kode_barang']}</td>
                                        <td>{$row['nama_barang']}</td>
                                        <td>{$row['merk']}</td>
                                        <td>Rp" . number_format($row['harga'], 2, ',', '.') . "</td>
                                        <td>{$row['stok']}</td>
                                        <td>
                                            <form action='proses_beli.php' method='POST'>
                                                <input type='hidden' name='kode_barang' value='{$row['kode_barang']}'>
                                                <button type='submit' class='btn btn-primary btn-sm'>Beli</button>
                                            </form>
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
    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="card-title mb-0">Riwayat Transaksi</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Kode Transaksi</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Merk</th>
                            <th>Jumlah Beli</th>
                            <th>Total Bayar</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total_bayar_transaksi = 0;
                        if ($result_transaksi->num_rows > 0) {
                            while($row = $result_transaksi->fetch_assoc()) {
                                $total_bayar_per_barang = $row['harga'] * $row['jumlah_beli'];
                                $total_bayar_transaksi += $total_bayar_per_barang;
                                echo "<tr>
                                        <td>{$row['kode_transaksi']}</td>
                                        <td>{$row['kode_barang']}</td>
                                        <td>{$row['nama_barang']}</td>
                                        <td>{$row['merk']}</td>
                                        <td>{$row['jumlah_beli']}</td>
                                        <td>Rp" . number_format($total_bayar_per_barang, 2, ',', '.') . "</td>
                                        <td>{$row['tanggal']}</td>
                                        <td>
                                            <form action='proses_aksi_transaksi.php' method='POST'>
                                                <input type='hidden' name='kode_transaksi' value='{$row['kode_transaksi']}'>
                                                <input type='hidden' name='kode_barang' value='{$row['kode_barang']}'>
                                                <button type='submit' name='aksi' value='kurangi' class='btn btn-warning btn-sm'><i class='fas fa-minus-circle'></i> Kurangi</button>
                                                <button type='submit' name='aksi' value='hapus' class='btn btn-danger btn-sm'><i class='fas fa-trash-alt'></i> Hapus</button>
                                            </form>
                                        </td>
                                    </tr>";
                            }
                            echo "<tr><td colspan='8' class='text-center'>
                            <strong>Total Bayar: Rp" . number_format($total_bayar_transaksi, 2, ',', '.') . "</strong>
                          </td></tr>";

                        } else {
                            echo "<tr><td colspan='8' class='text-center'>Tidak ada transaksi ditemukan</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between mt-4">
                <form action="transaksi.php" method="POST">
                    <input type="hidden" name="checkout" value="1">
                    <button type="submit" class="btn btn-success"><i class="fas fa-check-circle"></i> Checkout</button>
                </form>
                <form action="reset_transaksi.php" method="POST">
                    <button type="submit" class="btn btn-danger"><i class="fas fa-undo"></i> Reset Transaksi</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php  include('includes/footer.php') ?>
