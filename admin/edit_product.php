<?php
    include("/xampp/htdocs/trials/includes/connect.php");

    if(isset($_GET['id'])){
        $product_id = $_GET['id'];
        
        // Get current product data from the database
        $get_product = "SELECT * FROM product WHERE product_id = $product_id";
        $result = mysqli_query($conn, $get_product);
        $product_data = mysqli_fetch_assoc($result);
        
        // form submission
        if(isset($_POST['update_product'])){
            // Get edited data from the form
            $edited_title = $_POST['edited_title'];
            $edited_image = $_POST['edited_image'];
            $edited_price = $_POST['edited_price'];
            
            // Update the database with the new data
            $update_query = "UPDATE product SET product_title = '$edited_title', product_image = '$edited_image', product_price = '$edited_price' WHERE product_id = $product_id";
            mysqli_query($conn, $update_query);
            
            // Go back to viewproducts.php after updating
            header("Location: viewproducts.php");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
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
                        <li><a href="aindex.php">Back to Main Panel</a></li>
                        <li>Welcome Admin</li>
                    </ul>
                </nav> 
            </div>
        </div>
    </header>
    <section class="product-section" class="section-p1">
        <h1>Edit Product</h1>
    </section>
    <form id="form" method="post">
        <label>New Title</label><br><br>
        <input type="text" name="edited_title" value="<?php echo $product_data['product_title']; ?>"><br><br>
        <label>New Image</label><br><br>
        <input type="text" name="edited_image" value="<?php echo $product_data['product_image']; ?>"><br><br>
        <label>New Price</label><br><br>
        <input type="text" name="edited_price" value="<?php echo $product_data['product_price']; ?>"><br><br>
        <label>New Category</label><br><br>
        <input type="text" name="edited_category" value="<?php echo $product_data['category_id']; ?>"><br><br>
        <input type="submit" name="update_product" value="Update Product">
    </form>
</body>
</html>
