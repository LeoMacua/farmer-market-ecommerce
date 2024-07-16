<!--connect to database-->
<?php
    include("/xampp/htdocs/trials/includes/connect.php");
    if(isset($_POST['insert_product'])){

      $product_title=$_POST['product_title'];
      $product_description=$_POST['product_description'];
      $product_keyword=$_POST['product_keyword'];
      $cat_id=$_POST['product_category'];
      $product_price=$_POST['product_price'];
      $product_status='true';
      // accessing images
      $product_image=$_FILES['product_image']['name'];
      //accessing the image temporary name
      $temporary_image=$_FILES['product_image']['tmp_name'];

      //checking empty conditions
      if($product_title == '' or $product_description == '' or $product_keyword == '' or $cat_id == '' or $product_price == '' or $product_image == ''){
         echo"<script> alert('Please fill all the fields!')</script>";
         exit();
    }
      else{
        //store the uploaded images in the product_images folder
        $upload_directory = "./product_images/"; // Relative path to the product_images folder
        move_uploaded_file($temporary_image, $upload_directory . $product_image);

        //insert query
        $insert_product ="INSERT INTO `product` (product_title,product_description,category_id,product_image,product_price,date,status,product_keyword)
        values ('$product_title','$product_description','$cat_id','$product_image','$product_price',NOW(),'$product_status','$product_keyword')";
        $result_query=mysqli_query($conn,$insert_product);
        if($result_query){
          echo"<script>alert('Successfully inserted product.')</script>";
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
    <title>Shamba Connect Admin</title>
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
            <li><a href="aindex.php">Back To Main Panel</a></li>
              <li>Welcome Admin</a></li>
            </ul>
          </nav> 
        </div>
      </div>
    </header>
    <section class="product-section" class="section-p1">
    <h1>Insert Products</h1>
    </section>
    <form id="form" action="" method="post" enctype="multipart/form-data"><!--enctype to enable pictures to be inserted-->
        <!--title-->
         <label form="product_title" class="form-label">Product title</label><br><br>
         <input type="text" id="product_title" name="product_title" placeholder="product title" required>
         <br><br>
         <!--description-->
         <label form="product_description" class="form-label">Product description</label><br><br>
         <input type="text" id="product_description" name="product_description" placeholder="product description" required>
         <br><br>
         <!--keyword-->
         <label form="product_keyword" class="form-label">Product keyword (Fresh vegetable/ Fruit...)</label><br><br>
         <input type="text" id="product_keyword" name="product_keyword" placeholder="product keyword" required>
         <br><br>
         <!--category-->
         <select name="product_category" id="" class="form-select">
            <option value="">Select a category</option>
            <?php
            $select_category = "SELECT * FROM category";
            $result_category = mysqli_query($conn,$select_category);
            while($row_data=mysqli_fetch_assoc($result_category)){
                $cat_name=$row_data['cat_name'];
                $category_id=$row_data['category_id'];
                echo "<option value='$category_id'>$cat_name</option>";   
            }
            ?>
         </select>
         <br><br>
         <!--image-->
         <label form="product_image" class="form-label">Product image</label><br><br>
         <input type="file" id="product_image" name="product_image" required>
         <br><br>
         <!--price-->
         <label form="product_price" class="form-label">Product price</label><br><br>
         <input type="text" id="product_price" name="product_price" placeholder="product price" required>
         <br><br>
         <!--submission-->
         <input type="submit" id="insert_product" value="Insert Product" name="insert_product" class="button">
         <br><br>
    </form>
    <script src="/script.js"></script>
</body>
</html>