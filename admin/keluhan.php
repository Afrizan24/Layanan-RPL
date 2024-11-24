<?php
require '../koneksi.php'; 

// Cek apakah ada input pencarian
$search = isset($_GET['search']) ? $_GET['search'] : '';

//menampilkan tabel databse tetap le
$sql_main = "SELECT m.*, k.*, cat. * ,k.gambar
          FROM keluhan k
          JOIN mahasiswa m ON k.id_mhs = m.id_mhs
          JOIN kategori_keluhan cat ON k.id_kategori_keluhan = cat.id_kategori_keluhan
          where k.Status = 'proses'";

$result_main = $koneksi->query($sql_main);

// Kode Pencari menampilkan kalok ingput sekaligus menampilkan hasil dari pencarian le
if (!empty($search)) {
                $sql_search = "SELECT m.*, k.*, cat. * ,k.gambar
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
    </div>


    <!-- Main Content -->
   <!-- Main Content -->
<div class="content container my-5">
    <h2>Manajemen Keluhan</h2>

    <!-- Form pencarian -->
    <form action="" method="GET" class="mb-3">
        <label for="search" class="form-label">Cari Yang Mengeluh</label>
        <input type="text" class="form-control" id="search" name="search" placeholder="Masukkan NIM atau Username" required autocomplete="off" value="<?= htmlspecialchars($search ?? '', ENT_QUOTES, 'UTF-8'); ?>">
        <button type="submit" class="btn btn-primary mt-2">Cari</button>
    </form>

    <!-- Kontainer Tabel -->
    <div id="table-container" class="overflow-auto" style="max-height: 500px;">

        <?php 
        $data = !empty($search) ? $result_search : $result_main; 


        // sebagai tombol navigasi
        if (!empty($data) && $data->num_rows > 0):
            $perPage = 6; // Jumlah data per halaman
            $totalData = $data->num_rows;
            $totalPages = ceil($totalData / $perPage);
            $i = 1;
            for ($page = 1; $page <= $totalPages; $page++): ?>
                <div class="table-page overflow-auto" data-page="<?= $page; ?>" style="min-width: 100%; display: <?= $page === 1 ? 'block' : 'none'; ?>;">

                    <table class="table table-striped overflow-auto">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Kategori Keluhan</th>
                                <th>Deskripsi</th>
                                <th>Lokasi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                                <th>Waktu</th>
                                <th>Gambar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $counter = 0;
                            $data->data_seek(0);
                            while ($o = $data->fetch_assoc()):
                                if ($counter >= ($page - 1) * $perPage && $counter < $page * $perPage): ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= htmlspecialchars($o["Nim"]); ?></td>
                                        <td><?= htmlspecialchars($o["username"]); ?></td>
                                        <td><?= htmlspecialchars($o["nama_kategori"]); ?></td>
                                        <td><?= htmlspecialchars($o["deskripsi"]); ?></td>
                                        <td><?= htmlspecialchars($o["lokasi"]); ?></td>
                                        <td><?= htmlspecialchars($o["status"]); ?></td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-sm setujui-btn" data-id="<?= htmlspecialchars($o['id_keluhan']); ?>" data-bs-toggle="modal" data-bs-target="#editModal">Setujui</a>
                                            <a href="../proses_admin/hapus_keluhan.php?id_keluhan=<?= htmlspecialchars($o['id_keluhan']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Tolak</a>
                                        </td>
                                        <td><?= htmlspecialchars($o["tgl_keluhan"]); ?></td>
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
                                <?php endif; 
                                $counter++;
                            endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php endfor;
        else: ?>
            <p class="text-center">
                <?= !empty($search) 
                    ? "Tidak Ada Mahasiswa Yang Mengeluh Dalam Pencarian \"" . htmlspecialchars($search) . "\" " 
                    : "Tidak ada data ditemukan."; ?>
            </p>
        <?php endif; ?>
    </div>

    <!-- Navigasi Halaman -->
    <div class="pagination mt-3 d-flex justify-content-center gap-2">
    <?php if (!empty($data) && $data->num_rows > 0): ?>
            <?php for ($page = 1; $page <= $totalPages; $page++): ?>
        <button class="btn btn-secondary page-button" data-page="<?= $page; ?>"><?= $page; ?>
        </button>
            <?php endfor; ?>
    <?php else: ?>
        <p class="text-center">Data tidak ditemukan untuk pencarian "<?php echo htmlspecialchars($search); ?>"</p>
    <?php endif; ?>
</div>

</div>









 <!-- //modal Edit// -->
 <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Setuju Keluhan Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="../proses_admin/proces_respon.php" method="POST">
    <input type="hidden" id="keluhanId" name="keluhanId">
    <div class="mb-3">
        <label for="response" class="form-label">Ubah Berikan Tanggapan</label>
        <input type="text" class="form-control" id="response" name="response" required autocomplete="off">
    </div>
    <button type="submit" class="btn btn-primary">Setujui</button>
</form>

        </div>

<!-- Tombol Setujui dan Tolak di Tabel
<td>
<a href="#" class="btn btn-primary btn-sm setujui-btn" data-id="<?= $o['id_keluhan']; ?>" data-bs-toggle="modal" data-bs-target="#editModal">Setujui</a>

    <a href="hapus_keluhan.php?id_keluhan=<?= $o['id_keluhan']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tolak Keluhan Mahasiswa')">Tolak</a>
</td> -->

<script>
document.addEventListener("DOMContentLoaded", function() {
    const setujuiButtons = document.querySelectorAll('.setujui-btn');
    setujuiButtons.forEach(button => {
        button.addEventListener('click', function() {
            const keluhanId = this.getAttribute('data-id');
            document.getElementById('keluhanId').value = keluhanId; // Set nilai keluhanId
            console.log("ID Keluhan:", keluhanId); // Debug: pastikan ID keluhan ditampilkan di console
        });
    });
});

</script>

<!-- button sebagai navigasi -->
<script>
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
        