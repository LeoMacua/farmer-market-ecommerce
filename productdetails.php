<?php
include("/xampp/htdocs/trials/includes/connect.php"); // Include database connection

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Query to retrieve product details by product ID
    $select_query = "SELECT * FROM product WHERE product_id = $product_id";
    $result_query = mysqli_query($conn, $select_query);
    $product_data = mysqli_fetch_assoc($result_query);

    // Check if the product exists
    if ($product_data) {
        $product_title = $product_data['product_title'];
        $product_description = $product_data['product_description'];
        $product_image = $product_data['product_image'];
        $product_price = $product_data['product_price'];

        // Display product details here...
    } else {
        echo "Product not found.";
    }
} else {
    echo "Invalid product ID.";
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shamba Connect</title>
    <link rel="stylesheet" href="main.css" />
    
  </head>
  <body>
    <!--header section-->

    <header>
      <div id="header">
        <div class="header-logo">
          <a href="index.php"><img src="images\logo.png" alt="" /></a>
        </div>
        <div class="search_box">
    <form action="searchproduct.php" method="GET">
        <input type="search" placeholder="Search" name="search_data">
        <input type="submit" id="button" value="Search" name="search_data_product"/>
    </form>
</div>
        <div class="header-list">
          <nav class="header-list-nav">
            <ul>
              <li><a href="hindex.php">Home</a></li>
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
        <h1> Product Available</h1>
        <div class="pro-collection">
        
        <!--fetch products from database-->
        <?php
          $result_query = mysqli_query($conn,$select_query);
          while($row_data=mysqli_fetch_assoc($result_query)){
            $product_id=$row_data['product_id'];
            $product_title=$row_data['product_title'];
            $product_description=$row_data['product_description']; 
            $product_image=$row_data['product_image'];
            $product_price=$row_data['product_price'];

            echo " <div class='product-cart'>
              <img src='./admin/product_images/$product_image' alt='product_title'/>
              <span>$product_description</span>
              <h4>$product_title</h4>
              <h4 class='price'>Ksh$product_price</h4>
              <span class='buy-icon'>&#128722;</span>
             </a>
          </div>";
        }
      
          ?>
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


