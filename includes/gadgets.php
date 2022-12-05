<?php 
 // read gadgets
 $query = "SELECT * FROM `gadgetstable` WHERE `gadget_status` = 'approved' ORDER BY `gadgetstable`.`gadget_id` ASC LIMIT 10";
 $select_gadget_result = mysqli_query($conn, $query);
 $num_of_gadgets = mysqli_num_rows($select_gadget_result);

?>
<?php  include "addTocart.php" ?>
<?php echo $isLogin ?? null; ?>
<section class="featured" id="featured">

    <h1 class="heading"> <span>New Arrival Gadgets</span> </h1>

    <div class="swiper featured-slider">

        <div class="swiper-wrapper">

        <?php 
            if($num_of_gadgets > 0) {
                while($row = mysqli_fetch_assoc($select_gadget_result)){
                    $id = $row['gadget_id'];
                    $cat_id = $row['categoriy_id'];
                    $gadget_image = $row['gadget_image'];
                    $gadget_title = $row['gadget_title'];
                    $original_price = $row['gadget_original_price'];
                    $regular_price = $row['gadget_regular_price'];
                    $listedBy = $row['listedBy'];
        ?>

        <form action="" method="post" class="swiper-slide box">
            <div class="">
                    <div class="image">
                        <img src="./product_img/<?php echo $gadget_image; ?>" alt="">
                    </div>
                    <div class="content">
                        <h3><?php echo $gadget_title; ?></h3>
                        <p>
                            <?php
                                // getting seller details
                                getSeller($conn, $listedBy);
                                
                            ?>
                        </p>
                        <div class="price"><?php echo $regular_price; ?><span><?php echo $original_price; ?></span></div>
                        <!-- <a href="#" class="btn">add to cart</a> -->
                        <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                        <input type="hidden" name="seller_id" value="<?php echo $seller_id; ?>">
                        <input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>">
                        <input type="hidden" name="product_image" value="<?php echo $gadget_image; ?>">
                        <input type="hidden" name="product_title" value="<?php echo $gadget_title; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $regular_price; ?>">

                        <!-- add to cart btn -->
                        <input type="submit" class="btn" name="addCart" value="Buy Now">
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