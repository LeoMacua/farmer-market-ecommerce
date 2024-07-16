<?php
    include("/xampp/htdocs/trials/includes/connect.php");
     // to delete a category
     function deleteCategory($category_id) {
        global $conn;
        
        $delete_query = "DELETE FROM category WHERE category_id = '$category_id'";
        $result = mysqli_query($conn, $delete_query);

        if ($result) {
            return true; // Successful deletion
        } else {
            return false; // Failed to delete
        }
    }

    // To check if a category delete request is sent
    if (isset($_GET['delete_category'])) {
        $category_id_to_delete = $_GET['delete_category'];

        if (deleteCategory($category_id_to_delete)) {
            echo "<script>alert('Category deleted successfully');</script>";
        } else {
            echo "<script>alert('Failed to delete category');</script>";
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
        <h1>View All Categories</h1>
    </section>
    <table class="table">
        <thead class="pro-collection">
            <tr>
                <th>Category ID</th>
                <th>Category Name</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch categories from the database
            $get_categories = "SELECT * FROM category";
            $result = mysqli_query($conn, $get_categories);
            
            while($row = mysqli_fetch_assoc($result)){
                $category_id = $row['category_id'];
                $category_name = $row['cat_name'];
                ?>
                <tr>
                    <td><?php echo $category_id; ?></td>
                    <td><?php echo $category_name; ?></td>
                    <td><a href="edit_category.php?id=<?php echo $category_id; ?>">Edit</a></td>
                    <td><a href="viewcategories.php?delete_category=<?php echo $category_id; ?>">Delete</a></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</body>
</html>
