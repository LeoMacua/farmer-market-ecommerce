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
       <h1 id="heading"> Admin Sign Up</h1>
       <form id="form" action="" method="post">
        <!--fname-->
         <label form="admin_fname" class="form-label">First Name</label><br><br>
         <input type="text" id="admin_fname" name="admin_fname" placeholder="First Name"  required="required">
         <br><br>
         <!--lname-->
         <label form="admin_lname" class="form-label">Last Name</label><br><br>
         <input type="text" id="admin_lname" name="admin_lname" placeholder="Last name" required="required">
         <br><br>
         <!--email-->
         <label form="admin_email" class="form-label">Email</label><br><br>
         <input type="text" id="admin_email" name="admin_email" placeholder="Email" required="required">
         <br><br>
         <!--telephone-->
         <label form="admin_telephone" class="form-label">Mobile Number</label><br><br>
         <input type="text" id="admin_telephone" name="admin_telephone" placeholder="Mobile Number" required="required">
         <br><br>
         <!--Gender-->
         <label form="gender" class="form-label">Gender</label><br><br>
         <input type="text" id="gender" name="gender" placeholder="Gender" required="required">
         <br><br>
         <!--Password-->
         <label form="admin_password" class="form-label">Password</label><br><br>
         <input type="password" id="admin_password" name="admin_password" placeholder="Password" required="required">
         <br><br>
         
         <!--Confirm Password-->
         <label form="admin_confirm_password" class="form-label">Confirm Password</label><br><br>
         <input type="password" id="admin_confirm_password" name="admin_confirm_password" placeholder="Confirm Password" required="required">
         <br><br>
         <input type="submit" value="Admin Sign Up" name="admin_registration" class="button">
         <br><br>
         <p>Already have an account?<a href="adminlogin.php"> Login</a></p>
    </form>

      </section>
    </main>
    </body>
</html>
  
<!---->
<?php
// Function to validate email
function validateEmail($email) {
    if (strpos($email, '@') !== false) {
        return true; // "@" sign is present
    } else {
        return false; // "@" sign is not present
    }
}

if (isset($_POST['admin_registration'])) {
    $admin_fname = $_POST['admin_fname'];
    $admin_lname = $_POST['admin_lname'];
    $admin_email = $_POST['admin_email'];
    $admin_telephone = $_POST['admin_telephone'];
    $gender = $_POST['gender'];
    $admin_password = $_POST['admin_password'];
    $admin_confirm_password = $_POST['admin_confirm_password'];

    // Validate email
    if (!validateEmail($admin_email)) {
        echo "<script>alert('Invalid email format')</script>";
    } else {
        // Check if the email or telephone already exists
        $check_query = "SELECT * FROM admin WHERE admin_email = '$admin_email' OR admin_telephone = '$admin_telephone'";
        $result_check = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($result_check) > 0) {
            echo "<script>alert('Email or telephone number already exists. Please use a different one.')</script>";
        } else {
            // Check if passwords match
            if ($admin_password !== $admin_confirm_password) {
                echo "<script>alert('Passwords do not match. Please enter the same password in both fields.')</script>";
            } else {
                // Hash passwords
                $hashed_password = password_hash($admin_password, PASSWORD_DEFAULT);

                // insert if email/telephone is not already used and passwords match
                $insert_query = "INSERT INTO admin (admin_fname, admin_lname, admin_email, admin_telephone, gender, admin_password) 
                          VALUES ('$admin_fname', '$admin_lname', '$admin_email', '$admin_telephone', '$gender', '$hashed_password')";

                $sql_execute = mysqli_query($conn, $insert_query);
                if ($sql_execute) {
                    echo "<script>alert('You have successfully signed up')</script>";
                } else {
                    die(mysqli_error($conn));
                }
            }
        }
    }
}
?>