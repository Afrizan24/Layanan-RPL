<?php
require '../koneksi.php'; 

// Variabel untuk menampung input pencarian dan hasilnya
$search = ''; 
$search_result = null;

// Query default untuk mengambil semua data
$query = "SELECT Nim, username, password FROM mahasiswa";
$result_main = mysqli_query($koneksi, $query);

// Cek jika form pencarian disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
    $search = trim($_POST['search']); // Ambil input pencarian

    if ($search) {
        // Query untuk pencarian, hanya mengambil satu hasil
        $query = "SELECT * FROM mahasiswa WHERE Nim = ? OR username = ? LIMIT 1";

        // Mempersiapkan statement SQL
        $stmt = mysqli_prepare($koneksi, $query);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'ss', $search, $search); 
            mysqli_stmt_execute($stmt);
            $search_result = mysqli_stmt_get_result($stmt); // Ambil hasil pencarian
        } else {
            die("Query pencarian gagal: " . mysqli_error($koneksi));
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark">
       
    </nav>

    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar bg-dark p-3">
            <h4 class="text-white">Menu</h4>
            <a href="indexadmin.php" class="nav-link">Dashboard</a>
            <a href="manajemen.php" class="nav-link">Manajemen Mahasiswa</a>
            <a href="keluhan.php" class="nav-link">Daftar Keluhan</a>
            <a href="respon.php" class="nav-link">Respon</a>
            <a href="../proses_admin/logout.php" class="nav-link">Logout</a>
        </div>



<!-- Main Content -->
<div class="content container my-5">
    <h2>Manajemen Mahasiswa</h2>

    <!-- Form pencarian -->
    <form action="" method="POST">    
        <div class="mb-3">
            <label for="search" class="form-label">Cari Mahasiswa</label>
            <input type="text" class="form-control" id="search" name="search" placeholder="Masukkan NIM atau Username" required autocomplete="off" value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit" class="btn btn-primary mt-2">Cari</button>              
        </div>
    </form>

    <?php if (!empty($search)): ?>
        <a href="?" class="btn btn-secondary mb-3">Kembali</a>
    <?php endif; ?>

    <!-- Tabel untuk menampilkan data mahasiswa -->
    <div id="table-container" class="overflow-auto">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Tentukan data yang akan ditampilkan: hasil pencarian atau data utama
                if (!empty($search_result) && mysqli_num_rows($search_result) > 0): 
                    // Jika pencarian dilakukan, tampilkan hanya satu data
                    $i = 1;
                    while ($mhs = mysqli_fetch_assoc($search_result)):
                ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo htmlspecialchars($mhs['Nim']); ?></td>
                        <td><?php echo htmlspecialchars($mhs['username']); ?></td>
                        <td><?php echo htmlspecialchars($mhs['password']); ?></td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal" data-nim="<?php echo htmlspecialchars($mhs['Nim']); ?>" data-username="<?php echo htmlspecialchars($mhs['username']); ?>">Edit</a>
                            <a href="../proses_admin/hapus_manajemen.php?Nim=<?php echo htmlspecialchars($mhs['Nim']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php
                    endwhile;
                elseif (!empty($result_main) && mysqli_num_rows($result_main) > 0):
                    // Jika tidak ada pencarian, gunakan data utama dengan paginasi
                    $perPage = 6; // Jumlah data per halaman
                    $totalData = mysqli_num_rows($result_main);
                    $totalPages = ceil($totalData / $perPage);
                    $i = 1;

                    // Pagination logic
                    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                    $offset = ($page - 1) * $perPage;
                    $data_paginated = mysqli_query($koneksi, "SELECT * FROM mahasiswa LIMIT $offset, $perPage");

                    while ($mhs = mysqli_fetch_assoc($data_paginated)):
                ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo htmlspecialchars($mhs['Nim']); ?></td>
                        <td><?php echo htmlspecialchars($mhs['username']); ?></td>
                        <td><?php echo htmlspecialchars($mhs['password']); ?></td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-nim="<?php echo htmlspecialchars($mhs['Nim']); ?>" data-username="<?php echo htmlspecialchars($mhs['username']); ?>">Edit</a>
                            <a href="../proses_admin/hapus_manajemen.php?Nim=<?php echo htmlspecialchars($mhs['Nim']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php
                    endwhile;
                else:
                ?>
                    <tr>
                        <td colspan="5" class="text-center">
                            <?= !empty($search) ? "Tidak ada data ditemukan untuk pencarian \"" . htmlspecialchars($search) . "\"" : "Tidak ada data ditemukan."; ?>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Navigasi Halaman untuk Data Utama -->
    <?php if (empty($search_result) && mysqli_num_rows($result_main) > 0): ?>
        <div class="pagination mt-3 d-flex justify-content-center gap-2">
            <?php for ($page = 1; $page <= $totalPages; $page++): ?>
                <a href="?page=<?= $page; ?>" class="btn btn-secondary <?= isset($_GET['page']) && (int)$_GET['page'] === $page ? 'active' : ''; ?>"><?= $page; ?></a>
            <?php endfor; ?>
        </div>
    <?php endif; ?>
</div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
    const editButtons = document.querySelectorAll(".btn-primary[data-bs-target='#editModal']");
    editButtons.forEach(button => {
        button.addEventListener("click", function () {
            const nim = button.getAttribute("data-nim");
            const username = button.getAttribute("data-username");
            const password = button.getAttribute("data-password");

            document.getElementById("edit-nim").value = nim;
            document.getElementById("original-nim").value = nim;
            document.getElementById("edit-username").value = username;
            document.getElementById("edit-password").value = password;
        });
    });
});
        // Toggle sidebar visibility
        document.getElementById("menu-toggle").addEventListener("click", function () {
            document.querySelector(".sidebar").classList.toggle("active");
            document.querySelector(".content").classList.toggle("active");
        });
    </script>

<script>
// Tombol navigasi untuk pindah antar halaman
document.querySelectorAll('.page-button').forEach(button => {
    button.addEventListener('click', () => {
        const page = button.getAttribute('data-page');
        document.querySelectorAll('.table-page').forEach(pageDiv => {
            if (pageDiv.getAttribute('data-page') === page) {
                pageDiv.style.display = 'block';
            } else {
                pageDiv.style.display = 'none';
            }
        });
    });
});
</script>
</body>
</html>
