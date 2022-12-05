<?php 
    //show the new arival products
    $query = "SELECT * FROM `bookstable` WHERE `book_status` = 'approved' ORDER BY `bookstable`.`book_id` ASC LIMIT 15";
    $select_books_result = mysqli_query($conn, $query);
    $num_books = mysqli_num_rows($select_books_result);

    // check the condition
    if(!$select_books_result){
        die("QUERY FAILED" . mysqli_error($conn));
    }


?>
<?php include "addTocart.php" ?>
<section class="featured" id="featured">

    <h1 class="heading"> <span>New Arrival books</span> </h1>

    <div class="swiper featured-slider">

        <div class="swiper-wrapper">
    <?php
     if($num_books > 0) {
        while($row = mysqli_fetch_assoc($select_books_result)){
            $id = $row['book_id'];
            $cat_id = $row['categoriy_id'];
            $books_image = $row['book_image'];
            $book_author = $row['book_author'];
            $book_title = $row['book_title'];
            $book_class = $row['book_class'];
            $book_price = $row['book_price'];
            $book_original_price = $row['original_price'];
            $listedBy = $row['book_addBy'];

    ?>
    <form action="" method="post" class="swiper-slide box">
    <div class="">
         <div class="image">
             <img src="./product_img/<?php echo $books_image; ?>" alt="">
         </div>
         <div class="content">
             <h3 name="title"><?php echo $book_title; ?></h3>
             <p>
                <?php echo $book_class; ?>
             </p>
             <p>
                <?php
                    // getting seller details
                    getSeller($conn, $listedBy);
                    
                ?>
             </p>
             <div class="price" name="price"><?php echo $book_price; ?> <span><?php echo $book_original_price; ?> </span></div>
             <!-- <a href="#" class="btn">add to cart</a> -->
             <input type="hidden" name="product_id" value="<?php echo $id; ?>">
             <input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>">
             <input type="hidden" name="seller_id" value="<?php echo $seller_id; ?>">
             <input type="hidden" name="product_image" value="<?php echo $books_image; ?>">
             <input type="hidden" name="product_title" value="<?php echo $book_title; ?>">
             <input type="hidden" name="product_price" value="<?php echo $book_price; ?>">
             <input type="submit" class="btn" name="addCart" value="Buy Now" >
         </div>
        </div>
    </form>

        

    <?php
        }
     }


    ?>

            
        </div>

        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>

    </div>

</section>
