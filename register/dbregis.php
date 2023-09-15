<?php
// Koneksi ke database
$servername = "localhost";
$database = "pgmf";
$username = "ppkpi";
$password = "bagas";
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

// Memproses data yang diterima dari form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nama_awal = $_POST["nama_awal"];
  $nama_akhir = $_POST["nama_akhir"];
  $email = $_POST["email"];
  $username = $_POST["username"];
  $password = $_POST["password"];

  // Query untuk menyimpan data ke tabel pengguna
  $query = "INSERT INTO pengguna (nama_awal, nama_akhir, email, username, password) VALUES ('$nama_awal', '$nama_akhir', '$email', '$username', '$password')";

  if (mysqli_query($conn, $query)) {
    echo "Registrasi Berhasil";
    header("Location: ../login/login.html");
    exit();
  } else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
  }
}

mysqli_close($conn);
?>