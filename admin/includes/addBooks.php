<?php
 if(isset($_POST['submit'])){
   $book_title = $_POST['book_title'];
   $book_author = $_POST['book_author'];
   $book_class = $_POST['book_stream'];
   $original_price = $_POST['original_price'];
   $regular_price = $_POST['regular_price'];
  //  $book_qantity = $_POST['book_qantity'];

   // allowed extension
   $allowed_ext = array('png', 'jpg', 'jpeg');
   // image upload
   $book_image = $_FILES['book_image']['name'];
   $image_size = $_FILES['book_image']['size'];
   $image_temp = $_FILES['book_image']['tmp_name'];
   $target_dir = "../product_img/$book_image";

   $image_ext = explode('.', $book_image);
   $image_ext = strtolower(end($image_ext));

   if(in_array($image_ext, $allowed_ext)){
    if($image_size <= 5000000){
        // image upload
        move_uploaded_file($image_temp, $target_dir);

        $query = "INSERT INTO `bookstable` (`categoriy_id`,`book_image`, `book_author`, `book_title`, `book_class`, `book_price`, `original_price`, `book_quantity`, `book_status`, `book_date`, `book_addBy`) ";
        $query .= "VALUES (1, '$book_image', '$book_author', '$book_title', '$book_class', '$regular_price', '$original_price', '1', 'review', current_timestamp(), '".$_SESSION['user_id']."')";
        $book_insert_result = mysqli_query($conn, $query);
        // check the connection
        if(!$book_insert_result) {
          die("QUERY FAILED" . mysqli_error($conn));
        }else {
          $upload = "<p class='text-success'>Your Product has been Uploaded successffully<br>Your listing is under review" . " <a href='products.php'>View</a></p>";
        }
    }else {
      $message = "<p class = 'text-danger'>Image Size Must be less than 500KB</p>";
    }
   }else {
    $message = "<p class = 'text-danger'>Only .png, .jpg and .jpeg Allowed.</p>";
   }
 }
?>

<div class="container shadow py-4">
  <p><?php echo $upload ?? null; ?></p>
  <form action="" method="post" enctype="multipart/form-data" name="addProduct" onsubmit="return formValidation();">
    <h2 class="text-center">Upload Books</h2>
    
    <div class="form-group">
      <label for="title">Book title</label>
      <input type="text" name="book_title" class="form-control" placeholder="enter the book title...">
      <span class="error_title errorFields text-danger"></span>
    </div>

    <div class="form-group">
      <label for="author">Author</label>
      <input type="text" name="book_author" class="form-control" placeholder="enter author name">
      <span class="error_author errorFields text-danger"></span>
    </div>

    <div class="form-group">
      <label for="category">Department/class</label>
      <input type="text" name="book_stream" id="" class="form-control" placeholder="Enter Department/Semester">
      <span class="error_depart errorFields text-danger"></span>
    </div>

    <div class="form-group">
      <label for="original_price">Original Price</label>
      <input type="number" name="original_price" class="form-control" placeholder="Enter original price..">
      <span class="error_org_price errorFields text-danger"></span>
    </div>

    <div class="form-group">
      <label for="regular_price">Offer Price</label>
      <input type="number" name="regular_price" class="form-control" placeholder="enter selling price...">
      <span class="error_off_price errorFields text-danger"></span>
    </div>

    <!-- <div class="form-group">
      <label for="book_qantity">Quantity</label>
      <input type="number" name="book_qantity" class="form-control" placeholder="Qantity">
    </div> -->

    <div class="form-group">
      <label for="book_image">Upload image</label>
      <input type="file" name="book_image" class="form-control" required>
      <span class="error_image errorFields text-danger"><?php echo $message ?? null; ?></span>
      <p class="text-muted text-danger m-2">Image size should be less than 500KB</p>    
    </div>

     <input type="submit" class="btn btn-primary" name="submit" value="Upload" >

  </form>
</div>

<script>
  function formValidation(){
    var returnVal = true;

    // title 
    var title = document.forms['addProduct']['book_title'].value;
    var author = document.forms['addProduct']['book_author'].value;
    var department = document.forms['addProduct']['book_stream'].value;
    var org_price = document.forms['addProduct']['original_price'].value;
    var offer_price = document.forms['addProduct']['regular_price'].value;


    // title validation
    if(title === '' || title === null){
      document.querySelector(".error_title").innerHTML = "Book title is required!";
      returnVal = false;
    }else if(!isNaN(title)){
      document.querySelector(".error_title").innerHTML = "Book title can not be numbers";
      returnVal = false;
    }else { document.querySelector(".error_title").innerHTML = "";

    }

    // author validation
    if(author === '' || author === null){
      document.querySelector(".error_author").innerHTML = "Author name is required!";
      returnVal = false;
    }else if(!isNaN(author)){
      document.querySelector(".error_author").innerHTML = "Author name can not be numbers";
      returnVal = false;
    }else {
      document.querySelector(".error_author").innerHTML = "";
      
    }

    // department validation
    if(department === '' || department === null){
      document.querySelector(".error_depart").innerHTML = "Department / Semester is required!";
      returnVal = false;
    }else {
      document.querySelector(".error_depart").innerHTML = "";
    }

    // price validation
    if(org_price === '' || org_price === null){
      document.querySelector(".error_org_price").innerHTML = "Original price is required";
      returnVal = false;
    }else {
      document.querySelector(".error_org_price").innerHTML = "";
    }

    if(offer_price === '' || offer_price === null){
      document.querySelector(".error_off_price").innerHTML = "Offer price is required!";
      returnVal = false;
    }else {
      document.querySelector(".error_off_price").innerHTML = "";
    }

    // if -> offer_price > org_price -> offer price cannot be more than original pice
    if(offer_price > org_price){
      document.querySelector(".error_off_price").innerHTML = "Offer price can not be more than original price!";
      returnVal = false;
    }else if(offer_price === org_price){
      document.querySelector(".error_off_price").innerHTML = "Offer price and original pricing cannot be equal!";
      returnVal = false;
    }

    return returnVal;
  }
</script>
