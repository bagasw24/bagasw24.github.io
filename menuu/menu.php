<?php

$servername = "localhost";
$username = "ppkpi";
$password = "ppkpi";
$database = "pgmf";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
  die("Koneksi gagal: " . $koneksi->connect_error);
}

if(isset($_POST['add_to_cart'])){

    $nama = $_POST['nama_menu'];
    $harga = $_POST['harga_menu'];
    $foto = $_POST['foto'];
    $quantity = 1;

    $select_cart = mysqli_query($conn, "SELECT * FROM `order` WHERE nama_menu = '$nama'");

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'Produk sudah ditambahkan';
   }else{
      $insert_product = mysqli_query($conn, "INSERT INTO `order`(nama_menu, harga_menu, foto, qty_menu) VALUES('$nama', '$harga', '$foto', '$quantity')");
      $message[] = 'Produk berhasil ditambahkan';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Order</title>
   <link rel="icon" href="../foto/icon.png" />
   <link rel="stylesheet" href="../bootstrap-5.3.1-dist/css/bootstrap.min.css">
   <link rel="stylesheet" href="style.css">
</head>
<body>
   
<?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>

<?php include 'header.php'; ?>

<div class="container">

<section class="products">

   <h1 class="heading">Order Disini</h1>

   <div class="box-container">

      <?php
      
      $select_products = mysqli_query($conn, "SELECT * FROM `list_menu`");
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
      ?>

      <form action="" method="post">
         <div class="box">
            <img src="../file_foto/<?php echo $fetch_product['foto']; ?>" alt="">
            <h3><?php echo  $fetch_product['nama_menu']; ?></h3>
            <div class="price">Rp <?php echo number_format($fetch_product['harga_menu'], 0); ?></div>
            <input type="hidden" name="nama_menu" value="<?php echo $fetch_product['nama_menu']; ?>">
            <input type="hidden" name="harga_menu" value="<?php echo $fetch_product['harga_menu']; ?>">
            <input type="hidden" name="foto" value="<?php echo $fetch_product['foto']; ?>">
            <input type="submit" class="btn" value="add to cart" name="add_to_cart">
         </div>
      </form>

      <?php
         };
      };
      ?>

   </div>

</section>

</div>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>