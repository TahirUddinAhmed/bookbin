<?php 
 // update the form 
 if(isset($_POST['update_admin'])){
    $user_id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $user_phone = $_POST['phone_number'];
    $user_email = $_POST['user_email'];
    $username = $_POST['username'];

    // update query
    $query = "UPDATE `users` SET `user_fullname` = '$fullname', `user_email` = '$user_email', `phone` = '$user_phone', `username` = '$username' WHERE `users`.`user_id` = $user_id";
    $update_admin_res = mysqli_query($conn, $query);

    // check the connection
    if(!$update_admin_res){
        die("QUERY FAILED" . mysqli_error($conn));
    }else {
        $message = "<p class='text-success'>Profile Updated Successfully." . " <a href='users.php?source=admin'>View</a></p>";
    }
 }



 // get the user id
 if(isset($_GET['a_id'])){
    $the_admin_id = $_GET['a_id'];
 }
 $query = "SELECT * FROM `users` WHERE `users`.`user_id` = $the_admin_id";
 $select_addmin_res = mysqli_query($conn, $query);

//  check the connection
if(!$select_addmin_res){
    die("QUERY FAILED" . mysqli_error($conn));
}

?>
<div class="container-fluid">
    <p><?php echo $message ?? null; ?></p>
    <h2 class="text-center">Edit Admin</h2>
    
    <form action="" method="post">
<?php
    while($row = mysqli_fetch_assoc($select_addmin_res)){
        $user_id = $row['user_id'];
        $fullname = $row['user_fullname'];
        $user_email = $row['user_email'];
        $user_phone = $row['phone'];
        $username = $row['username'];
?>
        <input type="hidden" name="id" value="<?php echo $user_id; ?>" >
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

        <!-- <div class="form-group">
            <label for="user_role">User Role</label>
            <select class="form-select" name="user_role" aria-label="Default select example">
                <option selected>Select User Role</option>
                <option value="buyer">Buyer</option>
                <option value="seller">Seller</option>
                <option value="admin">Admin</option>
            </select>
        </div> -->
        <input type="submit" class="btn btn-lg btn-primary" name="update_admin" value="Update" >

<?php
    }
?>

        

    </form>
</div>