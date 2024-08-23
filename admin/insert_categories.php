<?php
    include("/xampp/htdocs/trials/includes/connect.php");
    if(isset($_POST['insert_cat'])){
      $category_title=$_POST['cat_title'];

      //select data from database
      $select_query = "SELECT * FROM category WHERE cat_name = '$category_title'";
      $result_select=mysqli_query($conn,$select_query);
      $number=mysqli_num_rows($result_select);
      if($number>0){
        echo"<script>alert('This category is already present inside the database')</script>";
      }
      else{

      //to push data into the database
      $insert_query = "INSERT INTO `category` (cat_name) VALUES ('$category_title')";
      $result=mysqli_query($conn,$insert_query);
      if($result){
        echo"<script>alert('Category has been succesfully inserted')</script>";
      }
    }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mboga Mart Admin</title>
    <link rel="stylesheet" href="/main.css" />
<style>
   .input-group {
    justify-content: center;
    padding-top: 50px;
  display: flex;
  align-items: center; 
  margin-bottom: 10px;
}

.form-control {
  justify-content: center;
  padding: 6px 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.submit-button {
  display: block;
  margin-left: auto;
  margin-right: auto;
  padding: 6px 12px;
  background-color: #088178;
  color: #fff;
  border: none;
  border-radius: 4px;
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
            <li><a href="aindex.php">Back To Main Panel</a></li>
              <li>Welcome Admin</a></li>
            </ul>
          </nav> 
        </div>
      </div>
    </header>
    <section class="product-section" class="section-p1">
    <h1>Insert Categories</h1>
    </section>

 <form action="" method="post">
    <div class="input-group">
        <input type="text" class="form-control" name="cat_title" placeholder="Insert Category"
        aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <div>
        <input type="submit" class="submit-button" name="insert_cat" value="Insert Category"
        aria-label="Username" aria-describedby="basic-addon1">
    </div>
</form>

<script src="/script.js"></script>
</body>
</html>
