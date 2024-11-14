<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
include('config.php'); 
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM barang WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Terjadi kesalahan saat menghapus barang.";
    }
    $stmt->close();
}
$conn->close();
?>
