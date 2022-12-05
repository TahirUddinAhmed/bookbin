<?php session_start(); ?>
<?php
 unset($_SESSION['admin_login']);
 unset($_SESSION['username']);
//  $_SESSION['admin_login'] = null;
//  $_SESSION['username'] = null;

 // redirect to the home page
 header("Location: ../index.php");

?>