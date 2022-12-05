<?php
$condition = '';
if ($_SESSION['user_role'] === 'seller') {
    $condition = " WHERE `bookstable`.`book_addBy` = '" . $_SESSION['user_id'] . "'";
}


$query = "SELECT * FROM `bookstable` $condition ORDER BY `bookstable`.`book_id` DESC";
$select_result = mysqli_query($conn, $query);

// check the connectin
if (!$select_result) {
    die("QUERY FAILED" . mysqli_error($conn));
}

// approve 
if (isset($_GET['approve'])) {
    $the_id = $_GET['approve'];

    // approval query
    $query = "UPDATE `bookstable` SET `book_status` = 'approved' WHERE `bookstable`.`book_id` = $the_id";
    $approval_result = mysqli_query($conn, $query);

    // check the connection
    if (!$approval_result) {
        die("QUERY FAILED" . mysqli_error($conn));
    } else {
        header("Location: products.php");
    }
}

// approve 
if (isset($_GET['review'])) {
    $the_id = $_GET['review'];

    // approval query
    $query = "UPDATE `bookstable` SET `book_status` = 'review' WHERE `bookstable`.`book_id` = $the_id";
    $unapproval_result = mysqli_query($conn, $query);

    // check the connection
    if (!$unapproval_result) {
        die("QUERY FAILED" . mysqli_error($conn));
    } else {
        header("Location: products.php");
    }
}

// delete table 
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM `bookstable` WHERE `bookstable`.`book_id` = $id";
    $delete_query_result = mysqli_query($conn, $query);

    // check the connection
    if (!$delete_query_result) {
        die("QUERY FAILED" . mysqli_error($conn));
    } else {
        header("Location: products.php");
    }
}
?>

<div class="container">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Books</h1>

    <!-- DataTales Example -->

    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Author</th>
                    <th>Title</th>
                    <th>Department/Semester</th>
                    <th>Price</th>
                    <th>Status</th>

                    <?php
                    if ($_SESSION['user_role'] === 'admin') {
                    ?>
                        <th colspan="2">Aprroval</th>
                    <?php
                    }
                    ?>
                    <th>Date</th>
                    <?php
                    if ($_SESSION['user_role'] === 'admin') {
                    ?>
                        <th>seller info</th>
                    <?php
                    }
                    ?>

                    <th collspan="2">Action</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $sno = 1;
                if ($check = mysqli_num_rows($select_result) > 0) {
                    while ($row = mysqli_fetch_assoc($select_result)) {
                        $book_id = $row['book_id'];
                        $book_image = $row['book_image'];
                        $book_author = $row['book_author'];
                        $book_title = $row['book_title'];
                        $book_class = $row['book_class'];
                        $book_price = $row['book_price'];
                        $book_status = $row['book_status'];
                        $book_date = $row['book_date'];
                        $listedBy = $row['book_addBy'];

                        // change the date format
                        // $create_date = date_create($book_date);
                        // $date = date_format($create_date, "dS M y h:iA");
                ?>

                        <tr>
                            <td><?php echo $sno; ?></td>
                            <td><img src="../product_img/<?php echo $book_image; ?>" class="img-responsive" width="100" alt="Product Image"></td>
                            <td><?php echo $book_author; ?></td>
                            <td><?php echo $book_title; ?></td>
                            <td><?php echo $book_class; ?></td>
                            <td><?php echo $book_price; ?></td>
                            <td><?php echo $book_status; ?></td>
                            <?php
                            if ($_SESSION['user_role'] === 'admin') {
                            ?>
                                <td colspan="2">
                                    <!-- aprroved     -->
                                    <a href="products.php?approve=<?php echo $book_id; ?>" onclick="return confirm('Do you want to approve?');" class="btn btn-sm btn-success">Approved</a>
                                    <!-- Cancel     -->
                                    <a href="products.php?review=<?php echo $book_id; ?>" onclick="return confirm('Do you review this product?')" class="btn btn-sm btn-danger">Review</a>
                                </td>
                            <?php
                            }
                            ?>
                            <td><?php dateFormat($book_date); ?></td>
                            <?php
                            if ($_SESSION['user_role'] === 'admin') {
                            ?>
                                <td>
                                    <?php
                                    $select = "SELECT * FROM `users` WHERE `users`.`user_id` = $listedBy";
                                    $select_user_res = mysqli_query($conn, $select);

                                    while ($row = mysqli_fetch_assoc($select_user_res)) {
                                        $fullname = $row['user_fullname'];
                                        $phone = $row['phone'];
                                        $address = $row['user_address'];

                                    ?>
                                        <p><?php echo $fullname; ?></p>
                                    <?php
                                    }

                                    ?>
                                </td>
                            <?php
                            }
                            ?>

                            <td>
                                <!-- Edit     -->
                                <a href="products.php?source=edit&p_id=<?php echo $book_id; ?>" class="btn btn-sm btn-primary">Edit</a>
                                <!-- Cancel     -->
                                <a href="products.php?delete=<?php echo $book_id; ?>" onclick="return confirm('Do You want to delete this product?');" class="btn btn-sm btn-danger">Delete</a>
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