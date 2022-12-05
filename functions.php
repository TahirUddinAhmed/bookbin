
<?php 
 // getting seller details
 function getSeller($conn, $id){
    // global $conn;
    $query = "SELECT * FROM `users` WHERE `users`.`user_id` = '$id'";
    $seller_query = mysqli_query($conn, $query);
    // check the connection
    if(!$seller_query){
        die("QUERY FAILED" . mysqli_error($conn));
    }

    while($row=mysqli_fetch_assoc($seller_query)){
        global $seller_id;
        
        $seller_id = $row['user_id'];
        $seller_name = $row['user_fullname'];
        $seller_mobile = $row['phone'];
        $seller_address = $row['user_address'];

        echo "<p class='listedBY'>Listed by : $seller_name</p>";
    }
 }

 function orderDateExp(){
    
 }

?>