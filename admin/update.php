<?php
$servername = "localhost";
$username = "ppkpi";
$password = "ppkpi";
$database = "pgmf";

$koneksi = new mysqli($servername, $username, $password, $database);

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

$id = $_GET['edit'];

if (isset($_POST['update_product'])) {
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
        $update_data = "UPDATE list_menu SET nama_menu='$nama', harga_menu='$harga', desc_menu='$desc' ,foto='$foto'  WHERE idlist_menu = '$id'";
        $upload = mysqli_query($koneksi, $update_data);
       
        if ($upload) {
            move_uploaded_file($foto, $file_tmp);
            header('location:admin_panel.php');
        } else {
            $message[] = 'Tolong Diisi Semuanya';
        }
    }
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php
    if (isset($message)) {
        foreach ($message as $message) {
            echo '<span class="message">' . $message . '</span>';
        }
    }
    ?>

    <div class="container">


        <div class="admin-product-form-container centered">

            <?php

            $select = mysqli_query($koneksi, "SELECT * FROM list_menu WHERE idlist_menu = '$id'");
            while ($row = mysqli_fetch_assoc($select)) {

            ?>

                <form action="" method="post" enctype="multipart/form-data">
                    <h3 class="title">update the product</h3>
                    <input type="text" class="box" name="nama_menu" value="<?php echo $row['nama_menu']; ?>" placeholder="Ubah Nama">
                    <input type="text" class="box" name="desc_menu" value="<?php echo $row['desc_menu']; ?>" placeholder="Ubah Deskripsi">
                    <input type="number" min="0" class="box" name="harga_menu" value="<?php echo $row['harga_menu']; ?>" placeholder="Ubah Harga">
                    <input type="file" class="box" name="foto" accept="image/png, image/jpeg, image/jpg">
                    <input type="submit" value="update product" name="update_product" class="btn">
                    <a href="admin_panel.php" class="btn">Kembali</a>
                </form>



            <?php }; ?>



        </div>

    </div>

</body>

</html>