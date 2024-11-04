<?php
require '../koneksi.php'; 

$nim = $_POST['Nim'];
$name = $_POST['username'];
$pass = $_POST['password'];

// Hash password
$hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

// Validasi input (pastikan tidak kosong)
if (!empty($name) && !empty($pass) && !empty($nim)) {
    // Siapkan statement untuk mencegah SQL injection
    $stmt = $koneksi->prepare("INSERT INTO mahasiswa (Nim, username, password) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $nim, $name, $hashed_pass);

    // Eksekusi statement
    if ($stmt->execute()) {
        // Tampilkan pesan jika register berhasil
        echo "<script>
                alert('Register berhasil! Silakan login kembali.');
                window.location.href = '../halaman/login.php'; // Redirect ke halaman login
              </script>";
    } else {
        // Tampilkan pesan jika register gagal, misalnya karena username sudah terdaftar
        echo "<script>
                alert('Register gagal Username/Nim sudah terdaftar.');
                window.history.back();
              </script>";
    }

    
    $stmt->close();
} else {
    // Tampilkan pesan jika semua field belum diisi
    echo "<script>
            alert('Register gagal: Semua field harus diisi.');
            window.history.back();
          </script>";
}

// Tutup koneksi
$koneksi->close();
?>
