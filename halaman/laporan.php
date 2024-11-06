<?php
// Ambil kategori dari URL

require './koneksi.php';
$username = isset($_SESSION['username']) ? $_SESSION['username'] : ''; // Ambil username dari session
$id_kategori_keluhan = isset($_GET['kategori']) ? $_GET['kategori'] : '';

// Query untuk menampilkan data keluhan, mahasiswa, dan kategori_keluhan
$sql_main = "SELECT m.NIM AS nim, m.username AS nama, k.deskripsi, k.lokasi, k.status, k.tanggapan, k.tgl_keluhan, 
                    cat.nama_kategori AS kategori
             FROM keluhan k
             JOIN mahasiswa m ON k.id_mhs = m.id_mhs
             JOIN kategori_keluhan cat ON k.id_kategori_keluhan = cat.id_kategori_keluhan
             WHERE m.username = ?"; // Tambahkan kondisi WHERE

// Siapkan pernyataan
$stmt = $koneksi->prepare($sql_main);
$stmt->bind_param("s", $username); // Bind parameter username
$stmt->execute();
$result_main = $stmt->get_result();

?>




<div id="isiLaporan">   
</div>
<script>
    window.onload = function() {
        if (window.location.hash) {
            const element = document.getElementById(window.location.hash.substring(1));
            if (element) {
                const navbarHeight = document.querySelector('.navbar').offsetHeight;
                const offset = 20;
                const elementPosition = element.getBoundingClientRect().top + window.scrollY - navbarHeight - offset;

                // Tambahkan timeout untuk memberikan sedikit delay
                setTimeout(() => {
                    window.scrollTo({
                        top: elementPosition,
                        behavior: 'smooth'
                    });
                }, 100); // 100ms delay
            }
        }
    };
</script>

<div class="services-title mt-3">
    <h1>Form Laporan</h1>
</div>
<!-- Laporan -->
<section class="complaint-form-section">
    <div class="container-custom">
        <div class="row align-items-center">
            <!-- Form -->
            <div class="col-lg-6 col-md-6">
                <h2 class="form-title">Formulir Keluhan</h2>
                <form action="proses_mhs/proses_laporan.php" method="POST"  enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="complaint" class="form-label">Pilih Keluhan</label>
                        <select class="form-select" id="complaint" name="id_kategori_keluhan" required onchange="toggleLocationInput()">
                            <option selected disabled>Pilih Keluhan</option>
                            <option value="1" <?= $id_kategori_keluhan == '1' ? 'selected' : ''; ?>>Fasilitas</option>
                            <option value="2" <?= $id_kategori_keluhan == '2' ? 'selected' : ''; ?>>SDM</option>
                            <option value="3" <?= $id_kategori_keluhan == '3' ? 'selected' : ''; ?>>Akademik</option>
                        </select>
                    </div>

                    <div class="mb-3" id="locationInput" style="display: <?= $id_kategori_keluhan == '1' ? 'block' : 'none'; ?>;">
                            <label for="location" class="form-label">Lokasi</label>
                            <input type="text" class="form-control" id="location" name="lokasi" placeholder="Lokasi">
                            <i class="bi bi-archive-fill"> 
                                 <input  type="file" name="gambar" accept="image/*"> </i>
                    </div>
                    
                  

                    <div class="mb-3">
                        <label for="date" class="form-label">Tanggal</label>
                        <div class="d-flex">
                            <select class="form-select me-2" id="month" name="month" required>
                                <option selected disabled>Bulan</option>
                                <?php for ($m = 1; $m <= 12; $m++): ?>
                                    <option value="<?= $m; ?>"><?= date('F', mktime(0, 0, 0, $m, 1)); ?></option>
                                <?php endfor; ?>
                            </select>
                            <select class="form-select me-2" id="day" name="day" required>
                                <option selected disabled>Hari</option>
                                <?php for ($d = 1; $d <= 31; $d++): ?>
                                    <option value="<?= $d; ?>"><?= $d; ?></option>
                                <?php endfor; ?>
                            </select>
                            <select class="form-select" id="year" name="year" required>
                                <option selected disabled>Tahun</option>
                                <?php for ($y = date('Y'); $y >= 2000; $y--): ?>
                                    <option value="<?= $y; ?>"><?= $y; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi *</label>
                        <textarea class="form-control" id="description" name="deskripsi" rows="4" required></textarea>
                    </div>

                    <button type="submit" class="animated-button">Kirim</button>
                </form>
            </div>

            <div class="col-lg-6 col-md-6 form-side-image" style="width: 200px;">
                <img src="src\img\LogoTI.png" alt="Side Image" style="width: 550px;"> 
            </div>

<!-- Main Content -->
<div class="content container my-5">
    <?php
    if (!isset($_SESSION['username'])) {
    } else {
    ?>
        <h2>Keluhan Anda</h2>
        <div class="table-responsive"> <!-- Menambahkan class table-responsive -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Kategori Keluhan</th>
                        <th>Deskripsi Anda</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                        <th>Tanggapan</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php if ($result_main && $result_main->num_rows > 0): ?>
                        <?php while ($o = $result_main->fetch_assoc()): ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $o["nim"]; ?></td>
                                <td><?= $o["nama"]; ?></td>
                                <td><?= $o["kategori"]; ?></td>
                                <td><?= $o["deskripsi"]; ?></td>
                                <td><?= $o["lokasi"]; ?></td>
                                <td><?= $o["status"]; ?></td>
                                <td><?= $o["tanggapan"]; ?></td>
                                <td><?= $o["tgl_keluhan"]; ?></td>
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
        </div> <!-- Menutup div.table-responsive -->
    <?php } // Tutup else ?>
</div>


        </div>
    </div>
</section>

<script>
    // Mengatur tanggal saat halaman dimuat
    window.onload = function() {
        const today = new Date();
        const month = today.getMonth() + 1; // Bulan mulai dari 0
        const day = today.getDate();
        const year = today.getFullYear();

        // Mengisi dropdown dengan nilai hari, bulan, dan tahun saat ini
        document.getElementById('month').value = month;
        document.getElementById('day').value = day;
        document.getElementById('year').value = year;

        // Inisialisasi untuk menyembunyikan atau menampilkan lokasi
        toggleLocationInput();
    };

    function toggleLocationInput() {
        const complaintSelect = document.getElementById('complaint');
        const locationInput = document.getElementById('locationInput');

        // Tampilkan input lokasi jika "Fasilitas" dipilih
        if (complaintSelect.value === '1') {
            locationInput.style.display = 'block';
        } else {
            locationInput.style.display = 'none';
        }
    }
</script>
