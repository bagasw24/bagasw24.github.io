<?php

$servername = "localhost";
$database = "pgmf";
$username = "ppkpi";
$password = "ppkpi";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die ("Koneksi Gagal Ke Database" . mysqli_connect_error());
}   else {
    echo "";
}
