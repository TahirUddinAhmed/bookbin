<?php 
 if(isset($_POST['addUser'])){
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $con_password = $_POST['con_password'];
    $user_roles = $_POST['user_role'];

    // clean up all the variables
    $fullname = mysqli_real_escape_string($conn, $fullname);
    $phone = mysqli_real_escape_string($conn, $phone);
    $email = mysqli_real_escape_string($conn, $email);
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    $con_password = mysqli_real_escape_string($conn, $con_password);
    $user_roles = mysqli_real_escape_string($conn, $user_roles);

    // is already register
    $checkUserEmail = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users` WHERE `users`.`user_email` = '$email'"));
    $check_phone = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users` WHERE `users`.`phone` = '$phone'"));
    $checkUsername = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users` WHERE `users`.`username` = '$username'"));
    if($checkUserEmail > 0){
        $message_email = "Email ID already present";
    }else if($checkUsername > 0){
        $message_username = "$username already Exists";
    }else if($check_phone > 0){
        $message_phone = "phone number already Exists";
    }
    else {
        // password encryption
    if($user_roles == 'seller'){
        if($password === $con_password){
            $password = password_hash($password, PASSWORD_DEFAULT);
            $insert = "INSERT INTO `users` (`user_fullname`, `user_email`, `phone`, `user_role`, `username`, `user_status`, `password`, `user_date`) ";
            $insert .= "VALUES ('$fullname', '$email', '$phone', '$user_roles', '$username', 'approved', '$password', current_timestamp())";
            $seller_result = mysqli_query($conn, $insert);

            // check the connection
            if(!$seller_result){
                die("QUERY FAILED" . mysqli_error($conn));
            }else {
              $_SESSION['addUsers'] = "This account has been created successfully And Activated for 1 Year!";
              $_SESSION['user_icon'] = "success";
            }
        }
    }

    if($user_roles == 'buyer'){
        if($password === $con_password){
            $password = password_hash($password, PASSWORD_DEFAULT);
            $insert = "INSERT INTO `users` (`user_fullname`, `user_email`, `phone`, `user_role`, `username`, `user_status`, `password`, `user_date`) ";
            $insert .= "VALUES ('$fullname', '$email', '$phone', '$user_roles', '$username', 'approved', '$password', current_timestamp())";
            $buyer_result = mysqli_query($conn, $insert);

            // check the connection
            if(!$buyer_result){
                die("QUERY FAILED" . mysqli_error($conn));
            }else {
              $_SESSION['addUsers'] = "A buyer account is created";
              $_SESSION['user_icon'] = "success";
            }
        }
    }
    }

    
 }


?>
<!-- <?php //include "../validation.php"; ?> -->

<div class="container_fluid shadow mb-4 p-4">

    <p><?php echo $message_seller ?? null; ?></p>
    <h2 class="text-center">Add Users</h2>
    <form action="" method="post" name="addUsers" onsubmit="return validation();">

        <div class="form-group">
            <label for="fullname">Full Name</label>
            <input type="text" name="fullname" class="form-control" placeholder="Enter name">
            <span class="error_name errorFields text-danger"></span>
        </div>

        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="phone" name="phone" class="form-control" placeholder="+91 00000000000 ">
            <span class="error_phone errorFields text-danger"><?php echo $message_phone ?? null; ?></span>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" placeholder="@example.com">
            <span class="error_email errorFields text-danger"><?php echo $message_email ?? null; ?></span>
        </div>

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" placeholder="Enter username">
            <span class="error_username errorFields text-danger"><?php echo $message_username ?? null; ?></span>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Enter password">
            <span class="error_password errorFields text-danger"></span>
        </div>

        <div class="form-group">
            <label for="con_password">Confirm Password</label>
            <input type="password" name="con_password" class="form-control" placeholder="Retype Password">
            <span class="error_confirmpassword errorFields text-danger"></span>
        </div>

        <div class="form-group">
            <label for="user_role">User Role</label>
            <select class="form-select" name="user_role" aria-label="Default select example">
                <option selected>Select User Role</option>
                <option value="buyer">Buyer</option>
                <option value="seller">Seller</option>
                <option value="admin">Admin</option>
                
            </select>
        </div>
        <input type="submit" class="btn btn-lg btn-primary" name="addUser" value="ADD USER" >

    </form>
</div>


<script>
 function validation(){
  var returnVal = true;

  
  var name = document.forms['addUsers']['fullname'].value;
  var email = document.forms['addUsers']['email'].value;
  var phone = document.forms['addUsers']['phone'].value;
  var username = document.forms['addUsers']['username'].value;
  var password = document.forms['addUsers']['password'].value;
  var confirm_pass = document.forms['addUsers']['con_password'].value;


  // name validation
  if(name === '' || name === null){
    document.querySelector('.error_name').innerHTML = "Full Name is required";
    returnVal = false;
  }else if(!isNaN(name)){
    document.querySelector('.error_name').innerHTML = "Name can not be a number";
    returnVal = false;
  }else {
    document.querySelector('.error_name').innerHTML = "";
  }

  // phone number validation
  if(phone === '' || phone === null){
    document.querySelector('.error_phone').innerHTML = "Phone number is required!";
    returnVal = false;
  }else if(isNaN(phone)){
    document.querySelector('.error_phone').innerHTML = "This field requires phone number";
    returnVal = false;
  }else {
    document.querySelector('.error_phone').innerHTML = "";
  }

  // email validation
  if(email === '' || email === null){
    document.querySelector('.error_email').innerHTML = "Email ID is required";
    returnVal = false;
  }else {
    document.querySelector('.error_email').innerHTML = "";
  }


  // username validation
  if(username === '' || username === null){
    document.querySelector('.error_username').innerHTML ="Username is required!";
    returnVal = false;
  }else {
    document.querySelector('.error_username').innerHTML ="";
  }

   // password validation
//   if(password === '' || password === null){
//     document.querySelector('error_password').innerHTML = "password is required!";
//     returnVal = false;
//   }
//   else if(confirm_pass === '' || confirm_pass === null){
//     document.querySelector('error_confirmpassword').innerHTML = "Password does not match, try again!";
//     returnVal = false;
//   }
//   else if(confirm_pass === '' || confirm_pass === null){
//     document.querySelector('error_confirmpassword').innerHTML = "Confirm password is required!";
//     returnVal = false;
//   }
//   else {
//     document.querySelector('error_password').innerHTML = "";
   
//   }
    return returnVal;
 }
</script>