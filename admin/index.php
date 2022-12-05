<?php include "includes/admin-header.php" ?>
<?php
 if(!$_SESSION['username']){
    header("Location: ../index.php");
 }else {
    $username = $_SESSION['username'];
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
                    <div class="row">
                <?php 
                // users count 
                $query = "SELECT * FROM `users`";
                $users_res = mysqli_query($conn, $query);
                $users_count = mysqli_num_rows($users_res);

                
                // check the connection
                if(!$users_res){
                    die("QUERY FAILED");
                }


                ?>

            <?php

                // only admin can see this info.
                if($_SESSION['user_role'] === 'admin'){
                    ?>

            
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                              <a href="users.php">Users</a>  </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $users_count; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-fw fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                <?php
                    }
            
            
                ?>
            

            <?php 
                $condition = '';
                $condition1 = '';
                if($_SESSION['user_role'] === 'seller'){
                   $condition = " WHERE `bookstable`.`book_addBy` = '".$_SESSION['user_id']."'";
                   $condition1 = " WHERE `gadgetstable`.`listedBy` = '".$_SESSION['user_id']."'";
                }

                // total books count
                $books_query = "SELECT * FROM `bookstable` $condition";
                $books_res = mysqli_query($conn, $books_query);
                $books_count = mysqli_num_rows($books_res);

                // total gadgets count
                $gadget_query = "SELECT * FROM `gadgetstable` $condition1";
                $gadget_res = mysqli_query($conn, $gadget_query);
                $gadget_count = mysqli_num_rows($gadget_res);

                // grand total
                $grand_total = $books_count + $gadget_count;

            ?>
            <?php 
                if($_SESSION['user_role'] !== 'buyer'){
            ?>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                              <a href="products.php">Totol Products</a> </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $grand_total; ?></div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fa-solid fa-book fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

            <?php
                }

            ?>
                       
        <?php
        $condition = "";
        if($_SESSION['user_role'] === 'seller'){
            $condition = " WHERE `orders`.`listedBy` = '".$_SESSION['user_id']."'";
        }else if($_SESSION['user_role'] === 'buyer'){
            $condition = " WHERE `orders`.`user_id` = '".$_SESSION['user_id']."'";
        }
        // count no. placed order
        $order_query = "SELECT * FROM `orders` $condition";
        $order_res = mysqli_query($conn, $order_query);
        $order_count = mysqli_num_rows($order_res);

        ?>

                        <!-- orders -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><a href="orders.php">Orders</a> 
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $order_count; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                        
                                    </div>
                                  
                                </div>
                                
                            </div>
                             
                        </div>
        <?php
        $condition = "";
        if($_SESSION['user_role'] === 'seller'){
            $condition = " AND `orders`.`listedBy` = '".$_SESSION['user_id']."'";
        }else if($_SESSION['user_role'] === 'buyer'){
            $condition = " AND `orders`.`user_id` = '".$_SESSION['user_id']."'";
        }
            // count no. placed order
            $order_pending_query = "SELECT * FROM `orders` WHERE `orders`.`payment_status` = 'pending' $condition";
            $order_pending_res = mysqli_query($conn, $order_pending_query);
            $order_pending_count = mysqli_num_rows($order_pending_res);

        ?>
                        <!-- Pending order -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                             <a href="orders.php">Pending Orders</a>   </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $order_pending_count; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                        if($_SESSION['user_role'] === 'admin'){
                    ?>


<div class="row">
                    <script type="text/javascript">
                        google.charts.load('current', {'packages':['bar']});
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                            ['data', 'Count'],
                        <?php
                            // seller count
                            $seller_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users` WHERE `users`.`user_role` = 'seller'"));
                            $buyer_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users` WHERE `users`.`user_role` = 'buyer'"));
                            $unactive_seller_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users` WHERE `users`.`user_role` = 'seller' AND `user_status` = 'pending'"));
                            $books_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `bookstable`"));
                            $gadgets_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `gadgetstable`")); 
                            $unapprove_books_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `bookstable` WHERE `bookstable`.`book_status` = 'review'"));
                            $unapprove_gadgets_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `gadgetstable` WHERE `gadgetstable`.`gadget_status` = 'review'"));
                            $placed_order = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `orders` WHERE `orders`.`payment_status` = 'pending'"));
                            
                            
                            $elements = ['Sellers', 'Buyers', 'Unapproved Sellers', 'Books', 'Gadgets', 'Under review Books', 'Under review Gadgets', 'Placed Order'];
                            
                            
                            $elements_count = [$seller_count, $buyer_count, $unactive_seller_count, $books_count, $gadgets_count, $unapprove_books_count, $unapprove_gadgets_count, $placed_order];


                            for($i=0; $i < 8; $i++){
                                echo "['{$elements[$i]}'" . "," . "{$elements_count[$i]}],";
                            }
                        ?>
                            // ['Seller', 1000]
                            
                            ]);

                            var options = {
                            // chart: {
                            //     title: 'Company Performance',
                            //     subtitle: 'Sales, Expenses, and Profit: 2014-2017',
                            // }
                            };

                            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                            chart.draw(data, google.charts.Bar.convertOptions(options));
                        }
                    </script>
                    <div id="columnchart_material" style="width: 100%; height: 500px;"></div>
                    </div>




                    <?php
                        }
                    ?>

                    

                    <!-- Content Row -->

                   

                   
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
<?php include "includes/admin-footer.php" ?>
           