<?php

$servername = "localhost";
$username = "ppkpi";
$password = "ppkpi";
$database = "pgmf";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
  die("Koneksi gagal: " . $koneksi->connect_error);
}

if(isset($_POST['update_update_btn'])){
   $update_value = $_POST['update_quantity'];
   $update_id = $_POST['update_quantity_id'];
   $update_quantity_query = mysqli_query($conn, "UPDATE `order` SET qty_menu = '$update_value' WHERE id_order = '$update_id'");
   if($update_quantity_query){
      header('location:cart.php');
   };
};

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `order` WHERE id_order = '$remove_id'");
   header('location:cart.php');
};

if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `order`");
   header('location:cart.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Pesanan anda</title>
   <link rel="stylesheet" href="../bootstrap-5.3.1-dist/css/bootstrap.min.css">
   <link rel="stylesheet" href="style.css">
   <link rel="icon" href="../foto/icon.png" />

</head>
<body>

<?php include 'header.php'; ?>

<div class="container">

<section class="shopping-cart">

   <h1 class="heading">shopping cart</h1>

   <table>

      <thead>
         <th>Foto</th>
         <th>Nama Menu</th>
         <th>Harga</th>
         <th>Quantity</th>
         <th>Total Harga</th>
         <th>action</th>
      </thead>

      <tbody>

         <?php 
         
         $select_cart = mysqli_query($conn, "SELECT * FROM `order`");
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
         ?>

         <tr>
            <td><img src="../file_foto/<?php echo $fetch_cart['foto']; ?>" height="100" alt=""></td>
            <td><?php echo $fetch_cart['nama_menu']; ?></td>
            <td>$<?php echo number_format($fetch_cart['harga_menu']); ?>/-</td>
            <td>
               <form action="" method="post">
                  <input type="hidden" name="update_quantity_id"  value="<?php echo $fetch_cart['id_order']; ?>" >
                  <input type="number" name="update_quantity" min="1"  value="<?php echo $fetch_cart['qty_menu']; ?>" >
                  <input type="submit" value="update" name="update_update_btn">
               </form>   
            </td>
            <td>$<?php echo $sub_total = floatval($fetch_cart['harga_menu'] * $fetch_cart['qty_menu']); ?>/-</td>
            <td><a href="cart.php?remove=<?php echo $fetch_cart['id_order']; ?>" onclick="return confirm('Apakah anda ingin menghapus menu ini?')" class="delete-btn"> <i class="fas fa-trash"></i> Hapus</a></td>
         </tr>
         <?php
           $grand_total += floatval($sub_total); 
            };
         };
         ?>
         <tr class="table-bottom">
            <td><a href="menu.php" class="option-btn" style="margin-top: 0;">Continue shopping</a></td>
            <td colspan="3">Total</td>
            <td>$<?php echo $grand_total; ?>/-</td>
            <td><a href="cart.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="delete-btn"> <i class="fas fa-trash"></i> delete all </a></td>
         </tr>

      </tbody>

   </table>

   <div class="checkout-btn">
      <a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">Bayar sekarang</a>
   </div>

</section>

</div>
   
<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>