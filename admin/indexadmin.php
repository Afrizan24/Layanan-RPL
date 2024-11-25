<?php 
require '../koneksi.php';

session_start();
if (isset($_SESSION['error'])) {
    echo "<script>alert('" . $_SESSION['error'] . "');</script>";
    unset($_SESSION['error']); // Hapus error setelah ditampilkan
}
?>


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
        <div class="container-fluid"  >
           
        <?php
                       if (isset($_SESSION['username'])) {
                          
                       } else {
                           echo '<span class="navbar-text"><a href="halaman/login.php">
              <button type="submit" class="animated-button"> Log-In </button>
            </a>';
                       }
                       ?>
        </div>
    </nav>

    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar bg-dark p-3">
            <h4 class="text-white">Menu</h4>
            <a href="indexadmin.php" class="nav-link">Dashboard</a>
            <a href="manajemen.php" class="nav-link">Manajemen Mahasiswa</a>
            <a href="keluhan.php" class="nav-link"> Daftar Keluhan</a>
            <a href="respon.php" class="nav-link">Respon</a>
            <a href="logout.php" class="nav-link">Logout</a>
        </div>

        <!-- Main Content -->
        <div class="content">
            <h2>Welcome Nama</h2>
            
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur et repellat accusamus distinctio voluptas? Alias corrupti quos consequatur cum eum.</p>
            <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Keluhan Mahasiswa yang belom di proses</div>
                                                <?php
                                                    // Query untuk menghitung jumlah keluhan dengan status "belum"
                                                    $query = "SELECT COUNT(id_keluhan) AS total_keluhan FROM keluhan WHERE status = 'proses'";

                                                    $result = $koneksi->query($query);
                                                    if ($result && $data = $result->fetch_assoc()) {
                                                        $total_keluhan = $data['total_keluhan'];
                                                    } else {
                                                        $total_keluhan = 0; // Jika terjadi kesalahan, default ke 0
                                                    }
                                                    
                                                ?>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_keluhan; ?></div>

                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                       
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total Keluhan Mahasiswa Yang  sudah di proses</div>
                                              <?php
                                                    // Query untuk menghitung jumlah keluhan dengan status "belum"
                                                    $query = "SELECT COUNT(id_keluhan) AS total_keluhan FROM keluhan WHERE status = 'sudah'";

                                                    $result = $koneksi->query($query);
                                                    if ($result && $data = $result->fetch_assoc()) {
                                                        $total_keluhan = $data['total_keluhan'];
                                                    } else {
                                                        $total_keluhan = 0; // Jika terjadi kesalahan, default ke 0
                                                    }
                                                    
                                                ?>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_keluhan; ?></div>

                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300" ></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
        </div>
        
    </div>


    <!-- modal login  -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="../proses_admin/login_admin.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">MAsuk Sebagai Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Hidden field to store the original Nim -->
                    <input type="hidden" id="original-nim" name="original_nim">
                    <div class="mb-3">
                        <label for="edit-username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="edit-username" name="Username" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="edit-password" name="Password" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" name="edit" class="btn btn-primary">Login</button>
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
