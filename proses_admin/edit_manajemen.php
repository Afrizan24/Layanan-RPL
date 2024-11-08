<?php
require '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nim = $_POST['nim'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validasi data
    if (!empty($nim) && !empty($username) && !empty($password)) {
        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Siapkan pernyataan SQL untuk memperbarui data mahasiswa
        $stmt = $koneksi->prepare("UPDATE mahasiswa SET username = ?, password = ? WHERE Nim = ?");
        $stmt->bind_param("ssi", $username, $hashedPassword, $nim);

        // Eksekusi statement
        if ($stmt->execute()) {
            // Redirect kembali ke halaman admin setelah berhasil
            header("Location: ../admin/manajemen.php");
            exit();
        } else {
            echo "Terjadi kesalahan: " . $stmt->error;
        }

        // Tutup statement
        $stmt->close();
    } else {
        echo "Semua field harus diisi.";
    }
}

// Tutup koneksi
$koneksi->close();
?>
