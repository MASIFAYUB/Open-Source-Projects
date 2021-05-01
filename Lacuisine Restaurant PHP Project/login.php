<!DOCTYPE html>
<html lang="en" >

<head>
	<meta charset="UTF-8">
	<title>login lacuisine</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
<!-- Main CSS -->
    <link rel="stylesheet" href="css/main.css">
<!-- Font Awesome -->
    <script src="js/all.js"></script>
<!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Mr+Dafoe&display=swap" rel="stylesheet">
<!-- Magnific popup -->
    <link rel="stylesheet" href="magnific-popup/magnific-popup.css">

</head>

<body>

<?php

include ("connection/connect.php"); 	//INCLUDE CONNECTION
error_reporting(0); 					//hide undefine index errors
session_start(); 						//temp sessions
if(isset($_POST['submit']))   			//if button is submit
{
	$username = $_POST['user'];  	//fetch records from login form
	$password = $_POST['pass'];
	$nic      = $_POST['cnic'];

	if(!empty($_POST["submit"]))   		//if records were not empty
  {
		$loginquery ="SELECT * FROM users WHERE username='$username' && CNIC='$nic' && password='".md5($password)."'"; //selecting matching records
		$result=mysqli_query($db, $loginquery); //executing
		$row=mysqli_fetch_array($result);
	
	    if(is_array($row))  //if matching records in the array & if everything is right
			{
        $_SESSION["user_id"] = $row['CNIC']; //put user id into temp session
        $_SESSION['success'] = "You are now logged in";
        header("location: login.php"); // redirect to index.php page
	    } 
		  else
      {
        $message = "Invalid CNIC, Username or Password!"; //throw error
      }
	}
}
?>

<!-------------------------------------------------------------------------------------------------------------->

<!--Navigation Bar-->

<nav class="navbar navbar-expand-lg">
    <a href="index.php" class="navbar-brand text-uppercase primary-color">La Cuisine</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbar">
        <div class="toggler-btn">
            <div class="bar bar1"></div>
            <div class="bar bar2"></div>
            <div class="bar bar3"></div>
        </div>
    </button> 
    <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="navbar-nav mx-auto head-text">
            <?php
            if(!empty($_SESSION["user_id"])) 
            {
              echo '<li><a href="your_orders.php" class="btn nav-btn text-capitalize">My_Orders</a></li>';
            }
            ?>            
        </ul>
    <form class="form-inline d-none d-lg-block mr-5">
        <ul class="navbar-nav mx-auto">
          <li><a href="restaurant.php" class="btn nav-btn text-capitalize">Food Items</a></li>
            <?php
            if(empty($_SESSION["user_id"])) 
            {
              // if user is not login
              echo '<li><a href="login.php" class="btn nav-btn text-capitalize">login/signup</a></li>';
            }
            else
            {
              //if user is login
              echo '<li"><a href="logout.php" class="btn nav-btn text-capitalize">logout</a></li>';
            }
            ?>            
        </ul>
    </form>
    </div>
</nav>

<!--End of Navigation Bar-->


<!------------------------------------------------------------------------------------------------------------->

  
<section id="contact">    
    <div class="container-fluid">
        <div class="col-md-12 my-3 mx-auto w-50 h-75 p-5">
            <div class="card text-center">
                <div class="card-header">
                    <h1 class="text-uppercase">Please Login</h1>
                </div>
                <div class="card-body head-text">
				          	<center><span style="color:yellow;">
        						<?php 
        							echo $message; 
        						?>	
          					</span></center> 
        		
          					<center><span style="color:green;">
        						<?php
        							echo $success; 
        						?>
          					</span></center>

                    <form action="" method="post">
<!------------Input Groups------------->
                      <div class="input-group my-3 align-self-center">
                          <div class="input-group-prepend">
                              <span class="input-group-text">
                                  <i class="fas fa-id-card"></i>
                              </span>
                          </div>
                          <input type="text"class="form-control form-control-lg" placeholder="CNIC" name="cnic">
                      </div>
<!------------------------------------->
                      <div class="input-group my-3">
                          <div class="input-group-prepend">
                              <span class="input-group-text">
                                  <i class="fas fa-user"></i>
                              </span>
                          </div>
                          <input type="text"class="form-control form-control-lg" placeholder="Username" name="user">
                      </div>
<!------------------------------------->
                      <div class="input-group my-3">
                          <div class="input-group-prepend">
                              <span class="input-group-text">
                                  <i class="fas fa-user-secret"></i>
                              </span>
                          </div>
                          <input type="password" class="form-control form-control-lg" placeholder="Password" name="pass">
                      </div>
<!------------------------------------->
<!-------Submit Button-------->
                       <button type="submit" class="btn btn-block btn-lg text-uppercase contact-btn" name="submit" value="login"><i class="far fa-hand-point-right mr-2"></i>Click Here</button>
                    </form>
                </div>
	            <div class="cta">
	            	<a href="registration.php" style="color:white; font-size:30px;"> Create a new account</a>
	            </div>
            </div>
        </div>
    </div>
</section>


<!------------------------------------------------------------------------------------------------------------->

<!--Footer social icons-->

<div class="container-fluid info p-3">
    <div class="row">
        
        <div class="col d-flex justify-content-between align-items-baseline flex-wrap">
            <div class="info-icons p-2">
                <a href="https://web.facebook.com/Lacuisine111/" class="mr-2 primary-color"><i class="fab fa-facebook fa-2x"></i></a>
                <a href="#" class="mr-2 primary-color"><i class="fab fa-instagram fa-2x"></i></a>
                <a href="#" class="mr-2 primary-color"><i class="fab fa-youtube fa-2x"></i></a>
                <a href="#" class="mr-2 primary-color"><i class="fab fa-twitter fa-2x"></i></a>
            </div>
            <h2 class="primary-color p-2 text-capitalize">&copy;Copyright 2020 | UETP</h2>
        </div>
    </div>
</div>    

<!--End of Footer Social Icons-->

<!------------------------------------------------------------------------------------------------------------->


<!-- JQuery -->
    <script src="js/jquery-3.4.1.min.js"></script>
<!-- Bootstrap js -->
    <script src="js/bootstrap.bundle.min.js"></script>
<!-- Magnific Popup -->
    <script src="magnific-popup/jquery.magnific-popup.js"></script>
<!-- Ripple Effect -->
    <script src="js/jquery.ripples-min.js"></script>
<!-- JavaScript -->
   <script src="js/script.js"></script>
   <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>


</body>
</html>