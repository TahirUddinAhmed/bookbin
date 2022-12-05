<?php include "includes/admin-header.php" ?>
<?php
  $condition = '';
  if($_SESSION['user_role'] == 'seller'){
    $condition = " WHERE `orders`.`listedBy` = '".$_SESSION['user_id']."'";
  }else if(  $_SESSION['user_role'] == 'buyer'){
    $condition = " WHERE `orders`.`user_id` = '".$_SESSION['user_id']."'";
  }
 // read the orders table
 $query = "SELECT * FROM `orders` $condition";
 $orders_result = mysqli_query($conn, $query);

 // check the connection
 if(!$orders_result){
    die("QUERY FAILED" . mysqli_error($conn));
 }

 

?>

        

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include "includes/admin-navigation.php" ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <?php
                    // order cancel 
                    if(isset($_GET['source'])){
                      $source = $_GET['source'];
                    }else {
                      $source = '';
                    }

                    // condition
                    switch($source){
                      case 'cancel':
                        include "includes/order_cancel.php";
                        break;
                      default:
                        include "includes/view_all_orders.php";
                        break;
                    }
                  ?>

                   
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
<?php include "includes/admin-footer.php" ?>


<!-- // bootstrap modal -->
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Seller Details</h5>
        
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php
         // getting seller details
         $query = "SELECT * FROM `users` WHERE `users`.`user_id` = '$listed_by'";
         $seller_details_res = mysqli_query($conn, $query);

         // check the connection
         if(!$seller_details_res){
            die("QUERY FAILED" . mysqli_error($conn));
         }

         while($row = mysqli_fetch_assoc($seller_details_res)){
            $seller_name = $row['user_fullname'];
            $seller_phone = $row['phone'];
            $seller_address = $row['user_address'];
        ?>
            <p>Name: <?php echo $seller_name; ?></p>
            <p>Phone:<a href="tel:<?php echo $seller_phone; ?>"> <?php echo $seller_phone; ?></a></p>
            <p>Address: <?php echo $seller_address; ?></p>
        <?php
         }
        ?>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>




           