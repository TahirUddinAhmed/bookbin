<?php ob_start(); ?>
<?php include "config/DB.php" ?>
<?php include "functions.php" ?>
<?php 



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookBin Morigaon</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="./css/style.css">

    

</head>
<body>
    
<!-- header section starts  -->

<header class="header">

    <div class="header-1">

        <a href="./index.php" class="logo"> <i class="fas fa-book"></i> BookBin </a>

        <form action="" class="search-form">
            <input type="search" name="" placeholder="search here..." id="search-box">
            <label for="search-box" class="fas fa-search"></label>
        </form>

        <div class="icons">
            <div id="search-btn" class="fas fa-search"></div>
            <!-- <a href="#" class="fas fa-heart"></a> -->
            <a href="./cart.php" class="fas fa-shopping-cart"></a>

            <!-- <?php
                //if(empty($_SESSION['username'])){
            ?> -->
                <div id="login-btn" class="fas fa-user"></div>
            <!-- <?php
                 //}else {
            ?> -->

             <!-- <a href="./admin/index.php" class="user-log"><?php // echo $_SESSION['username']; ?><div id="login" class="fas fa-user"></div></a>
                    
                    <?php
                // }
            ?> -->
            
        </div>

    </div>
