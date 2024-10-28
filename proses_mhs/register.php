<?php
require '../koneksi.php'; 
$nim = $_POST['Nim'];
$name = $_POST['username'];
$pass = $_POST['password'];

    // Hash password
$hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

    // Validasi input (pastikan tidak kosong)
if (!empty($name) && !empty($pass)) {
        // Siapkan statement untuk mencegah SQL injection
    $stmt = $koneksi->prepare("INSERT INTO mahasiswa (Nim,username,password) VALUES (?, ?, ?)");
    $stmt->bind_param("iss",$nim, $name, $hashed_pass);

        // Eksekusi statement
    if ($stmt->execute()) {
        header("Location: ../halaman/login.php"); // Redirect ke halaman login
        exit();
        } else {
            $error = "Username sudah terdaftar.";
        }

        // Tutup statement
        $stmt->close();
    } else {
        $error = "Semua field harus diisi.";
    }

// Tutup koneksi
$koneksi->close();
?>