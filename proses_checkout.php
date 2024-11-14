<?php
session_start();
include('config.php'); 
if (isset($_GET['kode_transaksi'])) {
    $kode_transaksi = $_GET['kode_transaksi'];
    $query = "DELETE FROM transaksi WHERE kode_transaksi = '$kode_transaksi'";
    if ($conn->query($query) === TRUE) {
        $_SESSION['success_message'] = "Transaksi berhasil di-checkout.";
    } else {
        $_SESSION['error_message'] = "Gagal melakukan checkout.";
    }
}
$conn->close();
header("Location: dashboard.php"); 
exit();
