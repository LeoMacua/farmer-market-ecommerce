<!--connect to database-->
<?php
    // Start the session to store cart items
    session_start();
    include("/xampp/htdocs/trials/includes/connect.php");
    include("/xampp/htdocs/trials/functions/common_function.php");


$customer_id = isset($_SESSION['customer_id']) ? $_SESSION['customer_id'] : null;

// Handle updating quantities
if (isset($_POST['update_quantity'])) {
    $product_id = $_POST['product_id'];
    $new_quantity = $_POST['new_quantity'];

    // Update quantity in the cart
    $update_query = "UPDATE cart SET quantity = $new_quantity WHERE customer_id = $customer_id AND product_id = $product_id";
    mysqli_query($conn, $update_query);
}

// Handle removing items
if (isset($_POST['remove_item'])) {
    $product_id = $_POST['product_id'];

    // To remove item from the cart
    $remove_query = "DELETE FROM cart WHERE customer_id = $customer_id AND product_id = $product_id";
    mysqli_query($conn, $remove_query);
}

// Fetch customer's cart items from the database
$cart_query = "SELECT * FROM cart WHERE customer_id = " . intval($customer_id);
$cart_result = mysqli_query($conn, $cart_query);

// Store cart items 
$cart_items = array();
while ($row = mysqli_fetch_assoc($cart_result)) {
    $cart_items[] = $row;
}

// Calculate total cart price
$total_price = 0;
foreach ($cart_items as $item) {
    $total_price += $item['product_price'] * $item['quantity'];
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shamba Connect</title>
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
              <li><a class="active" href="/cart.php">Cart</a></li>
              <li><a href="/users/login.php">Login</a></li>
              <li><a href="/users/signup.php">Sign up</a></li>
            </ul>
          </nav> 
        </div>
      </div>
    </header>

    <main>
      <section class="product-section" class="section-p1">
       <h1 id="heading"> Cart</h1>

       <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart_items as $item): ?>
                        <tr>
                            <td><?= $item['product_title'] ?></td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                                    <input type="number" name="new_quantity" value="<?= $item['quantity'] ?>" min="1">
                                    <button type="submit" name="update_quantity">Update</button>
                                </form>
                            </td>
                            <td>$<?= $item['product_price'] ?></td>
                            <td>$<?= $item['product_price'] * $item['quantity'] ?></td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                                    <button type="submit" name="remove_item">Remove</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3"><strong>Total</strong></td>
                        <td colspan="2">$<?= $total_price ?></td>
                    </tr>
                </tfoot>
            </table>
            <form method="post" action="checkout.php">
                <button type="submit">Proceed to Checkout</button>
            </form>

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
          <a href="/users/signup.php">Sign In</a>
          <a href="#">View Cart</a>
          <a href="#">Help</a>
        </div> 
      </div>
    </footer>

    <script src="script.js"></script>
  </body>
</html>