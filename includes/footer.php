
<!-- footer section starts  -->

<section class="footer">

    <div class="box-container">

        <div class="box">
            <h3>Our locations</h3>
            <a href="#"> <i class="fas fa-map-marker-alt"></i> Morigaon, Assam (India), 782105. 
            </a>
        </div>

        <div class="box">
            <h3>Quick links</h3>
            <a href="./index.php"> <i class="fas fa-arrow-right"></i> Home </a>
            <a href="./shop.php"> <i class="fas fa-arrow-right"></i> Shop </a>
            
            <a href="./admin/"> <i class="fas fa-arrow-right"></i> Account </a>
        </div>

        <div class="box">
            <h3>Extra links</h3>
            <a href="./about.php"> <i class="fas fa-arrow-right"></i> About Us </a>
            <a href="#"> <i class="fas fa-arrow-right"></i> Help? </a>
            <!-- <a href="#"> <i class="fas fa-arrow-right"></i> privacy policy </a> -->
            <!-- <a href="#"> <i class="fas fa-arrow-right"></i> About Us </a> -->
            <!-- <a href="#"> <i class="fas fa-arrow-right"></i> Terms & Conditions </a> -->
         </div>

        <div class="box">
            <h3>Contact info</h3>
            <a href="#"> <i class="fas fa-phone"></i> +91 9864168401 </a>
            <a href="#"> <i class="fas fa-phone"></i> +91 6002592382 </a>
            <a href="#"> <i class="fas fa-envelope"></i> mc.commerce2012@gmail.com </a>
            <!-- <img src="image/worldmap.png" class="map" alt=""> -->
        </div>
        
    </div>

    <div class="credit"> Copyright &copy; <?php echo date('Y') ?> Run and Manages by Department of Commerce(Morigaon College)</div>
    <p class="dev" style="text-align: center; margin-top: 17px ; font-size: 12px;">Developed By <a href="https://twitter.com/TahirUddinAhmed?t=T9FnmV9D-YLdGamshjs_dA&s=09" class="develeoper" target="_blank">Tahir Ahmed</a></p>

</section>

<!-- footer section ends -->
<script src="./js/sweetalert.min.js"></script>

<script>
    <?php
 if(isset($_SESSION['$cart_msg']) && $_SESSION['$cart_msg'] !=''){
?>
swal({
  title: "<?php echo $_SESSION['$cart_msg']; ?>",
//   text: "You clicked the button!",
  icon: "<?php echo $_SESSION['$cart_code']; ?>",
  button: "ok",
});

<?php
    unset($_SESSION['$cart_msg']);
 }
?>

<?php
 if(isset($_SESSION['$login_error']) && $_SESSION['$login_error'] !=''){
?>
    swal({
        title: "<?php echo $_SESSION['$login_error']; ?>",
      //   text: "You clicked the button!",
        icon: "<?php echo $_SESSION['login_icon']; ?>",
        button: "ok",
      });
<?php
    unset($_SESSION['$login_error']);
 }

 // user login success alert
 if(isset($_SESSION['user_msg']) && $_SESSION['user_msg'] !=''){
    ?>
        swal({
            title: "<?php echo $_SESSION['user_msg']; ?>",
          //   text: "You clicked the button!",
            icon: "<?php echo $_SESSION['user_icon']; ?>",
            button: "ok",
          });
    <?php
        unset($_SESSION['user_msg']);
     }


?>
<?php
// user login success alert
if(isset($_SESSION['order_msg']) && $_SESSION['order_msg'] !=''){
    ?>
        swal({
            title: "<?php echo $_SESSION['order_msg']; ?>",
            icon: "<?php echo $_SESSION['order_icon']; ?>",
            button: "ok",
          });
    <?php
        unset($_SESSION['order_msg']);
     }


?>

// order placed alert 
<?php
// user login success alert
if(isset($_SESSION['mustLogin']) && $_SESSION['mustLogin'] !=''){
    ?>
        swal({
            title: "<?php echo $_SESSION['mustLogin']; ?>",
          //   text: "You clicked the button!",
            icon: "<?php echo $_SESSION['mustLogin_icon']; ?>",
            button: "ok",
          });
    <?php
        unset($_SESSION['mustLogin']);
     }


?>

// registration alert

<?php
if(isset($_SESSION['reg_msg']) && $_SESSION['reg_msg'] !=''){
    ?>
        swal({
            title: "<?php echo $_SESSION['reg_msg']; ?>",
          //   text: "You clicked the button!",
            icon: "<?php echo $_SESSION['reg_icon']; ?>",
            button: "ok",
          });
    <?php
        unset($_SESSION['reg_msg']);
     }


?>

<?php
if(isset($_SESSION['user_pending']) && $_SESSION['user_pending'] !=''){
    ?>
        swal({
            title: "<?php echo $_SESSION['user_pending']; ?>",
          //   text: "You clicked the button!",
            icon: "<?php echo $_SESSION['user_pending_icon']; ?>",
            button: "ok",
          });
    <?php
        unset($_SESSION['user_pending']);
     }


?>

</script>