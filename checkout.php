<?php include "includes/header.php" ?>
<?php include "includes/navigation.php" ?>
<!-- login form  -->
<?php include "includes/login.php" ?>

<!-- signup form -->
<?php include "registration.php" ?>

<?php

// proceed to checkout
if (isset($_POST['order'])) {
    $buyer_name = $_POST['fullname'];
    $buyer_email = $_POST['user_email'];
    $buyer_phone = $_POST['user_phone'];
    $buyer_address = $_POST['user_address'];
    $buyer_pincode = $_POST['user_pincode'];
    $payment_method = $_POST['payment_Mode'];

    // clean up all the user data
    $buyer_name = mysqli_real_escape_string($conn, $buyer_name);
    $buyer_email = mysqli_real_escape_string($conn, $buyer_email);
    $buyer_phone = mysqli_real_escape_string($conn, $buyer_phone);
    $buyer_address = mysqli_real_escape_string($conn, $buyer_address);
    $buyer_pincode = mysqli_real_escape_string($conn, $buyer_pincode);
    $payment_method = mysqli_real_escape_string($conn, $payment_method);

    // product 
    $cart_total = 0;
    $cart_products[] = '';


    $cart_query = "SELECT * FROM `cart` WHERE `cart`.`user_id` = '" . $_SESSION['user_id'] . "'";
    $res = mysqli_query($conn, $cart_query);

    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $cart_products[] = $row['name'];
            $subtotal = $row['price'];
            $cat_id = $row['categoriy_id'];
            $product_id = $row['product_id'];
            $listedBy = $row['listedBy'];
            $cart_total += $subtotal;
        }
    }

    $total_product = implode(', ', $cart_products);

    // order query
    $order_query = "SELECT * FROM `orders` WHERE `name` = '$buyer_name' AND `email` = '$buyer_email' ";
    $order_query .= "AND `method` = '$payment_method' AND `address` = '$buyer_address' AND `total_products` = '$total_product' AND `total_price` = '$cart_total'";
    $order_query_result = mysqli_query($conn, $order_query);

    // check the connection
    if (!$order_query_result) {
        die("QUERY FAILED" . mysqli_error($conn));
    }

    if ($cart_total == 0) {
        $_SESSION['order_msg'] = "Your cart is empty";
        $_SESSION['order_icon'] = "warning";
    } else {
        if (mysqli_num_rows($order_query_result) > 0) {
            $_SESSION['order_msg'] = "Order already placed";
            $_SESSION['order_icon'] = "warning";
        } else {
            $user_id = $_SESSION['user_id'];
            $insert_order = "INSERT INTO `orders` (`user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`, `listedBy`, `category_id`, `product_id`) ";
            $insert_order .= "VALUES ('$user_id', '$buyer_name', '$buyer_phone', '$buyer_email', '$payment_method', '$buyer_address', '$total_product', '$cart_total', current_timestamp(), 'pending', '$listedBy', '$cat_id', '$product_id') ";
            $order_result = mysqli_query($conn, $insert_order);

            // // seller details 
            $seller_query = "SELECT * FROM `users` WHERE `users`.`user_id` = '$listedBy'";
            $seller_details_res = mysqli_query($conn, $seller_query);

            while ($row = mysqli_fetch_assoc($seller_details_res)) {
                $seller_id = $row['user_id'];
                $seller_name = $row['user_fullname'];
                $seller_mobile = $row['phone'];
                $seller_address = $row['user_address'];
            }

            // getSeller($conn, $listedBy);

            $_SESSION['order_msg'] = "your order is placed successfully!";
            $_SESSION['order_icon'] = "success";

            $order_msg = "</p> Hii, $buyer_name your order is placed successfully!.<br>";
            $order_msg .= "Seller details:<br>";
            $order_msg .= "Name : $seller_name<br>Phone:<a href='tel: $seller_mobile'> $seller_mobile</a>";
            // clear the cart page 
            mysqli_query($conn, "DELETE FROM `cart` WHERE `user_id` = '$user_id'");
            // remove the order from home page 
            // if(product === book){remove the bookstable product}
            if ($cat_id == 1) {
                $query = "UPDATE `bookstable` SET `book_status` = 'processing' WHERE `bookstable`.`book_id` = '$product_id'";
                $remove_book_res = mysqli_query($conn, $query);

                // check the connection
                if (!$remove_book_res) {
                    die("QUERY FAILED" . mysqli_error($conn));
                }
            }

            // else if(product === gadget){remove the gadget product};
            if ($cat_id == 2) {
                $query = "UPDATE `gadgetstable` SET `gadget_status` = 'processing' WHERE `gadgetstable`.`gadget_id` = '$product_id'";
                $remove_gadget_res = mysqli_query($conn, $query);

                // check the connection
                if (!$remove_gadget_res) {
                    die("QUERY FAILED" . mysqli_error($conn));
                }
            }
        }
    }
}

?>






<!-- ---- Check out page ---- -->
<?php
if (isset($order_msg) && $order_msg != '') {
?>
    <div class="orderMessage">
        <?php echo $order_msg ?? null; ?>
    </div>
<?php
}
?>
<div class="display-order">

    <?php
    $grand_total = 0;
    $query = "SELECT * FROM `cart` WHERE `cart`.`user_id` = '" . $_SESSION['user_id'] . "'";
    $cart_res = mysqli_query($conn, $query);
    $num_of_items = mysqli_num_rows($cart_res);

    if ($num_of_items > 0) {
        while ($row = mysqli_fetch_assoc($cart_res)) {
            $title = $row['name'];
            $price = $row['price'];

    ?>
            <p><?php echo $title; ?> <span>(<?php echo $price . " /"; ?>)</span></p>


    <?php
            $grand_total += $price;
        }
    } else {
        echo "<p class='empty'>Your cart is empty</p>";
    }
    ?>

    <div class="grand-total">All Total : <?php echo $grand_total; ?>/-</div>
    <?php
    // check the connection
    if (!$cart_res) {
        die("QUERY FAILED" . mysqli_error($conn));
    }


    ?>
</div>
<!-- // get some buyer details -->
<?php
$query = "SELECT * FROM `users` WHERE `users`.`user_id` = '" . $_SESSION['user_id'] . "'";
$get_buyer_res = mysqli_query($conn, $query);

// check the connection
if (!$get_buyer_res) {
    die("QUERY FAILED" . mysqli_error($conn));
}
?>


<div class="container-checkout">

    <form action="" method="post">
        <div class="row">
            <div class="col">

                <h3 class="title">Billing Address</h3>
                <?php
                while ($row = mysqli_fetch_assoc($get_buyer_res)) {
                    $buyer_name = $row['user_fullname'];
                    $buyer_email = $row['user_email'];
                    $buyer_phone = $row['phone'];
                    $buyer_address = $row['user_address'];
                    $buyer_pin = $row['user_pincode'];
                }

                ?>
                <div class="inputBox">
                    <span>Full Name</span>
                    <input type="text" name="fullname" value="<?php echo $buyer_name; ?>" placeholder="Enter your full name" required>
                </div>

                <div class="inputBox">
                    <span>Email</span>
                    <input type="email" name="user_email" value="<?php echo $buyer_email; ?>" placeholder="@example.com" required>
                </div>

                <div class="inputBox">
                    <span>Phone</span>
                    <input type="phone" name="user_phone" value="<?php echo $buyer_phone; ?>" placeholder="+91 0000000000" required>
                </div>

                <div class="inputBox">
                    <span>Address :</span>
                    <input type="text" name="user_address" value="<?php echo $buyer_address; ?>" placeholder="City - street - locality" required>
                </div>
                <div class="inputBox">
                    <span>Pincode</span>
                    <input type="number" name="user_pincode" value="<?php echo $buyer_pin; ?>" maxlength="6" placeholder="Enter your pincode" required>
                </div>

                <div class="inputBox">
                    <span>Payment Mode</span>
                    <div class="cod">
                        <input type="radio" id="cod" name="payment_Mode" value="cod" checked>
                        <label for="cod">Cash on Delivary(COD)</label>
                    </div>
                </div>

            </div>

        </div>

        <div class="submit">
            <input type="submit" name="order" value="Proceed to checkout">
        </div>


    </form>

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