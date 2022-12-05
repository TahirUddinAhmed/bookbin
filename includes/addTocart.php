<?php 
// add to carts table
if(isset($_POST['addCart'])){  
      
    $product_image = $_POST['product_image'];
    $title = $_POST['product_title'];
    $price = $_POST['product_price'];
    $cat_id = $_POST['cat_id'];
    $listedBy = $_POST['seller_id'];
    $product_id = $_POST['product_id'];

   

    // insert into cart 


    if(empty($_SESSION['user_id'])){
       
       $_SESSION['$cart_msg'] = 'To buy any product, you must either create an account or login to your existing account.';
       $_SESSION['$cart_code'] = "warning";
       // header("Location: login.php");
    }else if($_SESSION['user_role']  !== 'buyer'){
        $_SESSION['$cart_msg'] = "Only buyers can purchase products.";
        $_SESSION['$cart_code'] = "warning";
    }else {
       $user_id = $_SESSION['user_id'];


       // check if already added to cart
       $query = "SELECT * FROM `cart` WHERE `name` = '$title' AND  `user_id` = '$user_id'";
       $res = mysqli_query($conn, $query);
       $chek_cart_numbers = mysqli_num_rows($res);

       // condition
       $condition = "SELECT * FROM `cart` WHERE `cart`.`user_id` = '$user_id'";
       $con_res = mysqli_query($conn, $condition);
       $item_count = mysqli_num_rows($con_res);

       if($chek_cart_numbers > 0){
           $_SESSION['$cart_msg'] = "already added to cart. go to cart";
           $_SESSION['$cart_code'] = "success";
       }else if($item_count > 0){
           $_SESSION['$cart_msg'] = "One Product at One Time. Please go to Cart 🛒";
           $_SESSION['$cart_code'] = "warning";
       } 
       else{
           $query = "INSERT INTO `cart` (`user_id`, `name`, `price`, `image`, `categoriy_id`, `date`, `listedBy`, `product_id`) ";
           $query .= "VALUES ('$user_id', '$title', '$price', '$product_image', '$cat_id', current_timestamp(), '$listedBy', '$product_id')";
           $cart_result = mysqli_query($conn, $query);
   
           // check the connection
           if(!$cart_result){
               die("QUERY FAILED" . mysqli_error($conn));
           }else {
               // $_SESSION['$cart_msg'] = "Product is added to cart <a href='./cart.php'>View</a>";
               // $_SESSION['$cart_code'] = "success";
               header("Location: checkout.php");
           }
       }

       
    }

    
   }


?>