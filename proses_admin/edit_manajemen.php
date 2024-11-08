<?php
require '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])) {
    $original_nim = $_POST['original_nim']; // Get original Nim
    $nim = !empty($_POST['nim']) ? $_POST['nim'] : $original_nim; // Use the provided Nim or fallback
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password using PHP's password_hash function
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // You can use PASSWORD_BCRYPT or other options as well

    // Update query
    $query = "UPDATE mahasiswa SET Nim = ?, username = ?, password = ? WHERE Nim = ?";
    $stmt = mysqli_prepare($koneksi, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssss", $nim, $username, $hashed_password, $original_nim);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "Data mahasiswa berhasil diperbarui.";
        } else {
            echo "Tidak ada perubahan data.";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}
?>
