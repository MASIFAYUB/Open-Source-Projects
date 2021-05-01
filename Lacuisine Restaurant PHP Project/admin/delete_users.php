<?php
include("../connection/connect.php");
error_reporting(0);
session_start();


// sending query
mysqli_query($db,"DELETE FROM users WHERE CNIC = '".$_GET['user_del']."'");
header("location:allusers.php");  

?>
