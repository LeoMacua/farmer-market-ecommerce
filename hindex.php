<!--connect to database-->
<?php
    include("/xampp/htdocs/trials/includes/connect.php");
    include("/xampp/htdocs/trials/functions/common_function.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shamba Connect</title>
    <link rel="stylesheet" href="main.css" />
    <style>
     #button{
    width: 40%;
    background-color: none;
    color: black;
    padding: 5px;
    font-size: small;
    border-radius: 7px;}
    </style>
    
  </head>
  <body>
    <!--header section-->

    <header>
      <div id="header">
        <div class="header-logo">
          <a href="index.php"><img src="images\logo.png" alt="" /></a>
        </div>

        <!-- Modify the search_box section to include a form -->
<div class="search_box">
    <form action="searchproduct.php" method="GET">
        <input type="search" placeholder="Search" name="search_data">
        <input type="submit" id="button" value="Search" name="search_data_product"/>
    </form>
</div>


        <div class="header-list">
          <nav class="header-list-nav">
            <ul>
              <li><a class="active" href="hindex.php">Home</a></li>
              <li><a href="categories.php">Categories</a></li>
              <li><a href="product.php">Products</a></li>
              <li><a href="/users/cart.php">Cart</a></li>
              <li><a href="/users/login.php">Login</a></li>
              <li><a href="/users/signup.php">Sign up</a></li>
            </ul>
          </nav> 
        </div>
      </div>
    </header>

    <!--main section-->

    <main>
      <section class="product-section" class="section-p1">
        <h1>Featured Products</h1>
        <div class="pro-collection">
          <!--fetch products from database-->
          <?php
          
          if(!isset($_GET['category'])){

            $select_query = "SELECT * FROM product order by rand() limit 0,9"; 
                $result_query = mysqli_query($conn,$select_query);
                while($row_data=mysqli_fetch_assoc($result_query)){
                  $product_id=$row_data['product_id'];
                  $product_title=$row_data['product_title'];
                  $product_description=$row_data['product_description']; 
                  $product_image=$row_data['product_image'];
                  $product_price=$row_data['product_price'];
    
                  echo " <div class='product-cart'>
                  <a href='productdetails.php?id=$product_id'>
                    <img src='./admin/product_images/$product_image' alt='product_title'/>
                    <span>$product_description</span>
                    <h4>$product_title</h4>
                    <h4 class='price'>Ksh$product_price</h4>
                    <span class='buy-icon'>&#128722;</span>
                   </a>
                </div>";
              }
            }

          ?>
        </div>
      </section>

      <section id="off-banner" class="section-m1">
        <h2>Enjoy farm fresh products</h2>
        <a href="product.php" class="normal">
        <button class="normal">Explore More</button>
        </a>
      </section>

      <section id="banners" class="section-p1">
        <div class="big-banners">
          <div class="big-banners-1">
            <h4>Fuel Your Body with Farm-Fresh Goodness!</h4>
            <h2>Support Local Farms, Taste the Difference!</h2>
            <span>Harvest the Best, Savor the Flavor!</span>
            <button class="banner-btn">Learn More</button>
          </div>
          <div class="big-banners-2">
            <h4>Sowing Quality, Reaping Satisfaction!</h4>
            <h2>Nature's Bounty, Delivered to Your Doorstep!</h2>
            <span>Farm Direct, Taste Perfection!</span>
            <button class="banner-btn">Order now!</button>
          </div>
        </div>
      </section> 
    </main>

    <!--footer section-->

    <footer>
      <div id="footer">
        <div class="contact">
          <a href="indext.html"><img src="images/logo.png" alt="" /></a>
          <br> <br>
          <br> 
          <h3>Contact</h3>
          <address>
            <p><b>Address:</b> Kimathi House, Kimathi Street, Nairobi.</p>
            <p><b>Phone:</b> +254 703 541 721</p>
            <p><b>Hours</b> 10:00 - 18:00. Mon - Sat</p>
          </address>
          <br> 
        </div>
        <div class="about">
          <h3>About</h3>
          <br> 
          <a href="#">About Us</a>
          <a href="#">Privacy Policy</a>
          <a href="#">Terms & Conditions</a>
          <a href="#">Contact Us</a>
        </div>
        <div class="myaccount ">
          <h3>My account</h3>
          <br> 
          <a href="/users/signup.php">Sign In</a>
          <a href="#">View Cart</a>
          <a href="#">Help</a>
        </div> 
      </div>
    </footer>

    <script src="script.js"></script>
  </body>
</html>
