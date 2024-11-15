<header id="header">
        <button id="toggleSidebar" class="btn">
            <div class="line line1"></div>
            <div class="line line2"></div>
        </button>
        <div class="d-flex justify-content-center align-items-center">
    <div class="d-flex align-items-center text-white">
        <i class="fas fa-bell me-3"></i> 
        <h4 class="mb-0">Selamat datang, <?php echo $_SESSION['username']; ?></h4>
    </div>
    <div class="dropdown ms-3">
        <button class="btn btn-primary dropdown-toggle text-white" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-user me-2"></i>
        </button>
        <ul class="dropdown-menu bg-primary text-white" aria-labelledby="dropdownMenuButton">
    <li><a class="dropdown-item text-white" href="profile.php"><i class="fas fa-id-card me-2"></i> Profil</a></li>
    <li><a class="dropdown-item text-white" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
</ul>

    </div>
</div>


    </header>

