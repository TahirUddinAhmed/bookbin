<?php
$condition = '';
if ($_SESSION['user_role'] === 'seller') {
    $condition = " WHERE `gadgetstable`.`listedBy` = '" . $_SESSION['user_id'] . "'";
}
$query = "SELECT * FROM `gadgetstable` $condition";
$select_result = mysqli_query($conn, $query);
$num_of_items = mysqli_num_rows($select_result);

// check the connectin
if (!$select_result) {
    die("QUERY FAILED" . mysqli_error($conn));
}

// approved
if (isset($_GET['approve'])) {
    $the_id = $_GET['approve'];

    // aproval query
    $query = "UPDATE `gadgetstable` SET `gadget_status` = 'approved' WHERE `gadgetstable`.`gadget_id` = $the_id";
    $approved_result = mysqli_query($conn, $query);

    // check the connection
    if (!$approved_result) {
        die("QUERY FAILED" . mysqli_error($conn));
    } else {
        header("Location: products.php?source=allGadgets");
    }
}

// unapproved
if (isset($_GET['review'])) {
    $the_id = $_GET['review'];

    // aproval query
    $query = "UPDATE `gadgetstable` SET `gadget_status` = 'review' WHERE `gadgetstable`.`gadget_id` = $the_id";
    $unapproved_result = mysqli_query($conn, $query);

    // check the connection
    if (!$unapproved_result) {
        die("QUERY FAILED" . mysqli_error($conn));
    } else {
        header("Location: products.php?source=allGadgets");
    }
}

// delete table 
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM `gadgetstable` WHERE `gadgetstable`.`gadget_id` = $id;";
    $delete_query_result = mysqli_query($conn, $query);

    // check the connection
    if (!$delete_query_result) {
        die("QUERY FAILED" . mysqli_error($conn));
    } else {
        header("Location: products.php?source=allGadgets");
    }
}
?>

<div class="container">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Gadgets</h1>

    <!-- DataTales Example -->

    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Title</th>
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
                    <th>Seller Info.</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sno = 1;
                if ($num_of_items > 0) {
                    while ($row = mysqli_fetch_assoc($select_result)) {
                        $id = $row['gadget_id'];
                        $gadget_image = $row['gadget_image'];
                        $gadget_title = $row['gadget_title'];
                        $selling_price = $row['gadget_regular_price'];
                        $gadget_status = $row['gadget_status'];
                        $gadget_date = $row['gadget_date'];
                        $listedBy = $row['listedBy'];
                        // change date format
                        // $create_date = date_create($gadget_date);
                        // $date = date_format($create_date, "dS M y h:iA");

                ?>

                        <tr>
                            <td><?php echo $sno; ?></td>
                            <td><img src="../product_img/<?php echo $gadget_image; ?>" class="img-responsive" width="100" alt="Product Image"></td>
                            <td><?php echo $gadget_title; ?></td>
                            <td><?php echo $selling_price; ?></td>
                            <td><?php echo $gadget_status; ?></td>
                            <?php
                            if ($_SESSION['user_role'] === 'admin') {
                            ?>
                                <td colspan="2">
                                    <!-- aprroved     -->
                                    <a href="products.php?source=allGadgets&approve=<?php echo $id; ?>" onclick="return confirm('Do you want to approve?')" class="btn btn-sm btn-success">Approve</a>
                                    <!-- Cancel     -->
                                    <a href="products.php?source=allGadgets&review=<?php echo $id; ?>" onclick="return confirm('Do you want to unapprove this product?');" class="btn btn-sm btn-danger">Review</a>
                                </td>
                            <?php
                            }
                            ?>
                            <td><?php dateFormat($gadget_date); ?></td>
                            <th>
                                <?php
                                $query = "SELECT * FROM `users` WHERE `users`. `user_id` = $listedBy";
                                $gadget_listed_res = mysqli_query($conn, $query);

                                while ($row = mysqli_fetch_assoc($gadget_listed_res)) {
                                    $fullname = $row['user_fullname'];
                                    $phone = $row['phone'];
                                    $address = $row['user_address'];
                                }
                                ?>
                                <p><?php echo $fullname; ?></p>
                                <?php
                                ?>
                            </th>
                            <td>
                                <!-- Edit     -->
                                <a href="products.php?source=editGadget&g_id=<?php echo $id; ?>" class="btn btn-sm btn-primary">Edit</a>
                                <!-- Delete     -->
                                <a href="products.php?source=allGadgets&delete=<?php echo $id; ?>" onclick="return confirm('Do you want to delete this product?');" class="btn btn-sm btn-danger">Delete</a>
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