<?php
if (isset($_GET['o_id']))
    $order_id = $_GET['o_id'];

// read the orders table
$query = "SELECT * FROM `orders` WHERE `orders`.`id` = '$order_id'";
$orders_result = mysqli_query($conn, $query);

// check the connection
if (!$orders_result) {
    die("QUERY FAILED" . mysqli_error($conn));
}

if (isset($_POST['cancel'])) {
    $order_id = $_POST['order_id'];
    $order_price = $_POST['total_price'];
    $order_status = $_POST['status'];
    $reason = $_POST['reason'];
    $cat_id = $_POST['cat_id'];
    $product_id = $_POST['product_id'];

    // clean the data 
    $order_id = mysqli_real_escape_string($conn, $order_id);
    $reason = mysqli_real_escape_string($conn, $reason);


    $query = "INSERT INTO `order_tracking` (`order_id`, `order_status`, `reason`, `category_id`, `Date`) ";
    $query .= "VALUES ('$order_id', 'cancelled', '$reason', '$cat_id', current_timestamp())";
    $cancel_res = mysqli_query($conn, $query);

    // check the connection
    if (!$cancel_res) {
        die("QUERY FAILED" . mysqli_error($conn));
    } else {
        $update_order_status = mysqli_query($conn, "UPDATE `orders` SET `payment_status` = 'cancelled' WHERE `id` = '$order_id'");
        // update the product status
        if ($cat_id == 1) {
            $update_book_status = mysqli_query($conn, "UPDATE `bookstable` SET `book_status` = 'approved' WHERE `bookstable`.`book_id` = $product_id");
        } else if ($cat_id == 1) {
            $update_gadget_status = mysqli_query($conn, "UPDATE `gadgetstable` SET `gadget_status` = 'approved' WHERE `gadgetstable`.`gadget_id` = $product_id");
        }
        header("Location: ./orders.php");
    }
}

?>

<table class="table table-responsive" width="100%">
    <h2>Order Cancel</h2>

    <thead>
        <tr>
            <th scope="col">Product</th>
            <th scope="col">order Status</th>
            <th scope="col">Total Price</th>
            <th scope="col">Placed On</th>

        </tr>
    </thead>
    <tbody>
        <?php
        $sno = 1;
        while ($row = mysqli_fetch_assoc($orders_result)) {
            $id = $row['id'];
            $user_id = $row['user_id'];
            $total_products = $row['total_products'];
            $total_price = $row['total_price'];
            $order_status = $row['payment_status'];
            $placed_on = $row['placed_on']; // order placed date
            $listed_by = $row['listedBy'];
            $cat_id = $row['category_id'];
            $product_id = $row['product_id'];
        ?>

            <tr>
                <td scope="row"><?php echo $total_products; ?></td>

                <td><?php echo $order_status; ?></td>
                <td><?php echo $total_price; ?></td>
                <td><?php echo $placed_on; ?></td>

            </tr>


        <?php
            $sno++;
        }
        ?>

    </tbody>


</table>
<div class="card text-center">
    <!-- <div class="card-header">
        Featured
    </div> -->
    <div class="card-body">
        <h5 class="card-title">Reason</h5>

        <form action="" method="post">
            <div class="input-group">

                <input type="hidden" name="order_id" value="<?php echo $id; ?>">
                <input type="hidden" name="status" value="<?php echo $order_status; ?>">
                <input type="hidden" name="total_price" value="<?php echo $total_price; ?>">
                <input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>">
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">

                <textarea name="reason" class="form-control" id="" rows="7" placeholder="Mention reason...." required></textarea>
                <input type="hidden" name="order_id" value="<?php echo $id; ?>">
            </div>
            <input type="submit" name="cancel" class="btn btn-danger mt-3" value="Cancel">
        </form>
    </div>
    <!-- <div class="card-footer text-muted">
        2 days ago
    </div> -->
</div>