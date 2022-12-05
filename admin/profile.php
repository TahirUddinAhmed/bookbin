<?php include "includes/admin-header.php" ?>

<?php 

 // get the users data
 $query = "SELECT * FROM `users` WHERE `users`.`user_id` = '".$_SESSION['user_id']."'";
 $get_user_res = mysqli_query($conn, $query);
 
 // check the connection
 if(!$get_user_res){
    die("QUERY FAILED" . mysqli_error($conn));
 }

 // update user data
 if(isset($_POST['updateUser'])){
    $user_id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $email = $_POST['user_email'];
    $phone = $_POST['phone_number'];
    $address = $_POST['user_address'];
    $pincode = $_POST['pincode'];
    // $username = $_POST['username'];

    // update query
    $query = "UPDATE `users` SET `user_fullname` = '$fullname', ";
    $query .= "`user_email` = '$email', `phone` = '$phone', `user_address` = '$address', ";
    $query .= "`user_pincode` = '$pincode' WHERE `users`.`user_id` ='$user_id'";
    $user_update_result = mysqli_query($conn, $query);

    // check the connection
    if(!$user_update_result){
        die("QUERY FAILED" . mysqli_error($conn));
    }else {
        $message = "<p class='text-success'>Your profile has been updated successfully</p>";
    }
 }



?>

        

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include "includes/admin-navigation.php" ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->

                <!-- Content Row -->
                <div class="container_fluid shadow m-4 p-4">
                <?php echo $message ?? null;?>
                    <h2 class="text-center">Profile</h2>
                    <form action="" method="post">
            <?php 
                while($row=mysqli_fetch_assoc($get_user_res)){
                    $user_id = $row['user_id'];
                    $user_fullname = $row['user_fullname'];
                    $user_email = $row['user_email'];
                    $phone = $row['phone'];
                    $address = $row['user_address'];
                    $pincode = $row['user_pincode'];
                    $username = $row['username'];
                    $user_role = $row['user_role'];
            ?>

                        <input type="hidden" name="id" value="<?php echo $user_id ?>">

                        <div class="form-group">
                            <label for="fullname">Full Name</label>
                            <input type="text" name="fullname" value="<?php echo $user_fullname; ?>" class="form-control" placeholder="Enter name">
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="phone" name="phone_number" value="<?php echo $phone; ?>" class="form-control" placeholder="+91 00000000000 ">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="user_email" value="<?php echo $user_email; ?>" class="form-control" placeholder="@example.com">
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" name="user_address" value="<?php echo $address; ?>" class="form-control" placeholder="Enter Address..">
                        </div>

                        <div class="form-group">
                            <label for="pincode">Pincode</label>
                            <input type="number" name="pincode" value="<?php echo $pincode; ?>" class="form-control" placeholder="Enter your pincode.. ">
                        </div>

                        

                        
                        <div class="form-group">
                            <label for="user_role">User Role</label>
                            <p><?php echo $user_role; ?></p>
                            <!-- <select class="form-select" aria-label="Default select example">
                                <option selected>Select User Role</option>
                                <option value="buyer">Buyer</option>
                                <option value="Seller">Seller</option>
                                <option value="admin" disabled>Admin</option>
                            </select> -->
                        </div>
                        <input type="submit" class="btn btn-lg btn-primary" name="updateUser" value="Update Profile" >


            <?php
                }

            ?>

                        

                    </form>
                </div>

                   

                   

                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
<?php include "includes/admin-footer.php" ?>
           