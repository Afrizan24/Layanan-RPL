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
    <h2>Respon</h2>
    <?php
    $perPage = 10; // Jumlah data per halaman
    $totalData = $result_main->num_rows;
    $totalPages = ceil($totalData / $perPage); // Total halaman
    ?>
    <div id="table-container">
        <?php if ($totalData > 0): ?>
            <?php for ($page = 1; $page <= $totalPages; $page++): ?>
                <div class="table-page" data-page="<?= $page; ?>" style="display: <?= $page === 1 ? 'block' : 'none'; ?>;">
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
                                <th>Gambar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $counter = 0;
                            $result_main->data_seek(0); // Reset pointer untuk iterasi ulang
                            while ($o = $result_main->fetch_assoc()):
                                if ($counter >= ($page - 1) * $perPage && $counter < $page * $perPage): ?>
                                    <tr>
                                        <td><?= $counter + 1; ?></td>
                                        <td><?= htmlspecialchars($o["Nim"]); ?></td>
                                        <td><?= htmlspecialchars($o["username"]); ?></td>
                                        <td><?= htmlspecialchars($o["nama_kategori"]); ?></td>
                                        <td><?= htmlspecialchars($o["deskripsi"]); ?></td>
                                        <td><?= htmlspecialchars($o["lokasi"]); ?></td>
                                        <td><?= htmlspecialchars($o["status"]); ?></td>
                                        <td><?= htmlspecialchars($o["tanggapan"]); ?></td>
                                        <td><?= htmlspecialchars($o["tgl_keluhan"]); ?></td>
                                        <td>
                                            <?php if ($o["gambar"]): ?>
                                                <img src="../src/img<?= htmlspecialchars($o["gambar"], ENT_QUOTES, 'UTF-8'); ?>" alt="Gambar Keluhan" style="width:100px; height:auto;">
                                            <?php else: ?>
                                                gambar tidak ada
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endif;
                                $counter++;
                            endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php endfor; ?>
        <?php else: ?>
            <p class="text-center">Tidak ada data ditemukan.</p>
        <?php endif; ?>
    </div>

    <!-- Navigasi Halaman -->
    <div class="pagination mt-3 d-flex justify-content-center gap-2">
        <?php if ($totalPages > 1): ?>
            <?php for ($page = 1; $page <= $totalPages; $page++): ?>
                <button class="btn btn-secondary page-button" data-page="<?= $page; ?>"><?= $page; ?></button>
            <?php endfor; ?>
        <?php endif; ?>
    </div>
</div>

<script>
    // JavaScript untuk Navigasi Halaman
    document.querySelectorAll('.page-button').forEach(button => {
        button.addEventListener('click', () => {
            const page = button.dataset.page;
            document.querySelectorAll('.table-page').forEach(table => {
                table.style.display = table.dataset.page === page ? 'block' : 'none';
            });
        });
    });
</script>



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
