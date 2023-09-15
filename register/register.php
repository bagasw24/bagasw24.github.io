<?php
$servername = "localhost";
$username = "ppkpi";
$password = "ppkpi";
$database = "pgmf";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
  die("Koneksi gagal: " . $koneksi->connect_error);
}

// Define variables and set them to empty values
$nama_awal = $nama_akhir = $username = $email = $password = '';

// Process the form submission when the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the form data and sanitize it
  $nama_awal = sanitize($_POST['nama_awal']);
  $nama_akhir = sanitize($_POST['nama_akhir']);
  $username = sanitize($_POST['username']);
  $email = sanitize($_POST['email']);
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password for security

  // Insert the user data into the database
  $query = "INSERT INTO pengguna (nama_awal, nama_akhir, username, email, password) 
            VALUES ('$nama_awal', '$nama_akhir', '$username', '$email', '$password')";
  if (mysqli_query($conn, $query)) {
    echo 'Registration Berhasil!';
    header("Location: ../login/login.html");
    exit();
  } else {
    echo 'Registration failed. Error: ' . mysqli_error($conn);
  }
}

// Function to sanitize user input
function sanitize($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
