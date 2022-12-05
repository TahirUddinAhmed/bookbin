<?php
if(isset($_POST['register'])){
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
    $checkUsername = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users` WHERE `users`.`username` = '$username'"));
    if($checkUserEmail > 0){
        $message_email = "Email ID already present";
    }else if($checkUsername > 0){
        $message_username = "Username already Exists";
    }
    else {
        // password encryption
    if($user_roles == 'seller'){
        if($password === $con_password){
            $password = password_hash($password, PASSWORD_DEFAULT);
            $insert = "INSERT INTO `users` (`user_fullname`, `user_email`, `phone`, `user_role`, `username`, `user_status`, `password`, `user_date`) ";
            $insert .= "VALUES ('$fullname', '$email', '$phone', '$user_roles', '$username', 'pending', '$password', current_timestamp())";
            $seller_result = mysqli_query($conn, $insert);

            // check the connection
            if(!$seller_result){
                die("QUERY FAILED" . mysqli_error($conn));
            }else {
                $_SESSION['reg_msg'] = "Hello $fullname Your account has been created successfully. To activate your account please contact. Department of commerce, Morigaon College";
                $_SESSION['reg_icon'] = "success";
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
              $_SESSION['reg_msg'] = "Hello $fullname, Welcome to bookbin";
              $_SESSION['reg_icon'] = "success";
            }
        }
    }
    }

    
 }

?>