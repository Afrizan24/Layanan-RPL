<?php
include '../koneksi.php'; // Memasukkan file koneksi

$sql = "SELECT m.*, k.*, cat.*
          FROM keluhan k
          JOIN mahasiswa m ON k.id_mhs = m.id_mhs
          JOIN kategori_keluhan cat ON k.id_kategori_keluhan = cat.id_kategori_keluhan";

$stmt = $koneksi->prepare($sql);

if ($stmt) {
  
    $stmt->execute();
    $result = $stmt->get_result();
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
            <h2>Manajemen Keluham</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Kategori Keluhan</th>
                        <th>Deskripsi</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                        <th>Tanggapan</th>
                        <th>Waktu</th>
                        <th>APALAH</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <?php $i = 1 ?>
                         <?php foreach($result as $o){?>
                                <td> <?= $i; ?></td>
                                <td><?=$o["Nim"]?></td>
                                <td><?=$o["username"]?></td>
                                <td><?=$o["nama_kategori"]?></td>
                                <td><?=$o["deskripsi"]?></td>
                                <td><?=$o["lokasi"]?></td>
                                <td><?=$o["status"]?></td>
                                <td><?=$o["tanggapan"]?></td>
                                <td><?=$o["tgl_keluhan"]?></td>
                                <td>
                                        <a href="#" class="btn btn-primary btn-sm"  data-bs-toggle="modal" data-bs-target="#editModal">Edit</a>
                                        <a href="#" class="btn btn-danger btn-sm"   data-bs-toggle="modal" data-bs-target="#deleteModal">Hapus</a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                    <?php }?>
                    <!-- Tambahkan data mahasiswa lainnya di sini -->
                </tbody>
            </table>
            <div class="mb-3">
                 <label for="" class="form-label">Cari Mahasiswa</label>
                 <input type="text" class="form-control" id="username" name="username" required autocomplete="off">
            </div>
        </div>
    </div>


 <!-- //modal Edit// -->
 <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
             <label for="" class="form-label">Ubah Nim</label>
             <input type="text" class="form-control" id="username" name="username" required autocomplete="off">
        </div>
        <div class="mb-3">
             <label for="" class="form-label">Ubah Nama</label>
             <input type="text" class="form-control" id="username" name="username" required autocomplete="off">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary">Simpan Perubahan</button>
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
