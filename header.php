<?php
//include_once "config.php";
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <div class="header-1">
      <div class="flex">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <p> new <a href="login.php">login</a> | <a href="register.php">register</a> </p>
      </div>
   </div>

   <div class="header-2">
      <div class="flex">
         <a href="index.php" class="logo">Wellfood</a>

         <nav class="navbar">
            <a href="index.php">home</a>
            <a href="about.php">about</a>
            <a href="shop.php">shop</a>
            <a href="contact.php">contact</a>
            <a href="orders.php">orders</a>
         </nav>


         <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="search_page.php" class="fas fa-search"></a>
            <div id="user-btn" class="fas fa-user"></div>
            <?php
            $flag = false;
            if(isset($_SESSION["user_id"])){
                $user_id = $_SESSION["user_id"];
                $username = $_SESSION["user_name"];
                $useremail = $_SESSION["user_email"];
                $button_url="logout.php"; $button_name="LOGOUT";
                $flag = true;
            }
            else{
                $user_id = NULL;
            }
            $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
               if(isset($select_cart_number)){
                   $cart_rows_number = mysqli_num_rows($select_cart_number);
               }
            ?>
            <a href="cart.php"> <i class="fas fa-shopping-cart"></i> <span>(<?php echo $cart_rows_number; ?>)</span> </a>
         </div>

         <div class="user-box">
             <?php
             if(!$flag){
                 $username = "No Data Available!";
                 $useremail = "No Data Available!";
                 $button_url="login.php"; $button_name="LOGIN";
             }
             ?>
            <p>username : <span><?php echo $username; ?></span></p>
            <p>email : <span><?php echo $useremail; ?></span></p>
            <a href="<?=$button_url;?>" class="delete-btn"><?=$button_name;?></a>
         </div>
      </div>
   </div>

</header>