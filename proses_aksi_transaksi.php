<?php
session_start();
include('config.php'); 
if (isset($_POST['aksi']) && isset($_POST['kode_transaksi']) && isset($_POST['kode_barang'])) {
    $aksi = $_POST['aksi'];
    $kode_transaksi = $_POST['kode_transaksi'];
    $kode_barang = $_POST['kode_barang'];
    $query = "SELECT * FROM transaksi WHERE kode_transaksi = '$kode_transaksi' AND kode_barang = '$kode_barang'";
    $result = $conn->query($query);
    $transaksi = $result->fetch_assoc();
    if ($transaksi) {
        $jumlah_beli = $transaksi['jumlah_beli'];
        if ($aksi == 'kurangi') {
            $new_jumlah = $jumlah_beli - 1; 
            if ($new_jumlah >= 0) {
                $update_transaksi = "UPDATE transaksi SET jumlah_beli = $new_jumlah WHERE kode_transaksi = '$kode_transaksi' AND kode_barang = '$kode_barang'";
                $conn->query($update_transaksi);
                $update_stok = "UPDATE barang SET stok = stok + 1 WHERE kode_barang = '$kode_barang'";
                $conn->query($update_stok);
            }
        } elseif ($aksi == 'hapus') {
            $delete_transaksi = "DELETE FROM transaksi WHERE kode_transaksi = '$kode_transaksi' AND kode_barang = '$kode_barang'";
            $conn->query($delete_transaksi);
            $update_stok = "UPDATE barang SET stok = stok + $jumlah_beli WHERE kode_barang = '$kode_barang'";
            $conn->query($update_stok);
        }
        $_SESSION['success_message'] = "Aksi berhasil!";
    } else {
        $_SESSION['error_message'] = "Transaksi tidak ditemukan!";
    }
} else {
    $_SESSION['error_message'] = "Aksi tidak valid!";
}
header("Location: dashboard.php");
exit();
?>
