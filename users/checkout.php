<!--connect to database-->
<?php
     // Start the session to store cart items
     session_start();
    include("/xampp/htdocs/trials/includes/connect.php");
    include("/xampp/htdocs/trials/functions/common_function.php");


     $customer_id = isset($_SESSION['customer_id']) ? $_SESSION['customer_id'] : null;
 
     // Fetch customer's cart items from the database
     $cart_items = array();
     if ($customer_id !== null) {
         $cart_query = "SELECT * FROM cart WHERE customer_id = ?";
         $stmt = mysqli_prepare($conn, $cart_query);
         mysqli_stmt_bind_param($stmt, "i", $customer_id);
         mysqli_stmt_execute($stmt);
         $cart_result = mysqli_stmt_get_result($stmt);
 
         while ($row = mysqli_fetch_assoc($cart_result)) {
             $cart_items[] = $row;
         }
     }
 
     // Calculate total cart price
     $total_price = 0;
     foreach ($cart_items as $item) {
         $total_price += $item['product_price'] * $item['quantity'];
     }
 
     // Handle order confirmation and payment
     if (isset($_POST['place_order']) && $customer_id !== null) {
         // Rest of your code for placing the order
 
         // Redirect to order confirmation page
         header("Location: order_confirmation.php?order_id=$order_id");
         exit();
     }
 ?>
 <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mboga Mart</title>
    <link rel="stylesheet" href="/main.css" />
    <style>
        table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

th, td {
  padding: 10px;
  border: 1px solid #ddd;
  text-align: center;
}

th {
  background-color: #f2f2f2;
}

tfoot td {
  font-weight: bold;
  text-align: right;
}

button {
  background-color: #ff6600;
  color: #fff;
  border: none;
  padding: 5px 10px;
  cursor: pointer;
}
    </style>
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
              <li><a href="/hindex.php">Home</a></li>
              <li><a href="/categories.php">Categories</a></li>
              <li><a href="/product.php">Products</a></li>
              <li><a href="/cart.php">Cart</a></li>
              <li><a href="/users/login.php">Login</a></li>
              <li><a href="/users/signup.php">Sign up</a></li>
            </ul>
          </nav> 
        </div>
      </div>
    </header>

    <main>
      <section class="product-section" class="section-p1">
       <h1 id="heading"> Checkout</h1> 
       
       <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart_items as $item): ?>
                        <tr>
                            <td><?= $item['product_title'] ?></td>
                            <td><?= $item['quantity'] ?></td>
                            <td>$<?= $item['product_price'] ?></td>
                            <td>$<?= $item['product_price'] * $item['quantity'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3"><strong>Total</strong></td>
                        <td>$<?= $total_price ?></td>
                    </tr>
                </tfoot>
            </table>

            <!-- Show the "Place Order" button only when customer is logged in -->
        <?php if ($customer_id !== null): ?>
            <form method="post">
                <button type="submit" name="place_order">Place Order</button>
            </form>
        <?php else: ?>
            <a href="hindex.php">
            <p>Your order has been succesully recieved.</p>
        </a>
        <?php endif; ?>
       </section>
    </main>

    <!--footer section-->
    <footer>
      <div id="footer">
        <div class="contact">
          <a href="indext.html"><img src="/images/logo.png" alt="" /></a>
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
          <a href="/xampp/htdocs/trials/users/signup.php">Sign In</a>
          <a href="#">View Cart</a>
          <a href="#">Help</a>
        </div> 
      </div>
    </footer>

    <script src="script.js"></script>
  </body>
</html>