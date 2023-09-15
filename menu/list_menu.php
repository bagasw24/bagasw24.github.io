<?php

//Untuk connect ke database
$servername = "localhost";
$database = "pgmf";
$username = "ppkpi";
$password = "ppkpi";
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

// Untuk periksa koneksi
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit();
}

 $query = "SELECT nama_menu, desc_menu, harga_menu FROM list_menu";
 $result = mysqli_query($conn, $query);
 
