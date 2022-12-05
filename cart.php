<?php include "includes/header.php" ?>
<?php include "includes/navigation.php" ?>
<!-- login form  -->

<?php 


 // remove cart product 
 if(isset($_GET['delete'])){
    $the_id = $_GET['delete'];

    // delete query 
    $query = "DELETE FROM `cart` WHERE `cart`.`id` = '$the_id'";
    $res = mysqli_query($conn, $query);

    if(!$res){
        die("QUERY FAILED" . mysqli_error($conn));
    }else {
        // refresh
        header("Location: cart.php");
    }
 }
 
 
?>

<?php include "includes/login.php" ?>

<!-- signup form -->
<?php include "registration.php" ?>



  <!-- cart items details -->
  <div class="small-container cart-page">

    <table>
        <tr>
            <th>Product</th>
            <!-- <th>Qantity</th> -->
            <th>Subtotal</th>
        </tr>
        
        <?php 
 
 if(empty($_SESSION['user_id'])){
    $_SESSION['mustLogin'] = "You need to create an account as a buyer";
    $_SESSION['mustLogin_icon'] = "warning";
 }else {
 $the_user_id = $_SESSION['user_id'];
 $query = "SELECT * FROM `cart` WHERE `cart`.`user_id` = '$the_user_id' ORDER BY `cart`.`id` DESC";
 $cart_result = mysqli_query($conn, $query);
 

 
 // check the connection
 if(!$cart_result){
    die("QUERY FAILED" . mysqli_error($conn));
 }

           $check_num_product = mysqli_num_rows($cart_result);
            if($check_num_product > 0){
                // display the products
                $all_total = 0;
                while($row = mysqli_fetch_assoc($cart_result)){
                    $product_id = $row['id'];
                    $user_id = $row['user_id'];
                    $product_image = $row['image'];
                    $product_title = $row['name'];
                    $product_price = $row['price'];
                    
                

                
        ?>
        <tr>
             
            <td>
                <div class="cart-info">
                    <img src="product_img/<?php echo $product_image; ?>" alt="">
                    <div>
                        <p><?php echo $product_title; ?></p>
                        <small>Price: <?php echo $product_price; ?></small>
                        <br>
                    <form action="" method="post">
                       <a href="?delete=<?php echo $product_id; ?>" onclick="return confirm('Do you want to remove?');">remove</a>
                    </form>
                        
                    </div>
                </div>
            </td>
            <!-- <td><input type="number" name="quantity" id="" value="1"></td> -->
            <td><?php echo $product_price; ?></td>
        </tr>
        <?php
                $all_total += $product_price;
                
                }

            }else {
                // display a empty message
                
        ?>

        

        <?php
            }
 }
        ?>

    </table>

    <div class="total-price">

        <table>
            <tr>
                <td> All total</td>
                <td><?php echo $all_total ?? null; ?></td>
            </tr>
        </table>
    </div>
    <div class="placeorder-btn">
        <a href="checkout.php" class="btn">Place Order</a>
    </div>

  </div>





  <?php include "includes/footer.php" ?>
<!-- footer section ends -->

<!-- loader  -->
<!-- 
<div class="loader-container">
    <img src="image/loader-img.gif" alt="">
</div> -->


<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>