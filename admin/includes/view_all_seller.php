<?php
$query = "SELECT * FROM `users` WHERE `user_role` = 'seller' ORDER BY `users`.`user_id` DESC";
$select_seller_res = mysqli_query($conn, $query);
$num_of_users = mysqli_num_rows($select_seller_res);

// check the connection
if (!$select_seller_res) {
    die("QUERY FAILED" . mysqli_error($conn));
}


// delete users
if (isset($_GET['delete'])) {
    $the_id = $_GET['delete'];

    // delete query
    $query = "DELETE FROM `users` WHERE `users`.`user_id` = $the_id";
    $delete_user_res = mysqli_query($conn, $query);

    // check the connection
    if (!$delete_user_res) {
        die("QUERY FAILED" . mysqli_error($conn));
    } else {
        header("Location: users.php");
    }
}

// approve
if (isset($_GET['approve'])) {
    $the_user_id = $_GET['approve'];

    // update user status
    $query = "UPDATE `users` SET `user_status` = 'approved' WHERE `users`.`user_id` = $the_user_id";
    $approve_res = mysqli_query($conn, $query);

    // check the connection
    if (!$approve_res) {
        die("QUERY FAILED" . mysqli_error($conn));
    } else {
        //refresh the page 
        header("Location: users.php");
    }
}

// unapprove
if (isset($_GET['unapprove'])) {
    $the_user_id = $_GET['unapprove'];

    // update user status
    $query = "UPDATE `users` SET `user_status` = 'unapproved' WHERE `users`.`user_id` = $the_user_id";
    $unapprove_res = mysqli_query($conn, $query);

    // check the connection
    if (!$unapprove_res) {
        die("QUERY FAILED" . mysqli_error($conn));
    } else {
        //refresh the page 
        header("Location: users.php");
    }
}
?>
<div class="container-fluid shadow mb-3">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800 text-center pt-3">Sellers List</h1>

    <!-- DataTales Example -->

    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Phone</th>
                    <th>Username</th>
                    <th>Status</th>
                    <th>Aprroval</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                <?php

                if ($num_of_users > 0) {
                    $sno = 1;
                    while ($row = mysqli_fetch_assoc($select_seller_res)) {
                        $user_id = $row['user_id'];
                        $user_fullname = $row['user_fullname'];
                        $user_phone = $row['phone'];
                        $user_status = $row['user_status'];
                        $user_name = $row['username'];
                        $user_date = $row['user_date'];
                ?>

                        <tr>
                            <th><?php echo $sno; ?></th>
                            <th><?php echo $user_fullname; ?></th>
                            <th><?php echo $user_phone; ?></th>
                            <th><?php echo $user_name; ?></th>
                            <th><?php echo $user_status; ?></th>
                            <th>
                                <!-- approval -->
                                <a href="users.php?approve=<?php echo $user_id; ?>" onclick="return confirm('Want to approved this user?');" class="btn btn-sm btn-success">Approve</a>
                                <a href="users.php?unapprove=<?php echo $user_id; ?>" onclick="return confirm('want to unapproved this user?');" class="btn btn-sm btn-danger">Unapprove</a>
                            </th>
                            <th><?php dateFormat($user_date); ?></th>
                            <th>
                                <!-- // edit -->
                                <a href="users.php?source=edit&u_id=<?php echo $user_id; ?>" class="btn btn-sm btn-primary">Edit</a>
                                <!-- // delete -->
                                <a href="users.php?delete=<?php echo $user_id; ?>" class="btn btn-sm btn-danger">Delete</a>
                            </th>
                        </tr>

                <?php
                        $sno++;
                    }
                }

                ?>



            </tbody>
        </table>
    </div>


</div>