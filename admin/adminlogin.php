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
    <!--navbar section-->
    <header>
      <div id="header">
        <div class="header-logo">
          <a href="index.php"><img src="/images/logo.png" alt="" /></a>
        </div>
        <div class="header-list">
          <nav class="header-list-nav">
            <ul>
              <li><a class="active" href="aindex.php">Main Panel</a></li>
              <li>Welcome Admin</a></li>
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
         <label form="admin_fname" class="form-label">First Name</label><br><br>
         <input type="text" id="admin_fname" name="admin_fname" placeholder="First Name"  required="required">
         <br><br>
         <!--lname-->
         <label form="admin_lname" class="form-label">Last Name</label><br><br>
         <input type="text" id="admin_lname" name="admin_lname" placeholder="Last name" required="required">
         <br><br>
         <!--Password-->
         <label form="admin_password" class="form-label">Password</label><br><br>
         <input type="password" id="admin_password" name="admin_password" placeholder="Password" required="required">
         <br><br>
         
         <input type="submit" value="Admin Login" name="adminlogin" class="button">
         <br><br>
         <p>Don't have an account?<a href="admin_registration.php"> Sign Up</a></p>
    </form>

      </section>
    </main>

    <script src="script.js"></script>
  </body>
</html>
<?php
if(isset($_POST['adminlogin'])){
    $admin_fname = $_POST['admin_fname'];
    $admin_lname = $_POST['admin_lname'];
    $admin_password = $_POST['admin_password'];

    $select_query="SELECT * FROM admin WHERE admin_fname='$admin_fname' AND admin_lname='$admin_lname' AND admin_password='$admin_password'";
    $result=mysqli_query($conn,$select_query);

        if (mysqli_num_rows($result) > 0) {
          // Valid login credentials
          echo "<script>alert('Login successful!')</script>";
          header("Location: aindex.php");
        } else {
          // Invalid login credentials
          echo "<script>alert('Invalid credentials!')</script>";
        }
      }
    ?>