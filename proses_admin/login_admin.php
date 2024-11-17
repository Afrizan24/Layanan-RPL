<?php
session_start();
require '../koneksi.php'; // Include file konfigurasi database

// Ambil data dari form
$username = $_POST['Username'];
$password = $_POST['Password'];

// Prepare and bind
$stmt = $koneksi->prepare("SELECT * FROM admin WHERE Username = ?");
$stmt->bind_param("s", $username);

// Execute the statement
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc(); // Ambil data pengguna

    // Periksa hashed password (Assuming password is stored using password_hash)
    if (password_verify($password, $user['Password'])) {
        // Login successful
        $_SESSION['username'] = $username; // Store Username in session
        $_SESSION['id_mhs'] = $user['id_mhs']; // Store User ID in session
        
        // Redirect to indexadmin.php
        header("Location: ../admin/indexadmin.php");
        exit();
    } else {
        // Password tidak valid
        $_SESSION['error'] = "Invalid Username or password."; // Set error message
        header("Location: ../admin/indexadmin.php"); // Redirect back to login page
        exit();
    }
} else {
    // Username tidak ditemukan
    $_SESSION['error'] = "Invalid Username or password."; // Set error message
    header("Location: ../admin/indexadmin.php"); // Redirect back to login page
    exit();
}

// Close connections
$stmt->close();
$koneksi->close();
?>
