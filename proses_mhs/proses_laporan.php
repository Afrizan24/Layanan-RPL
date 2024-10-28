<?php
session_start();
require '../koneksi.php';
if (!isset($_SESSION['username'])) {
    header("Location: ../beranda.php"); 
    exit();
}
$id_kategori_keluhan = $_POST['id_kategori_keluhan'];
$lokasi = $_POST['lokasi'];
$month = $_POST['month'];
$day = $_POST['day'];
$year = $_POST['year'];
$deskripsi = $_POST['deskripsi'];

// Ambil NIM dari session
$nim = $_SESSION['username']; // Pastikan NIM sudah disimpan dalam session
$id = $_SESSION ['id_mhs'];

// Validasi dan sanitasi input
if (!empty($id_kategori_keluhan) && !empty($deskripsi) && !empty($nim)) {
    $tanggal = "$year-$month-$day"; // Format tanggal

    // Siapkan dan eksekusi pernyataan
    $stmt = $koneksi->prepare("INSERT INTO keluhan (id_mhs, id_kategori_keluhan, deskripsi, lokasi, status, tanggapan, tgl_keluhan) VALUES (?, ?, ?, ?, 'Proses', '', ?)");
    $stmt->bind_param("iisss", $id, $id_kategori_keluhan, $deskripsi, $lokasi, $tanggal);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Keluhan berhasil dikirim!";
        header("Location: ../beranda.php"); // Ganti dengan URL beranda Anda
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