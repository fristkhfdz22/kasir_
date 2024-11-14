<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
include('config.php');
$query_transaksi_list = "
    SELECT t.kode_transaksi, b.nama_barang, b.merk, t.jumlah_beli, t.total_bayar, t.tanggal
    FROM transaksi t
    JOIN barang b ON t.kode_barang = b.kode_barang
    ORDER BY t.tanggal DESC";
$result_transaksi = $conn->query($query_transaksi_list);
$total_bayar_all = 0;
?>
<?php  include('includes/header.php') ?>
<?php  include('includes/navbar.php') ?>
<?php  include('includes/sidebar.php') ?>
<div id="content" class="container" style="max-width: 400px; font-family: 'Courier New', Courier, monospace;">
    <h2 class="text-center">Struk Transaksi</h2>
    <p class="text-center mb-4">Daftar Transaksi</p>
    <table class="table table-borderless">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result_transaksi->num_rows > 0) {
                while ($row = $result_transaksi->fetch_assoc()) {
                    $total_bayar_all += $row['total_bayar'];
                    echo "<tr>
                            <td>{$row['kode_transaksi']}</td>
                            <td>{$row['nama_barang']} - {$row['merk']}</td>
                            <td>{$row['jumlah_beli']}</td>
                            <td>Rp" . number_format($row['total_bayar'], 2, ',', '.') . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4' class='text-center'>Tidak ada transaksi</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <div class="border-top mt-3 pt-2">
        <div class="row">
            <div class="col text-end">
                <strong>Total Semua Bayar:</strong> Rp<?= number_format($total_bayar_all, 2, ',', '.') ?>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between mt-4">
        <button class="btn btn-primary" onclick="window.print()">Cetak</button>
        <a href="dashboard.php" class="btn btn-secondary">Dashboard</a>
    </div>
</div>
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #content, #content * {
            visibility: visible;
        }
        #content {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            max-width: 400px;
            margin: 0 auto;
            text-align: center;
        }
        .btn, h2 {
            display: none;
        }
    }
</style>
    <?php  include('includes/footer.php') ?>
