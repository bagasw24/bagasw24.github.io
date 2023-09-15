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


// Periksa koneksi
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit();
}

// Ambil data dari form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
   
$nama = $_POST["name"];
$email = $_POST["email"];
$no_telpon = $_POST["no_telpon"];   
$jumlah_order = $_POST["jumlah_order"];
$orderan = $_POST["orderan"];   
$alamat = $_POST["alamat"];

// Query untuk menyimpan data pesanan ke dalam tabel "orders" 
$query = "INSERT INTO menu (nama, email, no_telpon, jumlah_order, orderan, alamat) 
              VALUES ('$nama', '$email', '$no_telpon', '$jumlah_order', '$orderan', '$alamat')";

// Eksekusi query   
if (mysqli_query($conn, $query)) {
        echo "Pesanan Anda Sudah DiSiapkan Silahkan Ditunggu.";
        header("Location: menu.html");
        exit();
    } else {
               
echo "Terjadi kesalahan: " . mysqli_error($conn);
    }
}

// Tutup koneksi
mysqli_close($conn);
?>