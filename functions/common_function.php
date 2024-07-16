<?php
//connect to database connect file
    include("/xampp/htdocs/trials/includes/connect.php");

    //getting the products
    
    function getproducts($category_id =null){
        global $conn;

        $select_query = "SELECT * FROM product"; 
        // If a category ID is provided, filter products by category
        if ($category_id !== null) {
            $select_query .= " WHERE category_id = $category_id";
        }
        
            $result_query = mysqli_query($conn,$select_query);
            while($row_data=mysqli_fetch_assoc($result_query)){
              $product_id=$row_data['product_id'];
              $product_title=$row_data['product_title'];
              $product_description=$row_data['product_description']; 
              $product_image=$row_data['product_image'];
              $product_price=$row_data['product_price'];

              echo " <div class='product-cart'>
              <a href='productdetails.php?id=$product_id'>
                <img src='./admin/product_images/$product_image' alt='product_title'/>
                <span>$product_description</span>
                <h4>$product_title</h4>
                <h4 class='price'>Ksh$product_price</h4>
                <span class='buy-icon'>&#128722;</span>
               </a>
            </div>";
          }
}
      

      //search products function
      function search_products(){
        global $conn;
        if(isset($_GET['search_data_product'])){
          $search_data_value=$_GET['search_data'];
        $search_query="SELECT * FROM product WHERE product_keyword like '%$search_data_value%'"; 
            $result_query = mysqli_query($conn,$search_query);

            $num_of_rows = mysqli_num_rows($result_query);

            while($row_data=mysqli_fetch_assoc($result_query)){
              $product_id=$row_data['product_id'];
              $product_title=$row_data['product_title'];
              $product_description=$row_data['product_description']; 
              $product_image=$row_data['product_image'];
              $product_price=$row_data['product_price'];

              echo " <div class='product-cart'>
              <a href='productdetails.php?id=$product_id'>
                <img src='./admin/product_images/$product_image' alt='product_title'/>
                <span>$product_description</span>
                <h4>$product_title</h4>
                <h4 class='price'>Ksh$product_price</h4>
                <span class='buy-icon'>&#128722;</span>
               </a>
            </div>";
          }
        }
        if($num_of_rows==0){
          echo "<h3>This product is currently unavailable</h3>"; 
        }
      }
?>