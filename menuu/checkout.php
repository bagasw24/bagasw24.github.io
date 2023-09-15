<?php

$servername = "localhost";
$username = "ppkpi";
$password = "ppkpi";
$database = "pgmf";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
  die("Koneksi gagal: " . $koneksi->connect_error);
}

if(isset($_POST['order_btn'])){

   $name = $_POST['nama_lengkap'];
   $number = $_POST['no_telpon'];
   $email = $_POST['email'];
   $method = $_POST['metode_pembayaran'];
   $alamat = $_POST['alamat'];

   $cart_query = mysqli_query($conn, "SELECT * FROM `order`");
   $total_harga = 0;
   if(mysqli_num_rows($cart_query) > 0){
      while($product_item = mysqli_fetch_assoc($cart_query)){
         $product_name[] = $product_item['nama_menu'] .' ('. $product_item['qty_menu'] .') ';
         $product_price = floatval($product_item['harga_menu'] * $product_item['qty_menu']);
         $total_harga += $product_price;
      };
   };

   $total_menu = implode(', ',$product_name);
   $detail_query = mysqli_query($conn, "INSERT INTO `checkout`(nama_lengkap, no_telpon, email, metode_pembayaran, alamat, total_menu, total_harga) VALUES('$name','$number','$email','$method','$alamat','$total_menu','$total_harga')") or die('query failed');

   if($cart_query && $detail_query){
      echo "
      <div class='order-message-container'>
      <div class='message-container'>
         <h3>Terima kasih sudah membeli!</h3>
         <div class='order-detail'>
            <span>".$total_menu."</span>
            <span class='total'> total : $".$total_harga."/-  </span>
         </div>
         <div class='customer-details'>
            <p> Nama  : <span>".$name."</span> </p>
            <p> No telpon : <span>".$number."</span> </p>
            <p> Email : <span>".$email."</span> </p>
            <p> Alamat : <span>".$alamat."</span> </p>
            <p> payment : <span>".$method."</span> </p>
            <p>Silahkan bayar dikasir</p>
         </div>
         <a href='menu.php' class='btn' onclick=\"return confirm('Silahkan cek kembali')\">Pesan</a>
         </div>
      </div>
      ";
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="../bootstrap-5.3.1-dist/css/bootstrap.css">
   <link rel="icon" href="../foto/icon.png" />
   <link rel="stylesheet" href="style.css">

</head>
<body>

<?php include 'header.php'; ?>

<div class="container">

<section class="checkout-form">

   <h1 class="heading">Orderan anda</h1>

   <form action="" method="post">

   <div class="display-order">
      <?php
         $select_cart = mysqli_query($conn, "SELECT * FROM `order`");
         $total = 0;
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_harga = floatval($fetch_cart['harga_menu'] * $fetch_cart['qty_menu']);
            $grand_total = $total += $total_harga;
      ?>
      <span><?= $fetch_cart['nama_menu']; ?>(<?= $fetch_cart['qty_menu']; ?>)</span>
      <?php
         }
      }else{
         echo "<div class='display-order'><span>your cart is empty!</span></div>";
      }
      ?>
      <span class="grand-total"> grand total : $<?= $grand_total; ?>/- </span>
   </div>

      <div class="flex">
         <div class="inputBox">
            <span>Nama Lengkap</span>
            <input type="text" placeholder="Tuliskan nama anda" name="nama_lengkap" required>
         </div>
         <div class="inputBox">
            <span>Nomor Telpon</span>
            <input type="number" placeholder="Tuliskan nomor telpon" name="no_telpon" required>
         </div>
         <div class="inputBox">
            <span>Email</span>
            <input type="email" placeholder="Tuliskan email anda" name="email" required>
         </div>
         <div class="inputBox">
            <span>Methode Pembayaran</span>
            <select name="metode_pembayaran">
               <option value="Pilih Pembayaran" disabled selected>Pilih Pembayaran</option>
               <option value="cash on delivery">Tunai</option>
               <option value="credit cart">Kartu Kredit</option>
            </select>
         </div>
         <div class="inputBox">
            <span>Alamat</span>
            <input type="text" placeholder="Tuliskan alamat anda" name="alamat">
         </div>
      </div>
      <input type="submit" value="Order sekarang" name="order_btn" class="btn">
   </form>

</section>

</div>

<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>