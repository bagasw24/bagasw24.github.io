<header class="header">

   <div class="flex">

      <a href="#" class="logo">CoffeShop Nice&Beast</a>
      

      <nav class="navbar">
         <a href="../homepage/index.html">Home</a>
         <a href="menu.php">Menu</a>
      </nav>

      <?php
      
      $select_rows = mysqli_query($conn, "SELECT * FROM `order`") or die('query failed');
      $row_count = mysqli_num_rows($select_rows);

      ?>

      <a href="cart.php" class="cart">Order <span><?php echo $row_count; ?></span> </a>

      <div id="menu-btn" class="fas fa-bars"></div>

   </div>

</header>