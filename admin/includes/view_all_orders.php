<table class="table table-responsive table-bordered" id="dataTable" width="100%">
  <thead>
    <tr>
      <th>SNO</th>
      <?php
      if ($_SESSION['user_role'] !== 'buyer') {
      ?>
        <th>Name</th>
        <th>Phone</th>
        <th>Address</th>
      <?php
      }
      ?>

      <th>Product</th>
      <th>Total Price</th>
      <?php
      if ($_SESSION['user_role'] !== 'seller') {
      ?>
        <th>Seller Details</th>
      <?php
      }
      ?>
      <th>order Status</th>
      <th>Placed On</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sno = 1;
    while ($row = mysqli_fetch_assoc($orders_result)) {
      $id = $row['id'];
      $user_id = $row['user_id'];
      $name = $row['name'];
      $phone = $row['number'];
      $address = $row['address'];
      $total_products = $row['total_products'];
      $total_price = $row['total_price'];
      $order_status = $row['payment_status'];
      $placed_on = $row['placed_on']; // order placed date
      $listed_by = $row['listedBy'];
    ?>

      <tr>
        <td><?php echo $sno; ?></td>
        <!-- <td><?php echo $user_id; ?></td> -->
        <?php
        if ($_SESSION['user_role'] !== 'buyer') {
        ?>
          <td><?php echo $name; ?></td>
          <td><?php echo $phone; ?></td>
          <td><?php echo $address; ?></td>
        <?php
        }
        ?>

        <td><?php echo $total_products; ?></td>
        <td><?php echo $total_price; ?></td>
        <?php
        if ($_SESSION['user_role'] !== 'seller') {
          if ($order_status !== 'cancelled') {
        ?>

            <td>
              <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                View Details
              </button>

            </td>
          <?php
          } else {
          ?>
            <td><button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModalCenter" disabled>
                View Details
              </button></td>
        <?php
          }
        }
        ?>
        <td><?php echo $order_status; ?></td>
        <td><?php echo $placed_on; ?></td>
        <td>

          <?php

          if ($order_status !== 'cancelled') {
          ?>
            <!-- // cancel -->
            <a href="orders.php?source=cancel&o_id=<?php echo $id; ?>" class="btn btn-sm btn-warning">Cancel</a>
            <!-- // placed -->
            <a href="orders.php?deliverd=<?php echo $id; ?>" class="btn btn-sm btn-success">Delivered</a>
          <?php
          }
          ?>




        </td>
      </tr>


    <?php
      $sno++;
    }
    ?>

  </tbody>
</table>