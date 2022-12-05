<?php include "includes/header.php" ?>
<?php include "includes/navigation.php" ?>

<?php
$query = "SELECT * FROM `bookstable` WHERE `book_status` = 'approved' ORDER BY `bookstable`.`book_id` DESC";
$select_books_result = mysqli_query($conn, $query);
$num_gadget = mysqli_num_rows($select_books_result);

// check the condition
if (!$select_books_result) {
    die("QUERY FAILED" . mysqli_error($conn));
}

// category select 
if (isset($_POST['cat_btn'])) {
    $cat_title = $_POST['category_id'];

    if ($cat_title == 'Gadgets') {
        header("Location: shop_gadgets.php");
    } else {
        header("Location: shop.php");
    }
}
?>
<?php include "includes/addTocart.php" ?>

<!-- login form  -->

<?php include "includes/login.php" ?>

<!-- signup form -->
<?php include "registration.php" ?>



<!-- // header image -->
<section class="shop" id="home">

    <div class="row">

        <div class="content">
            <h3>Books > Shop Page</h3>
        </div>


    </div>

    <!-- </div> -->

</section>

<!-- shop page start -->
<section class="category" id="featured">

    <!-- <h1 class="heading"> <span>Shop Page</span> </h1> -->
    <div class="select_cat">
        <h1>Category</h1>
        <?php echo $message ?? null; ?>
        <form action="" method="post">
            <select name="category_id" class="options" id="">
                <option value="">Choose Option</option>
                <?php
                $query = "SELECT * FROM `categories` WHERE `categories`.`cat_status` = 1";
                $select_cat_res = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($select_cat_res)) {
                    $id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    echo "<option value='$cat_title'>$cat_title</option>";
                    // if($cat_title == 'gadgets'){
                    //     echo "<option value='$cat_title'>Books</option>";
                    // }
                }

                ?>
            </select>
            <input type="submit" value="Browse" name="cat_btn" class="cat_btn">
        </form>

    </div>

    <div class="swiper featured-slider">

        <div class="shop-container">

            <?php
            if ($num_gadget > 0) {
                while ($row = mysqli_fetch_assoc($select_books_result)) {
                    $book_id = $row['book_id'];
                    $cat_id = $row['categoriy_id'];
                    $books_image = $row['book_image'];
                    $book_author = $row['book_author'];
                    $book_title = $row['book_title'];
                    $book_class = $row['book_class'];
                    $book_price = $row['book_price'];
                    $book_original_price = $row['original_price'];
                    $listedBy = $row['book_addBy'];

            ?>
                    <form action="" method="post">
                        <div class="item">
                            
                            <div class="image">
                                <img src="product_img/<?php echo $books_image; ?>" alt="">
                            </div>
                            <div class="content">
                                <h3><?php echo $book_title; ?></h3>
                                <p><?php echo $book_class; ?></p>
                                <p>
                                <?php
                                 getSeller($conn, $listedBy);
                                 

                                    ?>
                                </p>

                                <div class="price"><?php echo $book_price ?> <span><?php echo $book_original_price; ?></span></div>
                                <!-- <a href="#" class="btn">add to cart</a> -->
                                <input type="hidden" name="product_id" value="<?php echo $book_id; ?>">
                                <input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>">
                                <input type="hidden" name="seller_id" value="<?php echo $seller_id; ?>">
                                <!-- <input type="hidden" name="book_id" value="<?php echo $book_id; ?>"> -->
                                <input type="hidden" name="product_image" value="<?php echo $books_image; ?>">
                                <input type="hidden" name="product_title" value="<?php echo $book_title; ?>">
                                <input type="hidden" name="product_price" value="<?php echo $book_price; ?>">
                                <input type="submit" name="addCart" class="btn" value="Buy Now">
                            </div>
                        </div>
                    </form>
            <?php
                }
            }
            ?>


        </div>



    </div>

</section>






<?php include "includes/footer.php" ?>
<!-- footer section ends -->

<!-- loader  -->

<!-- <div class="loader-container">
    <img src="image/loader-img.gif" alt="">
</div> -->


<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>

</html>