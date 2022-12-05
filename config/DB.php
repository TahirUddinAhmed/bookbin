<?php
 session_start();
 define('DB_host', 'localhost');
 define('DB_user', 'root');
 define('DB_pass', '');
 define('Db_name', 'bookbin_morigaon');

 // make a connection
 $conn = mysqli_connect(DB_host, DB_user, DB_pass, Db_name);

 // check the connection
 if(!$conn){
    die("CONNECTION FAILED" . mysqli_connect_error());
 }

?>