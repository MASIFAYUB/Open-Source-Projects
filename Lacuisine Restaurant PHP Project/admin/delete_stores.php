<?php
include("../connection/connect.php");
error_reporting(0);
session_start();


// sending query
mysqli_query($db,"DELETE FROM restaurant WHERE RS_ID = '".$_GET['res_del']."'");
header("location:allrestraunt.php");  

?>
