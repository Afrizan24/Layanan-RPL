<?php
session_start();
require '../koneksi.php';
if (!isset($_SESSION['username'])) {
    header("Location: ../beranda"); 
    exit();
}

$id_kategori_keluhan = $_POST['id_kategori_keluhan'];
$lokasi = $_POST['lokasi'];
$month = $_POST['month'];
$day = $_POST['day'];
$year = $_POST['year'];
$deskripsi = $_POST['deskripsi'];
$nim = $_SESSION['username'];
$id = $_SESSION['id_mhs'];

// Validasi dan sanitasi input
if (!empty($id_kategori_keluhan) && !empty($deskripsi) && !empty($nim)) {
    $tanggal = "$year-$month-$day"; // Format tanggal

    // Upload gambar
    $nama_gambar = "";
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $nama_gambar = time() . "_" . basename($_FILES['gambar']['name']);

        $target_dir = "../src/img"; // Direktori untuk menyimpan gambar
        $target_file = $target_dir . $nama_gambar;
        
        
        // Pindahkan gambar ke folder target
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
            // Upload sukses, simpan nama file di database nanti
        } else {
            echo "Gagal mengunggah gambar!";
            exit();
        }
    } elseif (isset($_FILES['gambar']) && $_FILES['gambar']['error'] !== UPLOAD_ERR_NO_FILE) {
        echo "Terjadi kesalahan saat mengunggah gambar.";
        exit();
    }

    // Siapkan dan eksekusi pernyataan
    $stmt = $koneksi->prepare("INSERT INTO keluhan (id_mhs, id_kategori_keluhan, deskripsi, lokasi, status, tanggapan, tgl_keluhan, gambar) VALUES (?, ?, ?, ?, 'Proses', '', ?, ?)");
    $stmt->bind_param("iissss", $id, $id_kategori_keluhan, $deskripsi, $lokasi, $tanggal, $nama_gambar);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Keluhan berhasil dikirim!";
        header("Location: ../beranda");
        exit();
    } else {
        echo "Kesalahan: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Semua kolom harus diisi!";
}

$koneksi->close();
?>
