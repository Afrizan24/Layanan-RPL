<?php 
require '../koneksi.php'; 

// Untuk menampilkan Isi
$search = ''; // Untuk input pencarian
$query = "SELECT Nim, username, password FROM mahasiswa"; // Query default
$result = mysqli_query($koneksi, $query);

$search_result = null; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
    $search = trim($_POST['search']); // Mengambil dan membersihkan input pencarian

    if ($search) {
        
        $query = "SELECT * FROM mahasiswa WHERE Nim = ? OR username = ?";
        
        // Mempersiapkan statement SQL
        $stmt = mysqli_prepare($koneksi, $query);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'ss', $search, $search); 
            mysqli_stmt_execute($stmt);
            $search_result = mysqli_stmt_get_result($stmt); 

            
            if (!$search_result) {
                die("Query pencarian gagal: " . mysqli_error($koneksi));
            }
        } else {
            die("Query gagal: " . mysqli_error($koneksi));
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
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <!-- <button class="navbar-toggler" type="button" id="menu-toggle">
                <span class="navbar-toggler-icon"></span>
            </button> -->
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
            <a href="respon.php" class="nav-link">Respon</a>
            <a href="logout.php" class="nav-link">Logout</a>
        </div>

        <!-- Main Content -->
        <div class="content container my-5">
            <h2>Manajemen Mahasiswa</h2>
    <!-- Tabel untuk menampilkan semua data mahasiswa -->
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
            $no = 1;
            // Pastikan $result valid sebelum melakukan fetch data
            if ($result && mysqli_num_rows($result) > 0) {
                while ($mhs = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo htmlspecialchars($mhs['Nim']); ?></td>
                        <td><?php echo htmlspecialchars($mhs['username']); ?></td>
                        <td><?php echo htmlspecialchars($mhs['password']); ?></td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal">Edit</a>
                            <a href="hapus_manajemen.php?Nim=<?php echo htmlspecialchars($mhs['Nim']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                    </tr>
                <?php endwhile; 
            } else { ?>
                <tr>
                    <td colspan="5">Data tidak ditemukan.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

            
            <!-- nyari mahasiswa -->
        <form action="" method="POST">    
        <div class="mb-3">
            <label for="search" class="form-label">Cari Mahasiswa</label>
            <input type="text" class="form-control" id="search" name="search" placeholder="Masukkan NIM atau Username" required autocomplete="off" value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit" class="btn btn-primary mt-2">Cari</button>              
        </div>
    </form>

    <!-- Hasil Pencarian -->
    <?php if ($search_result && mysqli_num_rows($search_result) > 0): ?>
        <h3>Hasil Pencarian untuk "<?php echo htmlspecialchars($search); ?>"</h3>
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
                $no = 1;
                // Loop untuk menampilkan data hasil pencarian
                while ($mhs = mysqli_fetch_assoc($search_result)) : ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo htmlspecialchars($mhs['Nim']); ?></td>
                        <td><?php echo htmlspecialchars($mhs['username']); ?></td>
                        <td><?php echo htmlspecialchars($mhs['password']); ?></td>
                        <td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal" data-nim="<?php echo htmlspecialchars($mhs['Nim']); ?>" data-username="<?php echo htmlspecialchars($mhs['username']); ?>">Edit</a>
                            <a href="hapus_manajemen.php?Nim=<?php echo htmlspecialchars($mhs['Nim']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php elseif ($search): ?>
        <p>Data tidak ditemukan untuk pencarian "<?php echo htmlspecialchars($search); ?>"</p>
    <?php endif; ?>
</div>
           
</div>
        </div>
    </div>


   <!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="edit_manajemen.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Mahasiswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit-username" class="form-label">Nim</label>
                        <input type="text" class="form-control" id="edit-username" name="Nim" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="edit-username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="edit-password" name="password" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" name="edit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
 
        </div>
    </div>
</div>

<!-- Modal Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="delete.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Hapus Mahasiswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data ini?</p>
                    <input type="hidden" name="nim" id="delete-nim">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="delete" class="btn btn-danger">Hapus</button>
                </div>
            </form>
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
