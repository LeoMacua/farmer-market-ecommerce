<?php
    include("/xampp/htdocs/trials/includes/connect.php");
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $user_id = $_GET['id'];
        
        // Delete the user from the database
        $delete_query = "DELETE FROM customer WHERE customer_id = $user_id";
        $result_delete = mysqli_query($conn, $delete_query);
        
        if ($result_delete) {
            echo "<script>alert('User has been deleted successfully')</script>";
        } else {
            echo "<script>alert('Failed to delete user.')</script>";
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
     .table-container {
            width: 80%;
            margin: 30px auto;
            background-color: #fff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            overflow: hidden;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th,
        .table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .table th {
            background-color: #f7f7f7;
        }
        .table tbody tr:hover {
            background-color: #f0f0f0;
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
        <h1>List Of Users</h1>
    </section>
    <main>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Telephone</th>
                        <th>Gender</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $get_users_query = "SELECT * FROM customer";
                    $result_users = mysqli_query($conn, $get_users_query);

                    while ($user_data = mysqli_fetch_assoc($result_users)) {
                        echo "<tr>";
                        echo "<td>{$user_data['customer_id']}</td>";
                        echo "<td>{$user_data['customer_fname']}</td>";
                        echo "<td>{$user_data['customer_lname']}</td>";
                        echo "<td>{$user_data['customer_email']}</td>";
                        echo "<td>{$user_data['customer_telephone']}</td>";
                        echo "<td>{$user_data['gender']}</td>";
                        echo "<td><a href='userslist.php?id={$user_data['customer_id']}'>Delete</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>
