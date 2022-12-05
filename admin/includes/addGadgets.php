<?php 
 if(isset($_POST['addGadget'])){
    $title = $_POST['gadget_title'];
    $original_price = $_POST['original_price'];
    $selling_price = $_POST['regular_price'];
    // $gadget_quantity = $_POST['gadget_quantity'];

    // image upload

    $allowed_ext = array('png', 'jpg', 'jpeg');


    $gadget_image = $_FILES['gadget_image']['name'];
    $image_tmp = $_FILES['gadget_image']['tmp_name'];
    $image_size = $_FILES['gadget_image']['size'];
    $target_dir = "../product_img/$gadget_image";

    $image_ext = explode('.', $gadget_image);
    $image_ext = strtolower(end($image_ext));

    // make sure it is an image 
    if(in_array($image_ext, $allowed_ext)){
        // image size < 500KB = 5000000 bits
        if($image_size <= 5000000){
            move_uploaded_file($image_tmp, $target_dir);

            $insert = "INSERT INTO `gadgetstable` (`categoriy_id`, `gadget_image`, `gadget_title`, `gadget_original_price`, `gadget_regular_price`, `gadget_status`, `gadget_date`, `listedBy`) ";
            $insert .= "VALUES (2, '$gadget_image', '$title', '$original_price', '$selling_price', 'review', current_timestamp(), '".$_SESSION['user_id']."')";
            $gadget_result = mysqli_query($conn, $insert);
            // check the connection
            if(!$gadget_result){
                die("QUERY FAILED" . mysqli_error($conn));
            }else {
              $upload = "<p class='text-success'>Your Product has been Uploaded successffully<br>Your listing is under review" . " <a href='products.php?source=allGadgets'>View</a></p>";
            }
        }else {
            $message = "<p class='text-danger'>Image size should be less than 500KB</p>";
        }
    }else {
        $message = "<p class='text-danger'>Only .png, .jpg, .jpeg are allowed.</p>";
    }
 }

?>
<div class="container">
  <p><?php echo $upload ?? null; ?></p>
  <form action="" method="post" name="addProduct" onsubmit="return formValidation();" enctype="multipart/form-data">
    <h2 class="text-center">Upload Gadgets</h2>
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" name="gadget_title" class="form-control" placeholder="enter gadget name">
      <span class="error_title errorFields text-danger"></span>
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
      <label for="gadget_qantity">Quantity</label>
      <input type="number" name="gadget_quantity" class="form-control" placeholder="Quantity">
    </div> -->

    <div class="form-group">
      <label for="gadget_image">Upload image</label>
      <input type="file" name="gadget_image" class="form-control" required>
      <span><?php echo $message ?? null; ?></span>
      <p class="text-muted text-danger m-2">Image size should be less than 500KB</p>
    
    </div>

     <input type="submit" class="btn btn-primary" name="addGadget" value="Upload" >

  </form>
</div>
<script>
  function formValidation(){
    var returnVal = true;


    // get the from data
    var title = document.forms['addProduct']['gadget_title'].value;
    var org_price = document.forms['addProduct']['original_price'].value;
    var offer_price = document.forms['addProduct']['regular_price'].value;

    // title validation
    if(title === '' || title === null){
      document.querySelector(".error_title").innerHTML = "Gadget title is required!";
      returnVal = false;
    }else if(!isNaN(title)){
      document.querySelector(".error_title").innerHTML = "Gadget title can not be a number";
      returnVal = false;
    }
    else {
      document.querySelector(".error_title").innerHTML = "";
    }

    // price 
    if(org_price === '' || org_price === null){
      document.querySelector(".error_org_price").innerHTML = "Orginal Price is required!";
      returnVal = false;
    }else if(isNaN(org_price)){
      document.querySelector(".error_org_price").innerHTML = "Orginal Price is required!";
      returnVal = false;
    }else {
      document.querySelector(".error_org_price").innerHTML = "";
    }

    if(offer_price === '' || offer_price === null){
      document.querySelector(".error_off_price").innerHTML = "Offer price is required!";
    }else if(isNaN(org_price)){
      document.querySelector(".error_org_price").innerHTML = "Offer Price is required!";
      returnVal = false;
    }else {
      document.querySelector(".error_org_price").innerHTML = "";
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