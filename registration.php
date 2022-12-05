<?php require("validation.php") ?>
 

<?php echo $message ?? null; ?>
<?php echo $message_seller ?? null; ?>
<!-- signup form -->
<div class="signup-form-container">

    <div id="close-signup-btn" class="fas fa-times"></div>
   
    <form id="form" action="" method="post" name="register_form" onsubmit="return validateForm()">
        <div class="title">Registration</div>
        <div class="user-details">
            <div class="input-box">
                <span class="details">Full Name</span>
                <input type="text" name="fullname" id="fullname" placeholder="Enter your name...">
                <span class="error_name errorFields"></span>
            </div>
            
            <div class="input-box">
                <span class="details">Phone</span>
                <input type="phone" name="phone" id="phone" placeholder="Enter phone number...">
                <span class="error_phone errorFields"></span>
            </div>
            <div class="input-box">
                <span class="details">Email</span>
                <input type="email" name="email" id="email" placeholder="@gmail.com" required>
                <span class="error_email errorFields"><?php echo $message_email ?? null; ?></span>
                <!-- <div class="verify">
                    <input type="submit" value="Verify">
                </div> -->
            </div>
            <div class="input-box">
                <span class="details">username</span>
                <input type="text" name="username" maxlength="15" id="username" placeholder="Enter your name...">
                <span class="error_username errorFields"><?php echo $message_username ?? null; ?></span>
            </div>
            <div class="input-box">
                <span class="details">Password</span>
                <input type="password" name="password" id="password" placeholder="password">
                <span class="error_password errorFields"></span>
            </div>
            <div class="input-box">
                <span class="details">Confirm Password</span>
                <input type="password" name="con_password" id="con_password" placeholder="Retype password">
                <span class="error_con_pass errorFields"></span>
            </div>
        </div>
        <div class="user_details">
            <span class="user_title">User Role</span>
            <div class="user_role" >
                <label for="">
                    <input type="radio" id="buyer" name="user_role" value="buyer">
                    <label for="buyer">Buyer</label>
                </label>
                <label for="">
                    <input type="radio" id="seller" name="user_role" value="seller">
                    <label for="seller">Seller</label>
                  </label>
                  <span class="error_userrole errorFields"></span>
            </div>
        </div>
        <div class="submit">
            <input type="submit" name="register" value="Register">
        </div>
        <p>Already Have an account ? <a href="#" id="haveAcc">login</a></p>
    </form>
  </div>


