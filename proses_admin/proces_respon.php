<?php
session_start();
require '../koneksi.php';
if (!isset($_SESSION['username'])) {
    echo "<script>alert('Admin harus login terlebih dahulu');</script>";
    echo "<script>window.location.href = '../admin/indexadmin.php';</script>";
    exit();
}
print_r($_POST); // Debug: Menampilkan data POST untuk memastikan keluhanId terkirim

// Cek apakah data terkirim
if (isset($_POST['keluhanId']) && isset($_POST['response'])) {
    $id = $_POST['keluhanId'];
    $tanggapan = $_POST['response'];
    $status = 'sudah';

    $sql = "UPDATE keluhan SET tanggapan = ?, status = ? WHERE id_keluhan = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("ssi", $tanggapan, $status, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Tanggapan berhasil dikirim dan status diubah menjadi Selesai!'); window.location.href = '../admin/keluhan.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan, silakan coba lagi.'); window.history.back();</script>";
    }

    $stmt->close();
    $koneksi->close();
} else {
    echo "<script>alert('ID keluhan atau tanggapan tidak ditemukan.'); window.history.back();</script>";
}
?>
