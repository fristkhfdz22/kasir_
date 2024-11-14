<?php
session_start();
include('config.php');
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $error_message = 'Username atau password tidak boleh kosong';
    } else {
        $query = "SELECT * FROM pengguna WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (MD5($password) == $row['kata_sandi']) {
                                $_SESSION['username'] = $username;
                $_SESSION['id'] = $row['id'];
                header("Location: dashboard.php"); 
                exit();
            } else {
                $error_message = "Password salah.";
            }
        } else {
            $error_message = "Username tidak ditemukan.";
        }
        $stmt->close();
    }
}
?>

<?php include('includes/header.php'); ?>
<style>
    body {
        background-color: #e0f7fa;
        font-family: Arial, sans-serif;
    }
    .login-container {
        max-width: 400px;
        margin: 100px auto;
    }
    .login-card {
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #ffffff;
    }
    .login-title {
        color: #007bff;
        font-weight: bold;
        text-align: center;
        margin-bottom: 1.5rem;
    }
    .password-container {
        position: relative;
    }
    .password-toggle {
        position: absolute;
        top: 75%;
        right: 10px;
        transform: translateY(-50%);
        cursor: pointer;
        background: none;
        border: none;
        color: #007bff;
        padding: 0;
        font-size: 1.2em;
    }
    .password-toggle:focus {
        outline: none;
    }
</style>

<div class="container login-container">
    <div class="login-card">
        <h2 class="login-title">Login Kasir</h2>
        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger mt-3">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <form action="login.php" method="POST" class="mt-4">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3 password-container">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <button type="button" class="password-toggle" onclick="togglePassword()">
                    <i class="bi bi-eye" id="toggle-icon"></i>
                </button>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</div>

<script>
    function togglePassword() {
        const passwordField = document.getElementById("password");
        const toggleIcon = document.getElementById("toggle-icon");
        if (passwordField.type === "password") {
            passwordField.type = "text";
            toggleIcon.classList.remove("bi-eye");
            toggleIcon.classList.add("bi-eye-slash");
        } else {
            passwordField.type = "password";
            toggleIcon.classList.remove("bi-eye-slash");
            toggleIcon.classList.add("bi-eye");
        }
    }
</script>
<?php include('includes/footer.php'); ?>
