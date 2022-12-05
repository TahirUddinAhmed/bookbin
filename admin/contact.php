<?php include "includes/admin-header.php" ?>
<?php
 // get data form the database
 $query = "SELECT * FROM `contact_us` ORDER BY `contact_us`.`id` DESC";
 $contact_res = mysqli_query($conn, $query);
 $check_num_items = mysqli_num_rows($contact_res);

 // delete button
 if(isset($_GET['delete'])){
    $the_id = $_GET['delete'];

    // delete query
    $query = "DELETE FROM `contact_us` WHERE `contact_us`.`id` = $the_id";
    $delete_result = mysqli_query($conn, $query);

    // check the connetion
    if(!$delete_result){
        die("QUERY FAILED" . mysqli_error($conn));
    }else {
        header("Location: contact.php");
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
                <div class="container-fluid shadow mb-4 p-4">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    
                        <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Names</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Message/Comment</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                        <?php
                            $sno = 1;
                            if($check_num_items > 0){
                                while($row = mysqli_fetch_assoc($contact_res)){
                                    $id = $row['id'];
                                    $name = $row['name'];
                                    $email = $row['email'];
                                    $mobile = $row['mobile'];
                                    $msg = $row['comment'];
                                    $date = $row['date'];
                        ?>

                        <tr>
                            <td><?php echo $sno; ?></td>
                            <td><?php echo $name; ?></td>
                            <td><?php echo $email; ?></td>
                            <td><?php echo $mobile; ?></td>
                            <td><?php echo $msg; ?></td>
                            <td><?php echo $date; ?></td>
                            <td>
                                <!-- // delete button -->
                                <a href="contact.php?delete=<?php echo $id; ?>" class="btn btn-danger">Delete</a>
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
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
<?php include "includes/admin-footer.php" ?>
           