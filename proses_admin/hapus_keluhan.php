<?php
session_start();
require '../koneksi.php';
if (!isset($_SESSION['username'])) {
    echo "<script>alert('Admin harus login terlebih dahulu');</script>";
    echo "<script>window.location.href = '../admin/indexadmin.php';</script>";
    exit();
}
// Cek apakah id_keluhan ada di URL
if (isset($_GET['id_keluhan'])) {
    $id_keluhan = $_GET['id_keluhan'];

    // Siapkan query untuk menghapus data keluhan
    $sql = "DELETE FROM keluhan WHERE id_keluhan = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("i", $id_keluhan); // Binding ID keluhan yang diterima

    // Eksekusi query
    if ($stmt->execute()) {
        // Redirect ke halaman yang sesuai setelah hapus sukses
        header("Location: keluhan.php"); // Ganti dengan halaman yang sesuai
        exit();
    } else {
        echo "Gagal menghapus keluhan. Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID keluhan tidak ditemukan.";
}

$koneksi->close();
?>
