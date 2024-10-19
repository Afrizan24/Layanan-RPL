<?php
session_start();
require '../koneksi.php'; // Include file konfigurasi database

// Ambil data dari form
$nim = $_POST['username'];
$password = $_POST['password'];

// Prepare and bind
$stmt = $koneksi->prepare("SELECT * FROM mahasiswa WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $nim, $password);

// Execute the statement
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Login successful
    $_SESSION['username'] = $nim; // Store NIM in session
    
    // Redirect to index.php
    header("Location:../beranda.php");
} else {
    // Login failed
    $_SESSION['error'] = "Invalid NIM or password."; // Set error message
    header("Location: ../halaman/login.php"); // Redirect back to login page
    exit();
}

// Close connections
$stmt->close();
$koneksi->close();
?>
