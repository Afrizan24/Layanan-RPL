<?php
session_start();
require '../koneksi.php'; // Include file konfigurasi database

// Ambil data dari form
$nim = $_POST['nim'];
$password = $_POST['pw'];

// Prepare and bind
$stmt = $koneksi->prepare("SELECT * FROM mahasiswa WHERE nim = ? AND password = ?");
$stmt->bind_param("ss", $nim, $password);

// Execute the statement
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Login successful
    $_SESSION['nim'] = $nim; // Store NIM in session
    
    // Redirect to index.php
    header("Location:../index.php");
} else {
    // Login failed
    echo "Invalid NIM or password.";
}

// Close connections
$stmt->close();
$koneksi->close();
?>
