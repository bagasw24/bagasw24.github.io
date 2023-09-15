<?php 
    $servername = "localhost";
    $username = "ppkpi";
    $password = "ppkpi";
    $database = "pgmf";
    
    $koneksi = new mysqli($servername, $username, $password, $database);
    
    if ($koneksi->connect_error) {
        die("Koneksi gagal: " . $koneksi->connect_error);
    }

    $idToDelete = $_GET['id'];

    $query = "SELECT * FROM list_menu WHERE idlist_menu = '$idToDelete'";
    $data = mysqli_query($koneksi, $query);

    if ($data) {
        $row = mysqli_fetch_array($data);

        $foto = $row['foto'];

        if (file_exists('../file_foto/' . $foto)) {
            unlink('../file_foto/' . $foto);
        }

        $deleteQuery = "DELETE FROM list_menu WHERE idlist_menu = '$idToDelete'";
        mysqli_query($koneksi, $deleteQuery) or die("SQL Error: " . mysqli_error($koneksi));

        header('location:admin_panel.php');
    } else {
        die("SQL Error: " . mysqli_error($koneksi));
    }
?>
