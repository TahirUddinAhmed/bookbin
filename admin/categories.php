<?php include "includes/admin-header.php" ?>

<?php
 // get the category tables
 $query = "SELECT * FROM `categories`";
 $res = mysqli_query($conn, $query);
 $no_of_rows = mysqli_num_rows($res);

//  check the connection
 if(!$res){
    die("QUERY FAILED" . mysqli_error($conn));
 }

 // add category disabled
 if(isset($_POST['add_cat1'])){
    $message = "This feature is disabled";
 }
//  add category
 if(isset($_POST['add_cat'])){
    $cat_title = $_POST['cat_title'];


    // check if data already exists
    $query = "SELECT * FROM `categories` WHERE `cat_title` = '$cat_title'";
    $sel_res = mysqli_query($conn, $query);
    $check_data = mysqli_num_rows($sel_res);

    if($check_data > 0){
        $message = "<p class='text-danger'>Category Already Exists</p>";
    }else {
        $insert = "INSERT INTO `categories` (`cat_title`, `cat_status`) VALUES ('$cat_title', '0')";
        $result = mysqli_query($conn, $insert);

    

        // check the connection
        if(!$result){
            die("QUERY FAILED" . mysqli_error($conn));
        }else {
            header("Location: categories.php");
        }
    }

   
    
 }

 // delete category
 if(isset($_GET['delete'])){
    $the_id = $_GET['delete'];

    $query = "DELETE FROM `categories` WHERE `categories`.`cat_id` = $the_id";
    $delete_result = mysqli_query($conn, $query);

    if(!$delete_result){
        die("query failed" . mysqli_error($conn));
    }else {
        header("Location: categories.php");
    }

 }
 // change the status
 if(isset($_GET['deactive'])){
    $id = $_GET['deactive'];

    $query = "UPDATE `categories` SET `cat_status` = '0' WHERE `categories`.`cat_id` = $id;";
    $deactive_res = mysqli_query($conn, $query);

    header("Location: categories.php");
 }
 if(isset($_GET['active'])){
    $id = $_GET['active'];

    $query = "UPDATE `categories` SET `cat_status` = '1' WHERE `categories`.`cat_id` = $id;";
    $deactive_res = mysqli_query($conn, $query);

    header("Location: categories.php");
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
                        <div class="col-lg-4 col-sm-6">
                            <p><?php echo $message ?? null; ?></p>
                        <form action="" method="post">
                            <h3>Add Category</h3>
                            <div class="form-group">
                                <label for="cat_title"></label>
                                <input type="text" name="cat_title" class="form-control" placeholder="enter category name" required disabled>
                            </div>
                            <input type="submit" class="btn btn-primary" name="add_cat1" value="Submit" >
                        </form>
                        </div>
                        
                    </div>
                    <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                 
                                <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $sno = 1;
                                        if($no_of_rows > 0) {
                                         while($row = mysqli_fetch_assoc($res)){
                                            $cat_id = $row['cat_id'];
                                            $cat_title = $row['cat_title'];
                                            $cat_status = $row['cat_status'];
                                            
                                    ?>
                                    <tr>
                                        <th><?php echo $sno; ?></th>
                                        <th><?php echo $cat_title; ?></th>
                                        <th>
                                         <?php 
                                          if($cat_status == 1){
                                            echo "<a href='categories.php?deactive=$cat_id'>Active</a>" ;
                                          }else {
                                            echo "<a href='categories.php?active=$cat_id'>Deactive</a>" ;
                                          }
                                         ?>
                                        </th>
                                        <th>
                                            <!-- // edit button -->
                                            <a href="#">Edit</a>
                                            <!-- // delete button -->
                                            <a href="categories.php?delete=<?php echo $cat_id; ?>">delete</a>
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
                   
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
<?php include "includes/admin-footer.php" ?>
           