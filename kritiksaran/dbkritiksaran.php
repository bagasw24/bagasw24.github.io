<?php
// Koneksi ke database
$servername = "localhost";
$database = "pgmf";
$username = "ppkpi";
$password = "ppkpi";

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Memproses data dari form jika ada pengiriman data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama = $_POST["nama"];
    $email = $_POST["email"];
    $no_telpon = $_POST["no_telpon"];
    $pesan = $_POST["pesan"];

    // Validasi data jika diperlukan

    // Simpan data ke database
    $query = "INSERT INTO kritiksaran (nama, email, no_telpon, pesan) 
              VALUES ('$nama', '$email', '$no_telpon', '$pesan')";
    if (mysqli_query($conn, $query)) {
        header("Location: kritiksaran.html");
        echo "Pesan berhasil dikirim.";
    } else {
        echo "Terjadi kesalahan: " . mysqli_error($conn);
    }
}

// Tutup koneksi
mysqli_close($conn);
?>
