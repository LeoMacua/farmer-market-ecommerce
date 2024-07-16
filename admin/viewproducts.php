<?php
    include("/xampp/htdocs/trials/includes/connect.php");

    //for deleting products
    if(isset($_GET['delete_id'])){
        $delete_id = $_GET['delete_id'];
        $delete_query = "DELETE FROM product WHERE product_id = $delete_id";
        mysqli_query($conn, $delete_query);
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
        a{
            text-decoration: none;
            color: inherit;
        }
        .product_image{
           width: 10%;
           object-fit: contain;
           
        }
        .table {
            width: 90%;
            margin: 50px auto;
            border-collapse: collapse;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.06);
            background-color: #fff;
            border-radius: 10px;
        }

        .table th,
        .table td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ebebeb;
        }

        .table th {
            background-color: #aae1dd;
            color: #000;
            font-weight: bold;
            font-size: 18px;
        }

        .table tr:hover {
            background-color: #f5f5f5;
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
        <h1>View All Products</h1>
    </section>
    <table class="table">
        <thead class="pro-collection">
            <tr>
                <th>Product ID</th>
                <th>Product Title</th>
                <th>Product Image</th>
                <th>Product Price</th>
                <th>Product Category</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            //fetch data from the database
            $_GET_products="SELECT * FROM product";
            $result=mysqli_query($conn,$_GET_products);
            while($row=mysqli_fetch_assoc($result)){
                $product_id=$row['product_id'];
                $product_title=$row['product_title'];
                $product_image=$row['product_image'];
                $product_price=$row['product_price'];
                $category_id=$row['category_id'];
                //output
                echo "<tr>";
                echo "<td>$product_id</td>";
                echo "<td>$product_title</td>";
                echo "<td><img src='./product_images/$product_image'/></td>";
                echo "<td>$product_price</td>";
                echo "<td>$category_id</td>";
                echo "<td><a href='edit_product.php?id=$product_id' class='edit-button'>Edit</a></td>";
                echo "<td><a href='viewproducts.php?delete_id=$product_id' class='delete-button'>Delete</a></td>";
                echo "</tr>";
            }

            ?>
        </tbody>
    </table>

    <script src="/script.js"></script>
</body>
</html>
