<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
            <a href="keluhan.php" class="nav-link">Daftar Keluhan</a>
            <a href="logout.php" class="nav-link">Logout</a>
        </div>

        <!-- Main Content -->
        <div class="content container my-5">
            <h2>Manajemen Keluham</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Kategori</th>
                        <th>Deskipsi</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                        <th>Tanggapan</th>
                        <th>Tanggal Keluhan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>23423423</td>
                        <td>IPUL GAY</td>
                        <td>JOMOK</td>
                        <td>Samarinda</td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm">Terima</a>
                            <a href="#" class="btn btn-danger btn-sm">Tolak</a>
                        </td>
                        <td>Awododkwok</td>
                        <td>23-09-2077</td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm">Edit</a>
                            <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                        </td>
                    </tr>
                    <!-- Tambahkan data mahasiswa lainnya di sini -->
                </tbody>
            </table>
            <a href="#" class="btn btn-success">Tambah Kategori</a>
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
