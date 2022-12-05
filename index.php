<?php include "includes/header.php" ?>

<?php include "includes/navigation.php" ?>
<!-- login form  -->

<?php
 // read books table
 $query = "SELECT * FROM `bookstable` WHERE `book_status` = 'approved' ORDER BY `bookstable`.`book_id` ASC LIMIT 9";
 $select_books_result = mysqli_query($conn, $query);
 $num_books = mysqli_num_rows($select_books_result);

 // check the condition
 if(!$select_books_result){
     die("QUERY FAILED" . mysqli_error($conn));
 }
?>

<?php include "includes/login.php" ?>

<!-- signup form -->
<?php include "registration.php" ?>










<!-- home section starts  -->

<section class="home" id="home">

    <div class="row">

        <div class="content">
            <h3><span class="typed"></span></h3>
            <p>Your one-step destination for second hand books and other study essentials in Morigaon.</p>
            <a href="shop.php" class="btn">shop now</a>
        </div>

        <div class="swiper books-slider">
            <div class="swiper-wrapper">
        <?php 
            if($num_books > 0){
                while($row = mysqli_fetch_assoc($select_books_result)){
                    $books_image = $row['book_image'];
        ?>
                <a href="" class="swiper-slide"><img src="product_img/<?php echo $books_image; ?>" alt=""></a>
        <?php
                }
            }
        ?>
            </div>
            <img src="image/stand.png" class="stand" alt="">
        </div>

    </div>

</section>

<!-- home section ense  -->

<!-- icons section starts  -->

<section class="icons-container">

    <h3>Enjoy your unlimited listing for only ₹5 per month.</h3>


    
</section>

<!-- icons section ends -->

<!-- featured section starts  -->

<?php include "includes/featured.php" ?>

<?php include "includes/gadgets.php" ?>

<!-- featured section ends -->

<!-- newsletter section starts -->
<!-- 
    subscribe for latest updates
<section class="newsletter">

    <form action="">
        <h3>subscribe for latest updates</h3>
        <input type="email" name="" placeholder="enter your email" id="" class="box">
        <input type="submit" value="subscribe" class="btn">
    </form>

</section> -->

<!-- principal  -->

<section class="deal">

    <div class="content">
        <h3>Morigaon College</h3>
        <h1>From Principal's Desk</h1>
        <p>Book Bin is a good initiative by our Commerce Department. I hope everyone will get benefit from this. This mark the end of a problem which students of Morigaon have been facing for a long time. This site will work as a medium for students who want to buy and sell used books and other study-related material in the easiest way. It will also be helpful for the financially weaker students. At last, I thank the creator team for their efforts and wish everyone all the best.</p>
    </div>

    <div class="image">
        <img src="image/principal1.png" alt="">
    </div>

</section>

<?php include "includes/footer.php" ?>

<!-- loader  -->

<!-- <div class="loader-container">
    <img src="image/loader-img.gif" alt="">
</div> -->

<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>



<!-- custom js file link  -->
<script src="js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
<script>
    var typed = new Typed(".typed", {
        strings: ['BookBin', 'MOTTO:TO USE THE UNSED'],
        typeSpeed: 100,
        backSpeed: 100,
        loop: true
    })
</script>
</body>
</html>