<?php
 if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    // clean Spacial characters
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // get the user table from the data base
    $query = "SELECT * FROM `users` WHERE `users`.`username` = '$username' AND `user_status` = 'approved'";
    $users_result = mysqli_query($conn, $query);
    $num_of_rows = mysqli_num_rows($users_result);

    // check the connection
    if(!$users_result) {
        die("QUERY FAILED" . mysqli_error($conn));
    }

    if($num_of_rows > 0) {
        
        while($row = mysqli_fetch_assoc($users_result)) {
            $DB_user_id = $row['user_id'];
            $DB_user_fullname = $row['user_fullname'];
            $DB_username = $row['username'];
            $DB_password = $row['password'];
            $DB_user_email = $row['user_email'];
            $DB_user_role = $row['user_role'];
            $DB_user_status = $row['user_status'];
        }

        
        
        if(password_verify($password, $DB_password)) {
            $_SESSION['admin_login'] = 'Yes, $DB_username Welcome';
            $_SESSION['user_id'] = $DB_user_id;
            $_SESSION['username'] = $DB_username;
            $_SESSION['fullname'] = $DB_user_fullname;
            $_SESSION['email'] = $DB_user_email;
            $_SESSION['user_role'] = $DB_user_role;
            $_SESSION['user_status'] = $DB_user_status;

            if($_SESSION['user_role'] == 'admin'){
                header("Location: ./admin");
            }else if($_SESSION['user_role'] == 'seller'){
                header("Location: ./admin");
            }else if($_SESSION['user_status'] == 'pending'){
                $_SESSION['user_pending'] = "Your account is not active yet! Please contact Department of commerce To activate your account";
                $_SESSION['user_pending_icon'] = "success";
            }
            else {
                $_SESSION['user_msg'] = "$Welcome, username to bookbin";
                $_SESSION['user_icon'] = "success";


                header("Location: ./shop.php");
               
            }
            
            
        }
        
    }else {
        $_SESSION['$login_error'] = "Please enter valid details";
        $_SESSION['login_icon'] = "warning";
    }
    
    

    

 }

?>
<div class="login-form-container">

    <div id="close-login-btn" class="fas fa-times"></div>

    <form action="" method="post">
        <h3>sign in</h3>
        <p style="color: red;"><?php echo $message ?? null; ?></p>
        <span>username</span>
        <input type="text" name="username" class="box" placeholder="enter your email" id="" required>
        <span>password</span>
        <input type="password" name="password" class="box" placeholder="enter your password" id="" required>
        <div class="checkbox">
            <input type="checkbox" name="" id="remember-me">
            <label for="remember-me"> remember me</label>
        </div>
        <input type="submit" value="sign in" name="login" class="btn">
        <!-- <p>forget password ? <a href="#">click here</a></p> -->
        <p>don't have an account ? <a href="#" id="createAc">create one</a></p>
    </form>

</div>