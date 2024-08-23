<?php
include("/xampp/htdocs/trials/includes/connect.php"); // Include database connection
include("/xampp/htdocs/trials/functions/common_function.php");
    

if (isset($_GET['category'])) {
    $category_id = $_GET['category'];

    // Define the SQL query to retrieve product details by product ID
    $select_query = "SELECT * FROM product WHERE category_id = $category_id";

    // Execute the SQL query
    $result_query = mysqli_query($conn, $select_query);

    // Check if the query was successful
    if ($result_query) {
        $product_data = mysqli_fetch_assoc($result_query);

        // Check if the product exists
        if ($product_data) {
            $product_title = $product_data['product_title'];
            $product_description = $product_data['product_description'];
            $product_image = $product_data['product_image'];
            $product_price = $product_data['product_price'];

            // Display product details here...
        } else {
            echo "Product currently unavailable.";
        }
    } else {
        echo "Out of stock: " . mysqli_error($conn);
    }
} else {
    echo "No stock for this category.";
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Add your HTML head content here... -->
  </head>
  <body>
    <!-- Add your HTML body content here... -->
    <!-- Display the fetched product details here... -->
  </body>
</html>
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mboga Mart</title>
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
        <div class="pro-collection">
        
        <!--fetch products from database-->
        <?php
        if (isset($_GET['category'])) {
          $category_id = $_GET['category'];
      
          // Fetch category name
          $category_query = "SELECT cat_name FROM category WHERE category_id = $category_id";
          $category_result = mysqli_query($conn, $category_query);
          $category_row = mysqli_fetch_assoc($category_result);
          $category_name = $category_row['cat_name'];
          $result_query = mysqli_query($conn,$select_query);
          
          //display product info
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
        }}
      
       else {
          echo "<h1>All Products</h1>";
      
          // Display all products
          $all_products_query = "SELECT * FROM product";
          $all_products_result = mysqli_query($conn, $all_products_query);
      
          while ($row_data = mysqli_fetch_assoc($all_products_result)) {
              // Display product information here
          }
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


