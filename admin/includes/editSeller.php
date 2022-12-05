<?php
// update the form 
if (isset($_POST['update_user'])) {
    $user_id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $user_phone = $_POST['phone_number'];
    $user_email = $_POST['user_email'];
    $username = $_POST['username'];
    $user_password = $_POST['password'];
    $address = $_POST['address'];
    $pincode = $_POST['pincode'];
    $user_role = $_POST['user_role'];

    // update query
    $query = "UPDATE `users` SET `user_fullname` = '$fullname', `user_email` = '$user_email', `phone` = '$user_phone', `user_role` = '$user_role', `user_address` = '$address', `user_pincode` = '$pincode', `username` = '$username', `password` = '$user_password' WHERE `users`.`user_id` = $user_id";
    $update_users_res = mysqli_query($conn, $query);

    // check the connection
    if (!$update_users_res) {
        die("QUERY FAILED" . mysqli_error($conn));
    } else {
        // if($user_role == 'seller'){
        //     $message = "<p class='text-success'>$fullname Profile has been Updated Successfully." . " <a href='users.php'>View</a></p>";
        // }else {
        //     $message = "<p class='text-success'>$fullname Profile has been Updated Successfully." . " <a href='users.php?source=addUser'>View</a></p>";
        // }

    }
}



// get the user id
if (isset($_GET['u_id'])) {
    $the_user_id = $_GET['u_id'];
}
$query = "SELECT * FROM `users` WHERE `users`.`user_id` = $the_user_id";
$select_addmin_res = mysqli_query($conn, $query);

//  check the connection
if (!$select_addmin_res) {
    die("QUERY FAILED" . mysqli_error($conn));
}

?>
<div class="container-fluid">
    <p><?php echo $message ?? null; ?></p>
    <h2 class="text-center">Edit Users</h2>

    <form action="" method="post">
        <?php
        while ($row = mysqli_fetch_assoc($select_addmin_res)) {
            $user_id = $row['user_id'];
            $fullname = $row['user_fullname'];
            $user_email = $row['user_email'];
            $user_phone = $row['phone'];
            $username = $row['username'];
            $address = $row['user_address'];
            $pincode = $row['user_pincode'];
            $user_password = $row['password'];
            $user_role = $row['user_role'];
        ?>
            <input type="hidden" name="id" value="<?php echo $user_id; ?>">
            <div class="form-group">
                <label for="fullname">Full Name</label>
                <input type="text" name="fullname" value="<?php echo $fullname; ?>" class="form-control" placeholder="Enter name">
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="phone" name="phone_number" value="<?php echo $user_phone; ?>" class="form-control" placeholder="+91 00000000000 ">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="user_email" value="<?php echo $user_email; ?>" class="form-control" placeholder="@example.com">
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" value="<?php echo $username; ?>" class="form-control" placeholder="Enter username">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" value="<?php echo $user_password; ?>" class="form-control" placeholder="Enter password">
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" value="<?php echo $address; ?>" class="form-control" placeholder="City - street - locality">
            </div>
            <div class="form-group">
                <label for="pincode">Pincode</label>
                <input type="number" name="pincode" value="<?php echo $pincode; ?>" class="form-control" placeholder="Enter pincode">
            </div>

            <div class="form-group">
                <label for="user_role">User Role</label>
                <select class="form-select" name="user_role" aria-label="Default select example">
                    <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
                    <?php
                    if ($user_role == 'buyer') {
                        echo "<option value='seller'>Seller</option>";
                    } else {
                        echo "<option value='buyer'>Buyer</option>";
                    }

                    ?>



                </select>
            </div>
            <input type="submit" class="btn btn-lg btn-primary" name="update_user" value="Update">

        <?php
        }
        ?>



    </form>
</div>