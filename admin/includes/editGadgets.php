<?php

 // update the form
 if(isset($_POST['update_gadget'])){
    $gadget_id = $_POST['gadget_id'];
    $gadget_title = $_POST['gadget_title'];
    $original_price = $_POST['original_price'];
    $selling_price = $_POST['regular_price'];
    $gadget_quantity = $_POST['gadget_quantity'];

    // image upload

    $allowed_ext = array('png', 'jpg', 'jpeg');


    $gadget_image = $_FILES['gadget_image']['name'];
    $image_tmp = $_FILES['gadget_image']['tmp_name'];
    $image_size = $_FILES['gadget_image']['size'];
    $target_dir = "../product_img/$gadget_image";

    $image_ext = explode('.', $gadget_image);
    $image_ext = strtolower(end($image_ext));

    if(!empty($gadget_image)){
      if(in_array($image_ext, $allowed_ext)){
        if($image_size <= 5000000){
            move_uploaded_file($image_tmp, $target_dir);
        }else {
            $message = "<p class='text-danger'>Image size should be less than 500KB</p>";
        }
      }else {
        $message = "<p class='text-danger'>Only .png, .jpg, .jpeg are allowed.</p>";
      }
    }else {
        $query = "SELECT * FROM `gadgetstable` WHERE `gadgetstable`.`gadget_id` = $gadget_id";
        $image_select_res = mysqli_query($conn, $query);

        while($row = mysqli_fetch_assoc($image_select_res)){
            $gadget_image = $row['gadget_image'];
        }
    }

    // update query 
    $query = "UPDATE `gadgetstable` SET `gadget_image` = '$gadget_image', ";
    $query .= "`gadget_title` = '$gadget_title', `gadget_original_price` = '$original_price', ";
    $query .= "`gadget_regular_price` = '$selling_price', `gadget_qty` = '$gadget_quantity' WHERE `gadgetstable`.`gadget_id` = $gadget_id";
    $update_res = mysqli_query($conn, $query);

    // check the connection
    if(!$update_res){
        die("QUERY FAILED" . mysqli_error($conn));
    }else {
        $message = "<p class = 'text-success'>Record has been updated successfully.</p>";
    }

 }




 // get the id of this product
 if(isset($_GET['g_id'])){
    $the_id = $_GET['g_id'];
 }
 // select the data base table
 $query = "SELECT * FROM `gadgetstable` WHERE `gadgetstable`.`gadget_id` = $the_id";
 $select_gadget_result = mysqli_query($conn, $query);

 // check the connection
 if(!$select_gadget_result){
    die("QUERY FAILED" . mysqli_error($conn));
 }
?>

<div class="container">
  <p><?php echo $message ?? null; ?></p>
  <form action="" method="post" enctype="multipart/form-data">
    <h2 class="text-center">Upload Gadgets</h2>
<?php
    while($row = mysqli_fetch_assoc($select_gadget_result)){
        $gadget_id = $row['gadget_id'];
        $gadget_title = $row['gadget_title'];
        $original_price = $row['gadget_original_price'];
        $selling_price = $row['gadget_regular_price'];
        $gadget_qty = $row['gadget_qty'];
        $gadget_image = $row['gadget_image'];
    }

?>
    <input type="hidden" name="gadget_id" value="<?php echo $gadget_id; ?>" class="form-control">
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" name="gadget_title" class="form-control" value="<?php echo $gadget_title; ?>" placeholder="enter gadget name">
    </div>

    <div class="form-group">
      <label for="original_price">Original Price</label>
      <input type="number" name="original_price" class="form-control" value="<?php echo $original_price; ?>" placeholder="Enter original price..">
    </div>

    <div class="form-group">
      <label for="regular_price">Selling Price</label>
      <input type="text" name="regular_price" class="form-control" value="<?php echo $selling_price; ?>" placeholder="enter selling price...">
    </div>

    <div class="form-group">
      <label for="gadget_qantity">Quantity</label>
      <input type="number" name="gadget_quantity" class="form-control" value="<?php echo $gadget_qty; ?>" placeholder="Quantity">
    </div>

    <?php 
        if($_SESSION['user_role'] === 'admin'){
    ?>

    <div class="form-group">
      <img src="../product_img/<?php echo $gadget_image; ?>" class="image-responsive" width="100" alt="">
      <label for="gadget_image">Image</label>
      <input type="file" name="gadget_image" class="form-control">
      <p class="text-muted text-danger m-2">Image size should be less than 500KB</p>
    </div>
    <?php
        }
    ?>
     <input type="submit" class="btn btn-primary" name="update_gadget" value="Submit" >

  </form>
</div>