<?php
include ("connection/connect.php");
session_start(); 				//start session
session_destroy(); 				//distroy all the current sessions
header("Location: index.php"); 	//redireted to login page
?>