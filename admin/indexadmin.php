<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link ke file CSS eksternal -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" id="menu-toggle">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">Nama</a>
        </div>
    </nav>

    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar bg-dark p-3">
            <h4 class="text-white">Menu</h4>
            <a href="indexadmin.php" class="nav-link">Dashboard</a>
            <a href="manajemen.php" class="nav-link">Manajemen Mahasiswa</a>
            <a href="kategori.php" class="nav-link">Kategori Keluhan</a>
            <a href="keluhan.php" class="nav-link"> Daftar Keluhan</a>
            <a href="logout.php" class="nav-link">Logout</a>
        </div>

        <!-- Main Content -->
        <div class="content">
            <h2>Welcome Nama</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur et repellat accusamus distinctio voluptas? Alias corrupti quos consequatur cum eum.</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar visibility
        document.getElementById("menu-toggle").addEventListener("click", function () {
            document.querySelector(".sidebar").classList.toggle("active");
            document.querySelector(".content").classList.toggle("active");
        });
    </script>
</body>
</html>
