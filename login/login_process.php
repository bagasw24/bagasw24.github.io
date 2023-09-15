<?php
session_start();
$servername = "localhost";
$username = "ppkpi";
$password = "ppkpi";
$database = "pgmf";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
  die("Koneksi gagal: " . $koneksi->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Query untuk memeriksa kecocokan username dan password di database
  $query = "SELECT * FROM pengguna WHERE username = '$username'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row['password'])) {
      // Login berhasil, simpan informasi pengguna dalam sesi
      $_SESSION['username'] = $username;
      $_SESSION['id'] = $row['id'];

      // Redirect ke halaman selamat datang atau beranda
      header("Location: ../admin/admin_panel.php");
      exit();
    } else {
      // Password salah
      echo "Password salah. Silakan coba lagi.";
    }
  } else {
    // Pengguna tidak ditemukan
    echo "Username tidak ditemukan. Silakan coba lagi.";
  }
}
?>