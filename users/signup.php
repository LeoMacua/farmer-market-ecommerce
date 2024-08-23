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
          <a href="index.php"><img src="/images/logo.png" alt="" /></a>
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
              <li><a href="cart.php">Cart</a></li>
              <li><a href="/users/login.php">Login</a></li>
              <li><a class="active" href="/users/signup.php">Sign up</a></li>
            </ul>
          </nav> 
        </div>
      </div>
    </header>

    <main>
      <section class="product-section" class="section-p1">
       <h1 id="heading"> Sign Up</h1>
       <form id="form" action="" method="post">
        <!--fname-->
         <label form="customer_fname" class="form-label">First Name</label><br><br>
         <input type="text" id="customer_fname" name="customer_fname" placeholder="First Name"  required="required">
         <br><br>
         <!--lname-->
         <label form="customer_lname" class="form-label">Last Name</label><br><br>
         <input type="text" id="customer_lname" name="customer_lname" placeholder="Last name" required="required">
         <br><br>
         <!--email-->
         <label form="customer_email" class="form-label">Email</label><br><br>
         <input type="text" id="customer_email" name="customer_email" placeholder="Email" required="required">
         <br><br>

         <!--telephone-->
         <label form="customer_telephone" class="form-label">Mobile Number</label><br><br>
         <input type="text" id="customer_telephone" name="customer_telephone" placeholder="Mobile Number" required="required">
         <br><br>
         <!--Gender-->
         <label form="gender" class="form-label">Gender</label><br><br>
         <input type="text" id="gender" name="gender" placeholder="Gender" required="required">
         <br><br>
         <!--Password-->
         <label form="customer_password" class="form-label">Password</label><br><br>
         <input type="password" id="customer_password" name="customer_password" placeholder="Password" required="required">
         <br><br>
         
         <!--Confirm Password-->
         <label form="confirm_password" class="form-label">Confirm Password</label><br><br>
         <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required="required">
         <br><br>
         <input type="submit" value="Sign Up" name="signup" class="button">
         <br><br>
         <p>Already have an account?<a href="/users/login.php"> Login</a></p>
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
          <a href="/xampp/htdocs/trials/users/signup.php">Sign In</a>
          <a href="#">View Cart</a>
          <a href="#">Help</a>
        </div> 
      </div>
    </footer>

    <script src="script.js"></script>
  </body>
</html>
  
<!---->
<?php
if(isset($_POST['signup'])){
  $customer_fname=$_POST['customer_fname'];
  $customer_lname=$_POST['customer_lname'];
  $customer_email=$_POST['customer_email'];
  $customer_telephone=$_POST['customer_telephone'];
  $gender=$_POST['gender'];
  $customer_password=$_POST['customer_password'];
  $confirm_password=$_POST['confirm_password'];

  // Check if the email or telephone already exists
  $check_query = "SELECT * FROM customer WHERE customer_email = '$customer_email' OR customer_telephone = '$customer_telephone'";
  $result_check = mysqli_query($conn, $check_query);

  if (mysqli_num_rows($result_check) > 0) {
      echo "<script>alert('Email or telephone number already exists. Please use a different one.')</script>";
  } else {
      // Check if passwords match
      if ($customer_password !== $confirm_password) {
          echo "<script>alert('Passwords do not match. Please enter the same password in both fields.')</script>";
      } else {
          // Hash passwords
          $hashed_password = password_hash($customer_password, PASSWORD_DEFAULT);

          // insert if email/telephone is not already used and passwords match
          $insert_query = "INSERT INTO customer (customer_fname, customer_lname, customer_email, customer_telephone, gender, customer_password) 
                          VALUES ('$customer_fname', '$customer_lname', '$customer_email', '$customer_telephone', '$gender', '$hashed_password')";

          $sql_execute = mysqli_query($conn, $insert_query);
          if($sql_execute){
              echo "<script>alert('You have successfully signed up')</script>";
          } else {
              die(mysqli_error($conn));
          }
      }
  }
} 
?>