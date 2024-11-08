<?php
session_start();
require '../koneksi.php'; // Include file konfigurasi database

// Ambil data dari form
$nim = $_POST['Nim'];
$username = $_POST['username'];
$password = $_POST['password'];

// Prepare and bind
$stmt = $koneksi->prepare("SELECT * FROM mahasiswa WHERE Nim = ? && username = ?");
$stmt->bind_param("ss", $nim,$username);

// Execute the statement
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc(); // Ambil data pengguna
    $id = $user['id_mhs'];

    // Periksa hashed password
    if (password_verify($password, $user['password'])) {
        // Login successful
        $_SESSION['username'] = $username; // Store NIM in session
        $_SESSION['Nim'] = $nim;
        $_SESSION['id_mhs'] = $id;
        
        // Redirect to index.php
        $redirectUrl = "../beranda";
        $redirectUrl .= "?user=" . urlencode($_SESSION['username']);
        header("Location: " . $redirectUrl);
        exit();
    } else {
        // Password tidak valid
        $_SESSION['error'] = "Invalid NIM or password."; // Set error message
        header("Location: ../halaman/login.php"); // Redirect back to login page
        exit();
    }
} else {
    // NIM tidak ditemukan
    $_SESSION['error'] = "Invalid NIM or password."; // Set error message
    header("Location: ../halaman/login.php"); // Redirect back to login page
    exit();
}

// Close connections
$stmt->close();
$koneksi->close();
?>
