<?php
$servername = "localhost";
$username = "ppkpi";
$password = "ppkpi";
$database = "pgmf";

$koneksi = new mysqli($servername, $username, $password, $database);

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

if (isset($_POST['add_product'])) {
    $nama = $_POST['nama_menu'];
    $harga = $_POST['harga_menu'];
    $desc = $_POST['desc_menu'];
    $foto = $_FILES['foto']['name'];
    $file_tmp = $_FILES['foto']['tmp_name'];

    if (!is_numeric($harga)) {
        die("Harga harus berupa angka.");
    }
    move_uploaded_file($file_tmp, '../file_foto/' . $foto);

    if (empty($nama) || empty($harga) || empty($desc) || empty($foto)) {
        $message[] = 'Tolong Diisi Semuanya!';
    } else {
        $query = "INSERT INTO list_menu (nama_menu, foto, harga_menu, desc_menu) VALUES ('$nama', '$foto', '$harga', '$desc')";
        $upload = mysqli_query($koneksi, $query);
        if ($upload) {
            move_uploaded_file($foto, $file_tmp);
            $message[] = 'new product added successfully';
        } else {
            $message[] = 'could not add the product';
        }
    }
};

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($koneksi, "DELETE FROM list_menu WHERE idlist_menu = $id");
    header('location:admin_panel.php');
};
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin page</title>
    <link rel="stylesheet" href="../bootstrap-5.3.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
<a href="../menu/menu.html" class="btn"> <i class="fas fa-edit"></i> Kembali </a>
    <?php

    if (isset($message)) {
        foreach ($message as $message) {
            echo '<span class="message">' . $message . '</span>';
        }
    }

    ?>

    <div class="container">

        <div class="admin-product-form-container">

            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                <h3>add a new product</h3>
                <input type="text" placeholder="Tambahkan Produk" name="nama_menu" class="box">
                <input type="text" placeholder="Berikan Deskripsi" name="desc_menu" class="box">
                <input type="number" placeholder="Tambahkan Harga" name="harga_menu" class="box">
                <input type="file" accept="image/png, image/jpeg, image/jpg" name="foto" class="box">
                <input type="submit" class="btn" name="add_product" value="Tambahkan Produk">
            </form>

            <?php

            $select = mysqli_query($koneksi, "SELECT * FROM list_menu");

            ?>

        </div>
        <div class="product-display">
            <table class="product-display-table">
                <thead>
                    <tr>
                        <th>Foto Produk</th>
                        <th>Nama Produk</th>
                        <th>Deskripsi Produk</th>
                        <th>Harga Produk</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tr>
                    <?php while ($row = mysqli_fetch_assoc($select)) { ?>
                        <td><img src="../file_foto/<?php echo $row['foto']; ?>" height="100" alt="" </td>
                        <td><?php echo $row['nama_menu']; ?></td>
                        <td><?php echo $row['desc_menu']; ?></td>
                        <td><?php echo $row['harga_menu']; ?></td>
                        <td>
                            <a href="update.php?edit=<?php echo $row['idlist_menu']; ?>" class="btn"> <i class="fas fa-edit"></i> edit </a>
                            <a href="delete.php?id=<?php echo $row['idlist_menu']; ?>" class="btn"> <i class="fas fa-trash"></i> delete </a>
                        </td>
                </tr>
            <?php } ?>
            </table>
        </div>

    </div>


</body>

</html>