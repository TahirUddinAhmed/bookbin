<?php
 $query = "SELECT * FROM `users` WHERE `user_role` = 'Admin' ORDER BY `users`.`user_id` DESC";
 $select_seller_res = mysqli_query($conn, $query);
 $num_of_users = mysqli_num_rows($select_seller_res);

 // check the connection
 if(!$select_seller_res){
    die("QUERY FAILED" . mysqli_error($conn));
 }


 // delete users
 if(isset($_GET['delete'])){
    $the_id = $_GET['delete'];

    // delete query
    $query = "DELETE FROM `users` WHERE `users`.`user_id` = $the_id";
    $delete_user_res = mysqli_query($conn, $query);

    // check the connection
    if(!$delete_user_res){
        die("QUERY FAILED" . mysqli_error($conn));
    }else {
        header("Location: users.php?source=allBuyers");
    }
 }
?>
<div class="container-fluid shadow mb-3">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800 text-center pt-4">Admin</h1>

<!-- DataTales Example -->
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        
            <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Username</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

            <?php 

             if($num_of_users > 0){
                $sno = 1;
                while($row = mysqli_fetch_assoc($select_seller_res)){
                    $user_id = $row['user_id'];
                    $user_fullname = $row['user_fullname'];
                    $user_phone = $row['phone'];
                    $user_email = $row['user_email'];
                    $user_status = $row['user_status'];
                    $user_name = $row['username'];
                    $user_date = $row['user_date'];
            ?>

            <tr>
                <td><?php echo $sno; ?></td>
                <td><?php echo $user_fullname; ?></td>
                <td><?php echo $user_email; ?></td>
                <td><?php echo $user_phone; ?></td>               
                <td><?php echo $user_name; ?></td>
                
                <td><?php dateFormat($user_date); ?></td>
                <td>
                    <!-- // edit -->
                    <a href="users.php?source=Editadmin&a_id=<?php echo $user_id; ?>" class="btn btn-sm btn-primary">Edit</a>
                    <!-- // delete -->
                    <a href="users.php?source=admin&delete=<?php echo $user_id; ?>" class="btn btn-sm btn-danger">Delete</a>
                </td>
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