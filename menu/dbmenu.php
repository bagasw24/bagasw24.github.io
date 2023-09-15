<?php

$servername = "localhost";
$database = "pgmf";
$username = "ppkpi";
$password = "ppkpi";

$conn = new mysqli($servername, $username, $password, $database);

if (!$conn) {
    die ("Koneksi Gagal Ke Database" . mysqli_connect_error());
}   else {
    echo "";
}
