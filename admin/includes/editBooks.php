<?php 
 

 // update 
 if(isset($_POST['update_book'])){
  $book_id = $_POST['book_id'];
  $book_title = $_POST['book_title'];
  $book_author = $_POST['book_author'];
  $book_class = $_POST['book_class'];
  $book_org_price = $_POST['original_price'];
  $book_regular_price = $_POST['regular_price'];
  $book_quantity = $_POST['book_qantity'];

  // allowed extension
  $allowed_ext = array('png', 'jpg', 'jpeg');
  // image upload
  $book_image = $_FILES['book_image']['name'];
  $image_size = $_FILES['book_image']['size'];
  $image_temp = $_FILES['book_image']['tmp_name'];
  $target_dir = "../product_img/$book_image";

  $image_ext = explode('.', $book_image);
  $image_ext = strtolower(end($image_ext));

  if($_SESSION['user_role'] === 'admin'){
  if(!empty($book_image)){
  if(in_array($image_ext, $allowed_ext)){
    if($image_size <= 5000000){
        // image upload
        move_uploaded_file($image_temp, $target_dir);
        }else {
          $message = '<p class="text-danger">Image size is too large, image size should be less than 500KB.</p>';
      }
      }else{
        $message = '<p class="text-danger">Only .png, .jpg, .jpen and .gif allowed</p>';
    }
  }else {
    $query = "SELECT * FROM `bookstable` WHERE `book_id` = $book_id";
    $select_image_result = mysqli_query($conn, $query);

    while($row = mysqli_fetch_assoc($select_image_result)){
      $book_image = $row['book_image'];
    }
  }
}

  $query = "UPDATE `bookstable` SET `book_image` = '$book_image', ";
  $query .= "`book_author` = '$book_author', `book_title` = '$book_title', `book_class` = '$book_class', `book_price` = '$book_regular_price', `original_price` = '$book_org_price', `book_quantity` = '$book_quantity' WHERE `bookstable`.`book_id` = $book_id";
  $update_result = mysqli_query($conn, $query);

  // check the connection
  if(!$update_result){
    die("QUERY FAILED" . mysqli_error($conn));
  }else {
    $message = "<p class = 'text-success'>Record has been updated successfully.";
  }

 }


 // fetch all the data
 if(isset($_GET['p_id'])){
  $id = $_GET['p_id'];
}
$query = "SELECT * FROM `bookstable` WHERE `book_id` = $id";
$select_books_result = mysqli_query($conn, $query);

// check the connection
if(!$select_books_result) {
  die("QUERY FAILED" . mysqli_error($conn));
}

?>
<div class="container">

<?php 
 while($row = mysqli_fetch_assoc($select_books_result)) {
    $book_id = $row['book_id'];
    $book_image = $row['book_image'];
    $book_author = $row['book_author'];
    $book_title = $row['book_title'];
    $book_class = $row['book_class'];
    $book_price = $row['book_price'];
    $original_price = $row['original_price'];
    $book_quantity = $row['book_quantity'];
    $book_status = $row['book_status'];
    $book_date = $row['book_date'];
?>
<form action="" method="post" enctype="multipart/form-data">
  <?php echo $message ?? null; ?>
    <h2 class="text-center">Edit Books</h2>
    <input type="hidden" name="book_id" class="form-control" value="<?php echo $book_id; ?>">
    <div class="form-group">
      <label for="title">Book title</label>
      <input type="text" name="book_title" class="form-control" value="<?php echo $book_title; ?>" placeholder="enter the book title...">
    </div>

    <div class="form-group">
      <label for="author">Author</label>
      <input type="text" name="book_author" class="form-control" value="<?php echo $book_author; ?>" placeholder="enter author name">
    </div>

    <div class="form-group">
      <label for="category">Stream/Department</label>
      <input type="text" name="book_class" value="<?php echo $book_class; ?>" class="form-control">
    </div>

    <div class="form-group">
      <label for="original_price">Original Price</label>
      <input type="number" name="original_price" class="form-control" value="<?php echo $original_price; ?>" placeholder="Enter original price..">
    </div>

    <div class="form-group">
      <label for="regular_price">Selling Price</label>
      <input type="text" name="regular_price" class="form-control" value="<?php echo $book_price; ?>" placeholder="enter selling price...">
    </div>

    <div class="form-group">
      <label for="book_qantity">Quantity</label>
      <input type="number" name="book_qantity" class="form-control" value="<?php echo $book_quantity; ?>" placeholder="Qantity">
    </div>

    <?php 
        if($_SESSION['user_role'] === 'admin'){
    ?>

    <div class="form-group">
      <img src="../product_img/<?php echo $book_image; ?>" class="img-fluid" width="80" alt="">
      <label for="book_image">Image</label>
      <input type="file" name="book_image" class="form-control" value="<?php echo $book_image; ?>" placeholder="enter the book title...">
    </div>
    <?php
        }
    ?>

     <input type="submit" class="btn btn-primary" name="update_book" value="Update" >

  </form>
<?php
 }

?>
  
</div>