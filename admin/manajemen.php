<?php 
require '../koneksi.php'; 

// Untuk menampilkan Isi
$nim = ''; // Inisialisasi variabel nim
$query = "SELECT nim, username, password FROM mahasiswa";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nim = trim($_POST['nim']); 
    $query .= " WHERE nim = ?"; 
}

$stmt = mysqli_prepare($koneksi, $query);
if ($nim) {
    mysqli_stmt_bind_param($stmt, 's', $nim); // Mengikat parameter jika ada NIM
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Periksa apakah query berhasil
if (!$result) {
    die("Query gagal: " . mysqli_error($koneksi));
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
            <a href="keluhan.php" class="nav-link">Daftar Keluhan</a>
            <a href="logout.php" class="nav-link">Logout</a>
        </div>

        <!-- Main Content -->
        <div class="content container my-5">
            <h2>Manajemen Mahasiswa</h2>
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
                <tbody>
                    <tr>
                    <?php 
                            $no = 1; 
                            while ($mhs = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td><?php echo $no++; ?></td> 
                                    <td><?php echo htmlspecialchars($mhs['nim']); ?></td>
                                    <td><?php echo htmlspecialchars($mhs['username']); ?></td>
                                    <td><?php echo htmlspecialchars($mhs['password']); ?></td>
                                    <td>
                                        <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal">Edit</a>
                                        <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal">Hapus</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                    <!-- Tambahkan data mahasiswa lainnya di sini -->
                </tbody>
            </table>

            
            <!-- nyari mahasiswa -->
            <form action="" method="POST">    
            <div class="mb-3">
                <label for="nim" class="form-label">Cari Mahasiswa </label>
                <input type="text" class="form-control" id="nim" name="nim" required autocomplete="off" value="<?php echo htmlspecialchars($nim); ?>">
                <button type="submit" class="btn btn-primary mt-2">Cari</button>              
            </div>
            </form>
            
        </div>
    </div>


    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data Mahasiswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" action="edit_manajemen.php" method="POST">
                        <input type="hidden" id="editId" name="id">
                        <div class="mb-3">
                            <label for="editNim" class="form-label">NIM</label>
                            <input type="text" class="form-control" id="editNim" name="nim" required>
                        </div>
                        <div class="mb-3">
                            <label for="editUsername" class="form-label">Username</label>
                            <input type="text" class="form-control" id="editUsername" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="editPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="editPassword" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>

                </div>
            </div>
        </div>
    </div>


<!-- //Modal Delete// -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Hapus Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin menghapus data ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-danger">Hapus</button>
      </div>
    </div>
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
