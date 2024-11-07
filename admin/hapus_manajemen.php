<?php
require '../koneksi.php';  // Pastikan koneksi ke database sudah benar

// Cek apakah Nim ada di URL
if (isset($_GET['Nim'])) {
    $Nim = $_GET['Nim'];

    // Siapkan query untuk menghapus data
    $sql = "DELETE FROM mahasiswa WHERE Nim = ?";
    $stmt = $koneksi->prepare($sql);

    // Gunakan "s" jika Nim adalah string
    $stmt->bind_param("s", $Nim);

    // Eksekusi query
    if ($stmt->execute()) {
        // Redirect ke halaman yang sesuai setelah hapus sukses
        header("Location: manajemen.php"); // Ganti dengan halaman yang sesuai
        exit();
    } else {
        echo "Gagal menghapus data. Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID tidak ditemukan.";
}

$koneksi->close();
?>
