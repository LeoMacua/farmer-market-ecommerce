<?php
    include("/xampp/htdocs/trials/includes/connect.php");

    // to edit a category
    function updateCategory($category_id, $new_category_name) {
        global $conn;
        
        $update_query = "UPDATE category SET cat_name = '$new_category_name' WHERE category_id = '$category_id'";
        $result = mysqli_query($conn, $update_query);

        if ($result) {
            return true; // Successful update
        } else {
            return false; // Failed to update
        }
    }

    // Check if a category edit request is sent
    if (isset($_POST['edit_cat'])) {
        $category_id_to_edit = $_POST['category_id'];
        $new_category_name = $_POST['new_category_name'];

        if (updateCategory($category_id_to_edit, $new_category_name)) {
            echo "<script>alert('Category updated successfully');</script>";
        } else {
            echo "<script>alert('Failed to update category');</script>";
        }
    }

    // Fetch category details for editing
    if (isset($_GET['id'])) {
        $category_id_to_edit = $_GET['id'];
        $get_category = "SELECT * FROM category WHERE category_id = '$category_id_to_edit'";
        $result_category = mysqli_query($conn, $get_category);
        $category_data = mysqli_fetch_assoc($result_category);
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
        <h1>Edit Category</h1>
    </section>
    <form action="" id="form" method="post">
    <label>New Title</label><br><br>
        <input type="hidden" name="category_id" value="<?php echo $category_id_to_edit; ?>">
        <div class="input-group">
            <input type="text" class="form-control" name="new_category_name" placeholder="New Category Name"
            value="<?php echo $category_data['cat_name']; ?>" aria-label="Category Name">
        </div><br><br>
        <div>
            <input type="submit" class="submit-button" name="edit_cat" value="Update Category">
        </div>
    </form>
    
</body>
</html>
