<?php
require '../koneksi.php'; 

// Cek apakah ada input pencarian
$search = isset($_GET['search']) ? $_GET['search'] : '';

//menampilkan tabel databse tetap le
$sql_main = "SELECT m.*, k.*, cat.*
          FROM keluhan k
          JOIN mahasiswa m ON k.id_mhs = m.id_mhs
          JOIN kategori_keluhan cat ON k.id_kategori_keluhan = cat.id_kategori_keluhan
          WHERE k.Status = 'sudah'";
$result_main = $koneksi->query($sql_main);

// Kode Pencari menampilkan kalok ingput sekaligus menampilkan hasil dari pencarian le
if (!empty($search)) {
                $sql_search = "SELECT m.*, k.*, cat.*
                FROM keluhan k
                JOIN mahasiswa m ON k.id_mhs = m.id_mhs
                JOIN kategori_keluhan cat ON k.id_kategori_keluhan = cat.id_kategori_keluhan
                
                WHERE m.Nim LIKE ? OR m.username LIKE ?";
                        $stmt = $koneksi->prepare($sql_search);
                        $search_param = "%" . $search . "%";
                        $stmt->bind_param("ss", $search_param, $search_param);
                        $stmt->execute();
                        $result_search = $stmt->get_result();
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
        <h2>Respon</h2>
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
                <th>gambar</th>
            </tr>
        </thead>
        <!-- result main untuk tabel tetap le  -->
            <?php $i = 1; ?>
              <?php if ($result_main && $result_main->num_rows > 0): ?>
                  <?php while ($o = $result_main->fetch_assoc()): ?>
                      <tr>
                          <td><?= $i; ?></td>
                          <td><?= $o["Nim"]; ?></td>
                          <td><?= $o["username"]; ?></td>
                          <td><?= $o["nama_kategori"]; ?></td>
                          <td><?= $o["deskripsi"]; ?></td>
                          <td><?= $o["lokasi"]; ?></td>
                          <td><?= $o["status"]; ?></td>
                          <td><?= $o["tanggapan"]; ?></td>
                          <td><?= $o["tgl_keluhan"]; ?></td>
                          <td>
                            <?php
                              if ($o["gambar"]){
                                echo '<img src="../src/img' . htmlspecialchars($o["gambar"], ENT_QUOTES, 'UTF-8') . '" alt="Gambar Keluhan" style="width:100px; height:auto;">';
                              }else{
                                echo 'gambar tidak ada';
                              }
                            ?>
                            </td>

                      </tr>
                      <?php $i++; ?>
                      
                  <?php endwhile; ?>
              <?php else: ?>
                  <tr>
                      <td colspan="10">No data found</td>
                  </tr>
              <?php endif; ?>
            </tbody>
        </table>


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
