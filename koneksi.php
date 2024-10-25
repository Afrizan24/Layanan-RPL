<?php
// Konfigurasi koneksi ke database
$host = "localhost"; // Host MySQL
$username = "root"; // Username MySQL
$password = ""; // Password MySQL
$database = "projectkeluhan"; // Nama Database

// Buat koneksi ke database
$koneksi = mysqli_connect($host, $username, $password, $database);

// Periksa koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Jika koneksi berhasil
/* echo "Koneksi ke database berhasil"; */
?>