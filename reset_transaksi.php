<?php
session_start();
include('config.php');
$query_reset_transaksi = "DELETE FROM transaksi";
if ($conn->query($query_reset_transaksi) === TRUE) {
    $_SESSION['message'] = "Semua transaksi telah direset.";
} else {
    $_SESSION['message'] = "Terjadi kesalahan saat mereset transaksi: " . $conn->error;
}
header("Location: dashboard.php");
exit();
?>
