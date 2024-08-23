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
    <title>Mboga Mart</title>
    <link rel="stylesheet" href="/main.css" />
    <style>
      
#form{
    width: 50%;
    margin:  auto;
    padding: 50px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.06);
    border-radius: 5px;

    }
    .button{
    width:75%;
    justify-content: center;
    background-color: #aae1dd;
    color: black;
    padding: 10px;
    font-size: large;
    border-radius: 10px;
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
              <li><a href="/products.php">Products</a></li>
              <li><a href="cart.php">Cart</a></li>
              <li><a class="active" href="/users/login.php">Login</a></li>
              <li><a href="/users/signup.php">Sign up</a></li>
            </ul>
          </nav> 
        </div>
      </div>
    </header>

    <main>
      <section class="product-section" class="section-p1">
       <h1 id="heading"> Login </h1>
       <form id="form" action="" method="post">
        <!--fname-->
         <label form="customer_fname" class="form-label">First Name</label><br><br>
         <input type="text" id="customer_fname" name="customer_fname" placeholder="First Name"  required="required">
         <br><br>
         <!--lname-->
         <label form="customer_lname" class="form-label">Last Name</label><br><br>
         <input type="text" id="customer_lname" name="customer_lname" placeholder="Last name" required="required">
         <br><br>
         <!--Password-->
         <label form="customer_password" class="form-label">Password</label><br><br>
         <input type="password" id="customer_password" name="customer_password" placeholder="Password" required="required">
         <br><br>
         
         <input type="submit" value="Login" name="login" class="button">
         <br><br>
         <p>Don't have an account?<a href="/users/signup.php"> Sign Up</a></p>
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
          <a href="signup.php">Sign In</a>
          <a href="#">View Cart</a>
          <a href="#">Help</a>
        </div> 
      </div>
    </footer>

    <script src="script.js"></script>
  </body>
</html>
<?php
if(isset($_POST['login'])){
    $customer_fname = $_POST['customer_fname'];
    $customer_lname = $_POST['customer_lname'];
    $customer_password = $_POST['customer_password'];

    $select_query="SELECT * FROM customer WHERE customer_fname='$customer_fname' AND customer_lname='$customer_lname' AND customer_password='$customer_password'";
    $result=mysqli_query($conn,$select_query);

        if (mysqli_num_rows($result) > 0) {
          // Valid login credentials
          echo "<script>alert('Login successful!')</script>";
          header("Location: cart.php");
        } else {
          // Invalid login credentials
          echo "<script>alert('Invalid credentials!')</script>";
        }
      }
    ?>