<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
include 'config.php';
$totalPenggunaQuery = $conn->query("SELECT COUNT(*) AS total_pengguna FROM pengguna");
$totalPengguna = $totalPenggunaQuery->fetch_assoc()['total_pengguna'];
$barangQuery = $conn->query("SELECT COUNT(*) AS total_barang, SUM(stok) AS total_stok FROM barang");
$barangData = $barangQuery->fetch_assoc();
$totalBarang = $barangData['total_barang'];
$totalStok = $barangData['total_stok'];
$transaksiQuery = $conn->query("SELECT COUNT(*) AS total_transaksi, SUM(total_bayar) AS total_bayar FROM transaksi");
$transaksiData = $transaksiQuery->fetch_assoc();
$totalTransaksi = $transaksiData['total_transaksi'];
$totalBayar = isset($transaksiData['total_bayar']) ? $transaksiData['total_bayar'] : 0; 
$conn->close();
?>
<?php include('includes/header.php'); ?>
<?php include('includes/navbar.php'); ?>
<?php include('includes/sidebar.php'); ?>
<div id="content">
   <div class="row">
       <div class="col-md-3 mb-4">
           <div class="card shadow-sm border-primary">
               <div class="card-body text-center">
                   <i class="fas fa-users fa-2x text-primary"></i>
                   <h5 class="mt-2">Total Pengguna</h5>
                   <p class="h4"><?php echo $totalPengguna; ?></p>
               </div>
           </div>
       </div>
       <div class="col-md-3 mb-4">
           <div class="card shadow-sm border-success">
               <div class="card-body text-center">
                   <i class="fas fa-cube fa-2x text-success"></i>
                   <h5 class="mt-2">Total Barang</h5>
                   <p class="h4"><?php echo $totalBarang; ?></p>
               </div>
           </div>
       </div>
       <div class="col-md-3 mb-4">
           <div class="card shadow-sm border-warning">
               <div class="card-body text-center">
                   <i class="fas fa-boxes fa-2x text-warning"></i>
                   <h5 class="mt-2">Total Stok Barang</h5>
                   <p class="h4"><?php echo $totalStok; ?></p>
               </div>
           </div>
       </div>
   </div>
   <div class="row">
       <div class="col-md-3 mb-4">
           <div class="card shadow-sm border-info">
               <div class="card-body text-center">
                   <i class="fas fa-credit-card fa-2x text-info"></i>
                   <h5 class="mt-2">Total Transaksi</h5>
                   <p class="h4"><?php echo $totalTransaksi; ?></p>
               </div>
           </div>
       </div>
       <div class="col-md-3 mb-4">
           <div class="card shadow-sm border-danger">
               <div class="card-body text-center">
                   <i class="fas fa-money-bill-wave fa-2x text-danger"></i>
                   <h5 class="mt-2">Total Pembayaran</h5>
                   <p class="h4">Rp <?php echo number_format((float)$totalBayar, 2, ',', '.'); ?></p>
               </div>
           </div>
       </div>
   </div>
</div>
<?php include('includes/footer.php'); ?>
