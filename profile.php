<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
include('config.php');
$username = $_SESSION['username'];
$query = "SELECT * FROM pengguna WHERE username = '$username'";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "Pengguna tidak ditemukan.";
    exit();
}
?>
<?php include('includes/header.php'); ?>
<?php include('includes/navbar.php'); ?>
<?php include('includes/sidebar.php'); ?>
<div id="content" class="container mt-4">
    <div class="card w-100">
        <div class="card-header text-center bg-primary text-white">
            Profil Pengguna
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Nama Lengkap:</strong> <?= htmlspecialchars($user['nama_lengkap']) ?></li>
            <li class="list-group-item"><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></li>
            <li class="list-group-item"><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></li>
            <li class="list-group-item"><strong>Role:</strong> <?= htmlspecialchars($user['role']) ?></li>
            <li class="list-group-item"><strong>Tanggal Bergabung:</strong> <?= date('d-m-Y', strtotime($user['tanggal_dibuat'])) ?></li>
        </ul>

     
    </div>
</div>
<?php include('includes/footer.php'); ?>
<style>
    .card {
        width: 100%; 
        max-width: 100%; 
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        margin-top: 2%;
    }
    .card-header {
        font-size: 1.5rem;
        font-weight: bold;
    }
    .list-group-item {
        font-size: 1.1rem;
        padding: 0.8rem 1.5rem;
    }

    .btn {
        width: 120px; 
    }
</style>
